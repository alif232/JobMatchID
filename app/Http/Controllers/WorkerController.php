<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\WorkerDetail;
use App\Models\Pelamar;
use App\Models\Education;
use App\Models\Skills;
use App\Models\Job;
use App\Models\LamarStatus;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class WorkerController extends Controller
{
    public function workerDashboard()
    {
        $user = Auth::user();
        return view('worker.dashboard', compact('user'));
    }

    public function workerJobs(Request $request)
    {
        $user = Auth::user();

        // Retrieve search query
        $search = $request->input('search');

        if ($search) {
            // Search for jobs based on position, skills in qualifications, or company name
            $jobs = Job::with(['user.companyDetail'])
                ->where('posisi', 'LIKE', "%{$search}%")
                ->orWhere('kualifikasi', 'LIKE', "%{$search}%")
                ->orWhereHas('user.companyDetail', function ($query) use ($search) {
                    $query->where('company_name', 'LIKE', "%{$search}%");
                })
                ->orderBy('created_at', 'desc')
                ->get();

            // Skip recommended jobs if searching
            $recommendedJobs = collect();
        } else {
            // Retrieve user's skills
            $userSkills = Skills::where('user_id', $user->id_user)->pluck('skills')->toArray();

            // Retrieve all jobs sorted by creation date
            $jobs = Job::with(['user.companyDetail'])->orderBy('created_at', 'desc')->get();

            // Filter jobs for recommendations use TF IDF
            $recommendedJobs = $jobs->filter(function ($job) use ($userSkills) {
                foreach ($userSkills as $skill) {
                    if (stripos($job->kualifikasi, $skill) !== false) {
                        return true;
                    }
                }
                return false;
            });
        }

        return view('worker.jobs', compact('user', 'jobs', 'recommendedJobs', 'search'));
    }
    
    public function showWorkerJobs($id)
    {
        $user = Auth::user();

        $job = Job::with(['user.companyDetail'])->findOrFail($id);

        return view('worker.showjobs', compact('user', 'job'));
    }

    public function workerAboutus()
    {
        $user = Auth::user();
        return view('worker.aboutus', compact('user'));
    }

    public function workerLamaran(Request $request)
    {
        $user = Auth::user();

        // Ambil data lamaran dengan relasi status terbaru
        $lamaran = Pelamar::with(['job.user.companyDetail', 'status' => function ($query) {
            $query->latest('created_at'); // Ambil status terbaru
        }])->where('id_user', $user->id_user);

        if ($request->ajax()) {
            // Filter berdasarkan kolom 'posisi' jika ada pencarian
            if ($request->has('search') && !empty($request->get('search')['value'])) {
                $search = $request->get('search')['value'];
                $lamaran = $lamaran->whereHas('job', function ($query) use ($search) {
                    $query->where('posisi', 'like', "%{$search}%"); // Filter berdasarkan posisi
                });
            }

            return DataTables::of($lamaran)
                ->addIndexColumn()
                ->addColumn('company_name', function ($row) {
                    return $row->job->user->companyDetail->company_name ?? 'Nama perusahaan tidak tersedia';
                })
                ->addColumn('posisi', function ($row) {
                    $detailUrl = route('worker.lamaran.status', ['id_lamar' => $row->id_lamar]);
                    return '<a href="#" class="detail-status" data-url="' . $detailUrl . '">' . $row->job->posisi . '</a>';
                })
                ->editColumn('created_at', function ($row) {
                    return \Carbon\Carbon::parse($row->created_at)->format('d-m-Y');
                })
                ->addColumn('status', function ($row) {
                    $latestStatus = $row->status->first(); // Ambil status terbaru
                    if ($latestStatus) {
                        switch ($latestStatus->status) {
                            case 'Pending':
                                return '<span class="badge bg-warning text-dark">PENDING</span>';
                            case 'Diterima':
                                return '<span class="badge bg-success">DITERIMA</span>';
                            case 'Ditolak':
                                return '<span class="badge bg-danger">DITOLAK</span>';
                            default:
                                return '<span class="badge bg-secondary">Tidak Diketahui</span>';
                        }
                    }
                    return '<span class="badge bg-secondary">Belum Ada Status</span>';
                })
                ->rawColumns(['posisi', 'status']) 
                ->make(true);
        }

        return view('worker.lamaran', compact('user'));
    }

    public function getStatusDetail($id_lamar)
    {
        $lamaran = Pelamar::with(['job', 'job.user.companyDetail', 'status' => function ($query) {
            $query->orderBy('created_at', 'desc'); // Urutkan status berdasarkan waktu terbaru
        }])->findOrFail($id_lamar);

        // Ambil note terbaru
        $latestNote = $lamaran->status->first()?->note ?? '-';

        return response()->json([
            'lamaran' => [
                'posisi' => $lamaran->job->posisi ?? 'Tidak tersedia',
                'company_name' => $lamaran->job->user->companyDetail->company_name ?? 'Tidak tersedia',
            ],
            'status' => $lamaran->status->map(function ($status) {
                $badgeColor = match ($status->status) {
                    'Diterima' => 'bg-success',
                    'Ditolak' => 'bg-danger',
                    default => 'bg-secondary',
                };

                return [
                    'status' => $status->status,
                    'note' => $status->note ?? '-',
                    'created_at' => $status->created_at->format('d-m-Y'),
                    'badge_color' => $badgeColor,
                ];
            }),
            'latest_note' => $latestNote, // Catatan terbaru
        ]);
    }

    public function workerProfile()
    {
        $user = Auth::user();

        $workerDetail = $user->workerDetail ?? new WorkerDetail();
        $educations = Education::where('user_id', Auth::id())->orderBy('thnlulus', 'desc')->get();
        $skills = Skills::where('user_id', Auth::id())->get();
        $latestEducation = Education::where('user_id', Auth::id())->orderBy('thnlulus', 'desc')->first();

        return view('worker.profile', compact('user', 'workerDetail', 'educations', 'skills', 'latestEducation'));
    }

    public function workerProfileUpdate(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'nama' => 'required|string|max:255',
            'tgllahir' => 'required|string',
            'alamat' => 'required|string',
            'notelp' => 'required|string' ,
            'deskripsi' => 'nullable|string',
            'link' => 'nullable|string',
            'logo_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();

        if(!$user) {
            return redirect()->back()->withErrors(['error' => 'User is not authenticated']);
        }

        // Initialize the logo path as null in case no new photo is uploaded
        $logoPath = null;

        // Handle logo photo upload if it exists
        if ($request->hasFile('logo_photo')) {
            // Delete the old logo if it exists
            if ($user->workerDetail && $user->workerDetail->logo_photo) {
                Storage::delete('public/' . $user->workerDetail->logo_photo);
            }

            // Store the new logo photo
            $logoPath = $request->file('logo_photo')->store('img/worker', 'public');
        }

        // Update or create company details
        $workerDetail = WorkerDetail::updateOrCreate(
            ['user_id' => Auth::id()], // Search for the existing record
            [
                'nama' => $request->nama,
                'tgllahir' => $request->tgllahir,
                'alamat' => $request->alamat,
                'notelp' => $request->notelp,
                'deskripsi' => $request->deskripsi,
                'link' => $request->link,
                'logo_photo' => $logoPath ?? $user->workerDetail->logo_photo ?? null,
            ]
        );

        // Redirect ke halaman profile dengan pesan sukses
        return redirect()->route('worker.profile')->with('success', 'Profile berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user(); // Ambil user yang sedang login

        // Periksa apakah current_password cocok dengan password yang tersimpan
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        DB::table('users')
        ->where('id_user', Auth::id())
        ->update(['password' => hash::make($request->new_password)]);

        // Redirect dengan pesan sukses
        return redirect()->route('worker.profile')->with('success', 'Password berhasil diperbarui.');
    }

    public function workerStoreEducation(Request $request)
    {
        $request->validate([
            'kualifikasi' => 'required|string',
            'lembaga' => 'required|string|max:255',
            'thnlulus' => 'required|integer|digits:4|min:1900|max:' . date('Y'),
        ]);

        Education::create([
            'user_id' => Auth::id(), 
            'kualifikasi' => $request->kualifikasi,
            'lembaga' => $request->lembaga,
            'thnlulus' => $request->thnlulus,
        ]);

        return redirect()->route('worker.profile')->with('success', 'Education Berhasil Ditambahkan.');
    }

    public function workerUpdateEducation(Request $request, $id)
    {
        $request->validate([
            'kualifikasi' => 'required|string|max:255',
            'lembaga' => 'required|string|max:255',
            'thnlulus' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        // Find the education record by ID
        $education = Education::findOrFail($id);
        $education->update($request->all());

        return redirect()->route('worker.profile')->with('success', 'Education updated successfully!');
    }

    public function workerDestroyEducation($id)
    {
        $education = Education::findOrFail($id);
        $education->delete();

        return redirect()->route('worker.profile')->with('success', 'Education Berhasil Dihapus.');
    }

    public function storeSkills(Request $request)
    {
        $request->validate([
            'skills' => 'required|string',
        ]);

        $skills = explode(',', $request->skills); // Convert string to array
        $userId = Auth::id(); // Get the logged-in user ID

        // Delete existing skills for the user
        Skills::where('user_id', $userId)->delete();

        // Insert new skills
        foreach ($skills as $skill) {
            Skills::create([
                'user_id' => $userId,
                'skills' => $skill,
            ]);
        }

        return redirect()->route('worker.profile')->with('success', 'Skills saved successfully!');
    }

    public function deleteSkill($id)
    {
        $skill = Skills::findOrFail($id);
        $skill->delete();

        return response()->json(['success' => true]);
    }

    public function apply(Request $request, $id)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048', // Hanya file PDF yang diizinkan
            'link' => 'nullable|url',
        ]);

        $user = Auth::user();

        // Ambil nama pelamar untuk digunakan sebagai nama file
        $workerDetail = $user->workerDetail;
        $pelamarName = $workerDetail->nama ?? 'pelamar';

        // Buat nama file CV dengan format cv(nama).pdf
        $formattedName = str_replace(' ', '_', strtolower($pelamarName)); // Ganti spasi dengan underscore
        $cvFileName = 'cv(' . $formattedName . ').pdf';

        // Simpan file CV dengan nama yang sudah diformat ke storage
        $cvPath = $request->file('cv')->storeAs('cv', $cvFileName, 'public');

        // Simpan data lamaran ke tabel `lamar`
        $lamar = Pelamar::create([
            'id_user' => $user->id_user,
            'id_jobs' => $id,
            'cv' => $cvPath,
            'link' => $request->link,
            'tanggal' => now(),
        ]);

        // Periksa apakah data berhasil disimpan
        if ($lamar && $lamar->id_lamar) {
            // Simpan status awal ke tabel `lamar_status`
            LamarStatus::create([
                'id_user' => $user->id_user,
                'id_lamar' => $lamar->id_lamar, // Ambil ID dari Pelamar
                'status' => 'Pending',
                'note' => null,
            ]);
        } else {
            return redirect()->route('worker.jobs')->withErrors('Gagal menyimpan lamaran.');
        }

        return redirect()->route('worker.jobs')->with('success', 'Lamaran berhasil dikirim.');
    }
}
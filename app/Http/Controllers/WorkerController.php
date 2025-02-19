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
use App\Models\Skill;
use App\Helpers\TFIDFHelper;
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

        // Ambil query pencarian jika ada
        $search = $request->input('search');
        $experience = $request->input('experience');

        // Mulai query jobs
        $jobs = Job::with(['user.companyDetail'])->orderBy('created_at', 'desc');

        if ($search) {
            $jobs->where(function ($query) use ($search) {
                $query->where('posisi', 'LIKE', "%{$search}%")
                    ->orWhere('kualifikasi', 'LIKE', "%{$search}%")
                    ->orWhereHas('user.companyDetail', function ($subQuery) use ($search) {
                        $subQuery->where('company_name', 'LIKE', "%{$search}%");
                    });
            });
        }

        if ($experience) {
            $jobs->where('kualifikasi', 'LIKE', "%{$experience}%");
        }

        $jobs = $jobs->get(); // Get data setelah filtering selesai

        // Ambil keterampilan pengguna
        $userSkills = Skills::where('user_id', $user->id_user)->pluck('skills')->toArray();
        $jobDescriptions = $jobs->pluck('kualifikasi')->toArray();

        // Jika tidak ada pencarian, lakukan TF-IDF untuk rekomendasi
        $recommendedJobs = collect();
        if (!$search) {
            $userSkillsDocument = implode(' ', $userSkills);
            $documents = array_merge($jobDescriptions, [$userSkillsDocument]);
            $idf = TFIDFHelper::calculateIDF($documents);

            $userSkillsTF = TFIDFHelper::calculateTF($userSkillsDocument);
            $userSkillsTFIDF = TFIDFHelper::calculateTFIDF($userSkillsTF, $idf);

            $recommendedJobs = $jobs->filter(function ($job) use ($userSkillsTFIDF, $idf) {
                $jobTF = TFIDFHelper::calculateTF($job->kualifikasi);
                $jobTFIDF = TFIDFHelper::calculateTFIDF($jobTF, $idf);
                return TFIDFHelper::cosineSimilarity($userSkillsTFIDF, $jobTFIDF) > 0.1;
            });
        }

        return view('worker.jobs', compact('user', 'jobs', 'recommendedJobs', 'search', 'experience'));
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
            'notelp' => 'required|string',
            'deskripsi' => 'nullable|string',
            'link' => 'nullable|string',
            'logo_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User is not authenticated']);
        }

        // Path penyimpanan gambar default
        $logoPath = $user->workerDetail->logo_photo ?? null;

        if ($request->hasFile('logo_photo')) {
            $uploadedFile = $request->file('logo_photo');

            // Tentukan path tujuan penyimpanan
            $destinationPath = public_path('simpan/profile/worker');
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();

            try {
                // Pastikan folder tujuan ada
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // Hapus logo lama jika ada
                if ($logoPath && file_exists(public_path($logoPath))) {
                    unlink(public_path($logoPath));
                }

                // Simpan gambar baru ke folder tujuan
                $uploadedFile->move($destinationPath, $fileName);

                // Perbarui path logo
                $logoPath = 'simpan/profile/worker/' . $fileName;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Gagal mengunggah foto baru.']);
            }
        }

        // Perbarui atau buat detail pekerja
        $workerDetail = WorkerDetail::updateOrCreate(
            ['user_id' => Auth::id()], // Cari data yang sesuai dengan user_id
            [
                'nama' => $request->nama,
                'tgllahir' => $request->tgllahir,
                'alamat' => $request->alamat,
                'notelp' => $request->notelp,
                'deskripsi' => $request->deskripsi,
                'link' => $request->link,
                'logo_photo' => $logoPath,
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

    public function getSkills(Request $request)
    {
        $query = $request->input('query');

        // Cari skill yang cocok dengan input user
        $skills = Skill::where('name', 'LIKE', "%$query%")->limit(5)->get();

        return response()->json($skills);
    }

    public function storeSkills(Request $request)
{
    $request->validate([
        'skills' => 'required|string',
    ]);

    $skills = array_filter(explode(',', $request->skills)); // Ubah ke array
    $userId = Auth::id();

    if (empty($skills)) {
        return redirect()->route('worker.profile')->with('error', 'No skills provided.');
    }

    // Hapus semua skill lama dari user
    Skills::where('user_id', $userId)->delete();

    foreach ($skills as $skill) {
        $skill = trim($skill);

        // Simpan langsung ke tabel `Skills`, tanpa harus ada di `skill`
        Skills::create([
            'user_id' => $userId,
            'skills' => $skill, // Simpan apa yang dimasukkan user
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

    // Tentukan path penyimpanan CV
    $destinationPath = public_path('simpan/cv');
    $cvPath = 'simpan/cv/' . $cvFileName;

    try {
        // Pastikan folder tujuan ada
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // Simpan file CV di folder tujuan
        $request->file('cv')->move($destinationPath, $cvFileName);
    } catch (\Exception $e) {
        return redirect()->route('worker.jobs')->withErrors('Gagal mengunggah CV: ' . $e->getMessage());
    }

    // Simpan data lamaran ke tabel `lamar`
    $lamar = Pelamar::create([
        'id_user' => $user->id_user,
        'id_jobs' => $id,
        'cv' => $cvPath, // Simpan path relatif
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
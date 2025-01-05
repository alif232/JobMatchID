<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\CompanyDetail;
use App\Models\Job; // Import the model for company details
use App\Models\Pelamar;
use App\Models\LamarStatus;
use App\Models\Education;
use App\Models\Skills;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function companyDashboard(Request $request)
    {
        $user = Auth::user();
        $companyDetail = $user->companyDetail;

        $jobIds = Job::where('id_user', $user->id_user)->pluck('id_jobs');

        $pelamarDiterima = LamarStatus::whereIn('id_lamar', function ($query) use ($jobIds) {
            $query->select('id_lamar')
                ->from('lamar')
                ->whereIn('id_jobs', $jobIds);
        })
        ->where('status', 'Diterima')
        ->count();

        $pelamarDitolak = LamarStatus::whereIn('id_lamar', function ($query) use ($jobIds) {
            $query->select('id_lamar')
                ->from('lamar')
                ->whereIn('id_jobs', $jobIds);
        })
        ->where('status', 'Ditolak')
        ->count();

        $totalPelamar = LamarStatus::whereIn('id_lamar', function ($query) use ($jobIds) {
            $query->select('id_lamar')
                ->from('lamar')
                ->whereIn('id_jobs', $jobIds);
        })
        ->distinct('id_lamar')
        ->count();

        if ($request->ajax()) {
            $data = Pelamar::with(['workerDetail', 'status' => function ($query) {
                $query->latest('created_at');
            }, 'job'])
            ->whereIn('id_jobs', $jobIds); 

            return DataTables::of($data)
                ->addIndexColumn() 
                ->editColumn('status', function ($row) {
                    $latestStatus = $row->status->first();
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
                ->editColumn('tanggal', function ($row) {
                    return \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y');
                })
                ->editColumn('nama', function ($row) {
                    return $row->workerDetail ? $row->workerDetail->nama : '-';
                })
                ->editColumn('posisi', function ($row) {
                    return $row->job ? $row->job->posisi : '-';
                })
                ->rawColumns(['status']) 
                ->make(true);
        }

        return view('company.dashboard', compact(
            'user', 'companyDetail', 'pelamarDiterima', 'pelamarDitolak', 'totalPelamar'
        ));
    }

    // Function to show the company profile
    public function showProfile()
    {
        $user = Auth::user();
        $companyDetail = $user->companyDetail ?? new CompanyDetail(); // Initialize an empty company detail if not exists
        return view('company.profile', compact('user', 'companyDetail')); // Pass the companyDetail to the view
    }
    
    public function updateProfile(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|string',
            'description' => 'nullable|string',
            'logo_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User is not authenticated']);
        }

        // Initialize the logo path
        $logoPath = $user->companyDetail->logo_photo ?? null;

        if ($request->hasFile('logo_photo')) {
            $uploadedFile = $request->file('logo_photo');

            // Define the destination path
            $destinationPath = public_path('simpan/profile/company');
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();

            try {
                // Ensure the destination directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // Delete the old logo if it exists
                if ($logoPath && file_exists(public_path($logoPath))) {
                    unlink(public_path($logoPath));
                }

                // Move the uploaded file to the destination folder
                $uploadedFile->move($destinationPath, $fileName);

                // Set the new logo path
                $logoPath = 'simpan/profile/company/' . $fileName;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Failed to upload the new photo.']);
            }
        }

        // Update or create company details
        $companyDetail = CompanyDetail::updateOrCreate(
            ['user_id' => Auth::id()], // Search for the existing record
            [
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'description' => $request->description,
                'logo_photo' => $logoPath,
            ]
        );

        // Redirect back with success message
        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function companyUpdatePassword(Request $request)
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
        return redirect()->route('profile')->with('success', 'Password berhasil diperbarui.');
    }

    public function jobs(Request $request)
    {
        $user = Auth::user();
        $companyDetail = $user->companyDetail;

        if ($request->ajax()) {
            $jobs = Job::where('id_user', Auth::id());

            if (!empty($request->get('search')['value'])) {
                $search = $request->get('search')['value'];
                $jobs = $jobs->where('posisi', 'like', "%{$search}%");
            }

            return DataTables::of($jobs)
                ->addIndexColumn()
                ->addColumn('posisi', function ($row) {
                    return '
                        <div class="dropdown-container">
                            <a href="#" class="dropdown-trigger" onclick="toggleDropdown(event, ' . $row->id_jobs . ')">
                                ' . $row->posisi . '
                            </a>
                            <div class="dropdown-menu" id="dropdownMenu' . $row->id_jobs . '">
                                <a class="dropdown-item" href="#" onclick="openEditModal(' . $row->id_jobs . ')">Edit</a>
                                <a class="dropdown-item" href="#" onclick="openDeleteModal(' . $row->id_jobs . ')">Delete</a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['posisi']) 
                ->make(true);
        }

        $user = Auth::user();
        return view('company.jobs', compact('user', 'companyDetail'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'posisi' => 'required|string|max:255',
            'kualifikasi' => 'required|string|max:255',
            'jobdesk' => 'required|string',
            'benefit' => 'required|string',
        ]);

        Job::create([
            'id_user' => Auth::id(), 
            'posisi' => $request->posisi,
            'kualifikasi' => $request->kualifikasi,
            'jobdesk' => $request->jobdesk,
            'benefit' => $request->benefit,
        ]);

        return redirect()->route('company.jobs')->with('success', 'Job created successfully!');
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return response()->json($job); // Kembalikan data job sebagai JSON
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'posisi' => 'required|string|max:255',
            'kualifikasi' => 'required|string|max:255',
            'jobdesk' => 'required|string',
            'benefit' => 'required|string',
        ]);

        $job = Job::findOrFail($id);
        $job->update($request->all());

        return redirect()->route('company.jobs')->with('success', 'Job updated successfully!');
    }

    public function delete($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('company.jobs')->with('success', 'Job delete successfully!');
    }

    public function pelamar(Request $request)
    {
        $user = Auth::user();
        $companyDetail = $user->companyDetail;

        // Query dasar pelamar yang terkait dengan job milik user yang sedang login
        $lamaran = Pelamar::select('lamar.*', 'user_detail_worker.nama as nama_pelamar', 'jobs.posisi as nama_posisi')
            ->join('jobs', 'lamar.id_jobs', '=', 'jobs.id_jobs') // Join ke tabel jobs
            ->join('user_detail_worker', 'lamar.id_user', '=', 'user_detail_worker.user_id') // Join ke tabel worker_detail
            ->where('jobs.id_user', $user->id_user); // Filter berdasarkan id_user yang login

        if ($request->ajax()) {

            // Jika ada pencarian, terapkan filter
            if ($request->has('search') && $request->search['value'] != '') {
                $searchValue = $request->search['value'];
                $lamaran->where(function ($query) use ($searchValue) {
                    $query->where('user_detail_worker.nama', 'like', "%$searchValue%") // Filter nama pelamar
                        ->orWhere('jobs.posisi', 'like', "%$searchValue%"); // Filter posisi pekerjaan
                });
            }

            return DataTables::of($lamaran)
                ->addIndexColumn() // Tambahkan indeks otomatis
                ->editColumn('status', function ($row) {
                    // Ambil status terbaru
                    $latestStatus = LamarStatus::where('id_lamar', $row->id_lamar)->latest('created_at')->first();
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
                ->editColumn('tanggal', function ($row) {
                    // Format tanggal
                    return \Carbon\Carbon::parse($row->created_at)->format('d-m-Y');
                })
                ->addColumn('nama', function ($row) {
                    // Buat nama pelamar menjadi tautan ke halaman detail pelamar
                    $detailUrl = route('pelamar.detail', ['id' => $row->id_user]); // Rute ke halaman detail
                    return '<a href="' . $detailUrl . '">' . $row->nama_pelamar . '</a>';
                })
                ->addColumn('posisi', function ($row) {
                    // Ambil posisi dari join
                    return $row->nama_posisi ?? '-';
                })
                ->rawColumns(['status', 'nama']) // Pastikan 'nama' dirender sebagai HTML
                ->make(true);
        }

        return view('company.pelamar', compact('user', 'companyDetail'));
    }

    public function detail($id)
    {
        $user = Auth::user();
        $companyDetail = $user->companyDetail;

        // Ambil data pelamar berdasarkan ID
        $pelamar = Pelamar::with(['job', 'workerDetail'])->where('id_user', $id)->firstOrFail();

        // Ambil riwayat pendidikan dan skills
        $educations = Education::where('user_id', $id)->get();
        $skills = Skills::where('user_id', $id)->get();

        // Kirim data ke view
        return view('company.pelamar_detail', compact('user', 'pelamar', 'companyDetail', 'educations', 'skills'));
    }

    public function showPdf($filename)
    {
        // Path file PDF dalam storage
        $path = storage_path('app/public/' . $filename);

        // Cek apakah file ada
        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Kirim file PDF dengan header untuk ditampilkan
        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline',
        ]);
    }

    public function processApplication(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diterima,Ditolak',
            'note' => 'nullable|string|max:255',
        ]);

        $user = Auth::user(); // Dapatkan data pengguna yang login

        // Tambahkan data ke tabel `lamar_status`
        LamarStatus::create([
            'id_user' => $user->id_user,
            'id_lamar' => $id,
            'status' => $request->status,
            'note' => $request->note,
        ]);

        return redirect()->route('pelamar')->with('success', 'Status lamaran berhasil diproses.');
    }
}
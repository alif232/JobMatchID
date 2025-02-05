<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class Jobs extends Controller
{
    public function Jobs(Request $request)
    {
        // Retrieve search query
        $search = $request->input('search');
        $experience = $request->input('experience');

        $jobs = Job::with(['user.companyDetail']);
    
        if ($search) {
            // Search for jobs based on position, skills in qualifications, or company name
            $jobs->where('posisi', 'LIKE', "%{$search}%")
                ->orWhere('kualifikasi', 'LIKE', "%{$search}%")
                ->orWhereHas('user.companyDetail', function ($query) use ($search) {
                    $query->where('company_name', 'LIKE', "%{$search}%");
                });
        }

        if ($experience) {
            $jobs->where('kualifikasi', 'like', "%$experience%");
        }
    
        // Order jobs by the latest created_at date
        $jobs = $jobs->orderBy('created_at', 'desc')->get();
    
        return view('jobs', compact('jobs', 'search', 'experience'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CompanyDetail;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        return view('pro', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:user_detail_company,email,' . Auth::id(),
            'description' => 'nullable|string',
            'logo_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // Update or upload new logo
        if ($request->hasFile('logo_photo')) {
            if ($user->companyDetail->logo_photo) {
                Storage::delete('public/' . $user->companyDetail->logo_photo);
            }
            $logoPath = $request->file('logo_photo')->store('img/company', 'public');
            $user->companyDetail->logo_photo = $logoPath;
        }

        // Update company details
        $user->companyDetail->update([
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'description' => $request->description,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}

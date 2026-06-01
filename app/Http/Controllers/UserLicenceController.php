<?php

namespace App\Http\Controllers;

use App\Models\UserLicence;

class UserLicenceController extends Controller
{
    public function index()
    {
        // सिर्फ premium users के records
        $licences = UserLicence::with(['user', 'admin'])
            ->forPremiumUsers()
            ->latest()
            ->get();

        return view('licences.index', compact('licences'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; // Or your model

class AdminController extends Controller
{
    public function showForm()
    {
        return view('admin.form');
    }

    public function storeForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}

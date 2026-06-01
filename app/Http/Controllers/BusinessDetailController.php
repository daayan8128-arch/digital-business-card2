<?php

namespace App\Http\Controllers;

use App\Models\BusinessDetail;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Nullable;

class BusinessDetailController extends Controller
{
    public function create()
    {
        return view('business_details.create');
    }
    public function showBusinesscard()
    {
        return view('web.about-us');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'business_name' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'gstin' => 'nullable|string|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'additional_info' => 'nullable|string',
        ]);
         $data = $validated;

        // Handle file upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('business_photos', 'public');
            $data['photo_path'] = $path;
        }

        BusinessDetail::create($data);

        return redirect()->route('business.show')->with('success', 'Business card created successfully!');
    }

    public function show()
    {
        $details = BusinessDetail::latest()->first();
        return view('business_details.show', compact('details'));
    }

}
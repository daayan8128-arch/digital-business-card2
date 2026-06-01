<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\about_us as AboutUs; // model
use Illuminate\Support\Facades\Auth; // for Auth::id()

class AboutUsController extends Controller
{
    public function store(Request $request)
    {
        // ✅ Validate incoming data
        $request->validate([
            'about_content' => 'required|string|max:9999999',
            
        ]);

        // ✅ Save new AboutUs data with user_id
        $about = new AboutUs();
        $about->about_content = $request->about_content;
        $about->user_id = Auth::id(); // 👈 Logged-in user ka ID yahan set karo
        $about->save();

        return redirect()->back()->with('success', 'About Us content saved successfully!');
    }
}


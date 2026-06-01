<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Exception;

class FeedbackController extends Controller
{
    /**
     * Show feedback list (About Us page).
     */
    public function index($username)
    {
        // 1. Current user fetch karo
        $user = User::where('username', $username)->firstOrFail();

        // 2. Sirf current user ke sab feedbacks fetch karo, latest first
        $feedbacks = Feedback::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('web.about-us', compact('feedbacks', 'user'));
    }

    /**
     * Store feedback (for a specific user profile).
     */
    public function store(Request $request, $username)
    {
        try {
            // ✅ Get profile user
            $user = User::where('username', $username)->firstOrFail();

            // ✅ Validation
            $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'nullable|string|max:255',
                'feedback' => 'required|string',
                'rating' => 'required|integer|min:1|max:5',
                'profilePicture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120', // 5MB limit
            ]);

            // ✅ Create Feedback
            $feedback = new Feedback();
            $feedback->user_id = $user->id;
            $feedback->name = $request->name;
            $feedback->position = $request->position ?? null;
            $feedback->feedback = $request->feedback;
            $feedback->rating = $request->rating;
            $feedback->status = 'unpublics'; // default unpublished

            // ✅ Profile Image Upload (public/uploads)
            if ($request->hasFile('profilePicture')) {
                $file = $request->file('profilePicture');
                $filename = time() . '_' . $file->getClientOriginalName();

                // Move file to public/uploads
                $file->move(public_path('uploads'), $filename);

                // Save filename to DB
                $feedback->profile_image = $filename;
            }

            $feedback->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Thank you for your feedback! It will be visible once approved.',
                'data' => $feedback,
            ], 200);

        } catch (Exception $e) {
            // Log the error
            Log::error('Feedback store error: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

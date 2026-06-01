<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
   public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'user_id' => 'required|exists:users,id', // ✅ jis user ko contact kar rahe uska ID
        ]);

        $contact = ContactMessage::create($validated);

        return response()->json([
            'success'   => true,
            'message'   => 'Thank you for your message!',
            'record_id' => $contact->id
        ]);
    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'errors'  => $e->errors(),
            'message' => 'Validation failed.'
        ], 422);
    } catch (\Throwable $e) {
        \Log::error('Contact form error', ['error' => $e->getMessage()]);
        return response()->json([
            'success' => false,
            'message' => 'Server error. Please try again later.'
        ], 500);
    }
}

}

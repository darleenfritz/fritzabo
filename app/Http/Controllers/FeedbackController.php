<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FeedbackController extends Controller
{
    public function create()
    {
        return view('pages.feedback');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'email' => 'nullable|email|max:255'
        ]);

        $entry = now() . "\n" .
                 "E-Mail: " . ($validated['email'] ?? 'Anonym') . "\n" .
                 "Nachricht: " . $validated['message'] . "\n\n";

        File::append(storage_path('feedback.txt'), $entry);

        return redirect()->route('feedback.create')->with('success', 'Danke für Dein Feedback!');
    }
}
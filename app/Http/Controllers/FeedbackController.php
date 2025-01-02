<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::where('status', 'approve')->get();
        return view('home', compact('feedback'));
    }

    public function userHistory($userId)
    {
        $feedback = Feedback::where('user_id', $userId)->get();
        return view('user.history', compact('feedback'));
    }

    public function create()
    {
        return view('home.feedback');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5', // Added rating validation
        ]);

        Feedback::create([
            'message' => $validated['message'],
            'rating' => $validated['rating'], // Store the rating
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('feedback.create')->with('success', 'Feedback submitted successfully.');
    }

    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approve,reject',
            'admin_id' => 'nullable|exists:admins,id',
        ]);

        $feedback->update($validated);

        return redirect()->back()->with('success', 'Feedback updated successfully.');
    }

    public function manageFeedback()
    {
        $feedback = Feedback::all();
        return view('admin.feedback.manage', compact('feedback'));
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->back()->with('success', 'Feedback deleted successfully.');
    }
}
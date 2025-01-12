<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactUsController extends Controller
{
    public function index()
    {
        $contacts = ContactUs::all();
        return view('contactus.contactus', compact('contacts'));
    }

    public function showlogo()
    {
        $contact = ContactUs::first(); // Get the first record
        return view('components.application-logo', compact('contact'));
    }

    public function create()
    {
        $contact = ContactUs::first();
        if ($contact) {
            return redirect()->route('contactus.edit', $contact->id)
                ->with('warning', 'Contact details already exist. You can only edit them.');
        }

        return view('Admin.contactcreate');
    }

    public function store(Request $request)
    {
        $existingContact = ContactUs::first();
        if ($existingContact) {
            return redirect()->route('contactus.index')
                ->with('error', 'Contact details already exist. You can only edit them.');
        }

        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'logo_img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'logo_img.max' => 'The logo image size must not exceed 2 MB.',
        ]);

        $data = $request->only(['email', 'phone', 'address']);
        if ($request->hasFile('logo_img')) {
            $data['logo_img'] = $request->file('logo_img')->store('contactus', 'public');
        }

        ContactUs::create($data);

        return redirect()->route('contactus.create')->with('success', 'Contact details created successfully!');
    }

    public function edit(ContactUs $contactus)
    {
        return view('Admin.contactcreate', compact('contactus'));
    }

    public function update(Request $request, ContactUs $contactus)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'logo_img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'logo_img.max' => 'The logo image size must not exceed 2 MB.',
        ]);

        $data = $request->only(['email', 'phone', 'address']);
        if ($request->hasFile('logo_img')) {
            if ($contactus->logo_img) {
                Storage::disk('public')->delete($contactus->logo_img);
            }
            $data['logo_img'] = $request->file('logo_img')->store('contactus', 'public');
        }

        $contactus->update($data);

        return redirect()->route('contactus.create')->with('success', 'Contact details updated successfully!');
    }

    public function destroy(ContactUs $contactus)
    {
        if ($contactus->logo_img) {
            Storage::disk('public')->delete($contactus->logo_img);
        }

        $contactus->delete();

        return redirect()->route('contactus.index')->with('success', 'Contact details deleted successfully!');
    }
}

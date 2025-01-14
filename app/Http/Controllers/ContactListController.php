<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactListController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('Admin.packages.ContactList.index', compact('contacts'));
    }

    public function indexshow()
    {
        $contacts = Contact::all();
        return view('Admin.packages.ContactList.index', compact('contacts'));
    }

    public function storeMultiple(Request $request)
    {
        $contacts = $request->input('contacts');

        foreach ($contacts as $contact) {
            Contact::create([
                'name' => $contact['name'],
                'phone' => $contact['phone'],
            ]);
        }

        return redirect()->route('contacts.index')->with('message', 'Contacts created successfully!');
    }
    //create a new contact
    public function create()
    {
        return view('Admin.packages.ContactList.create');
    }
    // Store a new contact
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $contact = Contact::create($request->all());

        return response()->json([
            'message' => 'Contact added successfully',
            'contact' => $contact,
        ]);
    }

    // Update a contact
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $request->validate([
            'name' => 'string|max:255',
            'phone' => 'string|max:15',
        ]);

        $contact->update($request->all());

        return response()->json([
            'message' => 'Contact updated successfully',
            'contact' => $contact,
        ]);
    }

    // Delete a contact
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with(['message' => 'Contact deleted successfully']);
    }
}

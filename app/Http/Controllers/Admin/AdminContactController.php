<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminContactController extends Controller
{
    public function contacts()
    {
        $contacts = Contact::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.contacts', compact('contacts'));
    }

    public function contact_show($id)
    {
        $contact = Contact::findOrFail($id);

        // Mark as read when viewing
        if (!$contact->read) {
            $contact->update(['read' => true]);
        }
        return view('admin.contact-show', compact('contact'));
    }

    public function contact_delete($id)
    {
        $contact = Contact::findOrFail($id);

        $contact->delete();
        return redirect()->route('admin.contacts')->with([
            'message' => __('Deleted successfully!'),
            'alert-type' => 'info'
        ]);
    }
}

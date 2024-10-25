<?php

namespace App\Http\Controllers;

use App\Models\contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function mail(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ]);


        $contact = contact::created($validatedData);

        try {
            Mail::to('owaisameer014@gmail.com')->send(new ContactMail($contact));
            if (Mail::failures()) {
                return back()->with('Error', 'Failed to send email. Please try again.');
            }
            return back()->with('Success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            return back()->with('Error', 'There was an issue sending your message. Please try again later.');
        }
    }
}

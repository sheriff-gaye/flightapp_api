<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function contact(ContactRequest $request){

        $contact = ContactUs::create([
            'full_name' => $request->post('full_name'),
            'email' => $request->post('email'),
            'message' => $request->post('message'),
        ]);

        if ($contact->save()) {
            return response()->json([
                'success' => true,
            ]);
        }
        return response()->json([
            'success' => false,
        ]);

    }
}

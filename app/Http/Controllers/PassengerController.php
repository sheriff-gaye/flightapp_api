<?php

namespace App\Http\Controllers;

use App\Http\Requests\PassengerRequest;
use App\Models\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function passenger(PassengerRequest $request){


        $contact = Passenger::create([
            'full_name' => $request->post('full_name'),
            'email' => $request->post('email'),
            'passport' => $request->post('passport'),
            'country' => $request->post('country'),
            'dob' => $request->post('dob'),
            'title' => $request->post('title'),
            'phone' => $request->post('phone'),
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

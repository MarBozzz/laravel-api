<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    function store(Request $request){
        $data = $request->all();
        $success = true;

        $validator = Validator::make($data,
            [
                'name' => 'required|min:2|max:255',
                'email' => 'required|email|max:255',
                'object' => 'required|min:2|max:255',
                'message' => 'required|min:5',
            ],
            [
                'name.required' => 'A name is required',
                'name.min' => 'Name must have minimum :min characters',
                'name.max' => 'Name must have maximum :max characters',
                'email.required' => 'An E-Mail is required',
                'email.email' => 'The E-Mail format is not correct',
                'email.max' => 'The E-Mail must have maximum :max characters',
                'object.required' => 'An object is required',
                'object.min' => 'The object must have minimum :min characters',
                'object.max' => 'The object must have maximum :max characters',
                'message.required' => 'A message is required',
                'message.min' => 'The message must have minimum :min characters',
            ]
        );
    if($validator->fails()){
        $success = false;
        $errors = $validator->errors();
        return response()->json(compact('success','errors'));
    }

    //salvo i dati nel DB
    $new_lead = new Lead();
    $new_lead->fill($data);
    $new_lead->save();

    Mail::to('hello@example.com')->send(new NewContact($new_lead));

    return response()->json(compact('success'));
    }
}

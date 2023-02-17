<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required'],
            'estate_id' => ['exists:estates,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        };

        $newLead = Lead::create($data);
        //dd($newLead->estate);

        Mail::to($newLead->estate->user->email)->send(new NewContact($newLead));

        return response()->json([
            'success' => true,
        ]);
    }
}

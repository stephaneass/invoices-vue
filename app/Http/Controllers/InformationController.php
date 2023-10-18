<?php

namespace App\Http\Controllers;

use App\Http\Requests\InformationRequest;
use App\Mail\InformationMail;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InformationController extends Controller
{
    public function create()
    {
        $countries = Country::all();
        
        return view('informations', compact('countries'));
    }

    public function save(InformationRequest $request)
    {
        $emails = config('task.emails');

        Mail::to($emails)->send(new InformationMail($request));

        return 'Good';
    }
}

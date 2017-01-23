<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getContact()
    {
        return view('sections.contact');
    }

    public function postContact()
    {
        if (\Request::ajax()) {

            $data = [
                'name'  => \Request::get('name'),
                'email' => \Request::get('email'),
                'msg'   => \Request::get('msg'),
            ];
            $rules = [
                'name'  => 'required',
                'email' => 'required|email',
                'msg'   => 'required',
            ];
            $validator = \Validator::make($data, $rules);
            if ($validator->fails())
                return ['success' => false, 'errors' => $validator->getMessageBag()->toArray()];
            else {


                \Mail::send('emails.contact', $data, function ($message) use ($data) {
                    $message->to('ahmadalshugairi25@gmail.com', 'Your Website')
                        ->subject('Contact Message');
                });

                return ['success' => true];

            }
        }

    }
}

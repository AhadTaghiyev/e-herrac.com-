<?php

namespace App\Http\Controllers\Site;

use App\Mail\ContactMail;
use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\FormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function contact(FormRequest $request) {
        $data = array(
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->get('email'),
            'message'   =>   $request->input('message')
        );
        Mail::to(env('CONTACT_MAIL'))->send(new ContactMail($data));
        if($request->ajax()) {
            return response()->json(['success'=> true]);
        }
        return back()->with('success', trans('contact.success'));
    }

    public function vacancy(FormRequest $request) {
        dd($request->all());
        $data = array(
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->get('email'),
            'message'   =>   $request->input('message')
        );
        Mail::to(env('CONTACT_MAIL'))->send(new ContactMail($data));
        if($request->ajax()) {
            return response()->json(['success'=> true]);
        }
        return back()->with('success', trans('contact.success'));
    }


}

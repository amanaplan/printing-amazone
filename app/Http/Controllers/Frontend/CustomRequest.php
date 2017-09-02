<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;

use App\Product;
use App\Mail\ProductRequest;
use App\Mail\ContactRequest;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Facades\App\Http\HelperClass\Multipurpose;
use Illuminate\Support\Facades\Storage;

class CustomRequest extends Controller
{
	public function __construct()
	{

	}

	/**
	*send request for label & graphics
	*
	*/
	public function CustomProds(Request $request)
	{
        $validator = Validator::make($request->all(), [
            'product'       => 'required|alpha_dash|exists:products,product_slug',
            'name'          => 'required|min:5',
            'email'         => 'required|email',
            'phone'         => 'required',
            'address'		=> 'required',
            'desc'		    => 'required',
        ],[
            'exists' => 'product not found',
            'desc.required' => 'description is required'
        ]);

        if ($validator->fails()) {
        	$request->session()->flash('formError', 'Fillup the form properly');

            return redirect()->back()->withErrors($validator)->withInput();
        }

        /*-----------------------------------------------------------------------------------------------
        | send email to the admin
        -----------------------------------------------------------------------------------------------*/
        $request_info = collect([
            'name'          => $request->input('name'),
            'email'         => $request->input('email'),
            'phone'         => $request->input('phone'),
            'ip'            => $request->ip(),
            'company'       => $request->input('company'),
            'address'       => $request->input('address'),
            'description'   => $request->input('desc'),
            'product'       => Product::where('product_slug', $request->input('product'))->first()->product_name,
        ]);

        $mail_ids = Multipurpose::getMailIdsFor('order');
        Mail::to($mail_ids)->send(new ProductRequest($request_info));

		return redirect()->back()->with('request_ok', true);
	}

    /**
    *contact form submit
    */
    public function Contact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|min:5',
            'email'         => 'required|email',
            'attachment'    => 'nullable|max:10000',
            'message'       => 'required|min:10',
        ],[
            'attachment.size' => 'attachment size should be less than 10MB',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('formError', 'please fillup the form fields properly');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //recaptcha verification
        $recaptcha = Multipurpose::RecaptchaValid($request->ip(), $request->input('g-recaptcha-response'));
        if(! $recaptcha)
        {
            $request->session()->flash('formError', 'recaptcha verification unsuccessful, try again');
            return redirect()->back()->withInput();
        }

        /*-----------------------------------------------------------------------------------------------
        | send email to the admin
        -----------------------------------------------------------------------------------------------*/
        $fileurl = null;
        
        $form_data = [
            'name'          => $request->input('name'),
            'email'         => $request->input('email'),
            'subject'       => $request->input('subject'),
            'message'       => $request->input('message'),
            'ip'            => $request->ip(),
        ];

        if($request->hasFile('attachment'))
        {
            $fileurl = Storage::disk('public')->putFile('artworks', $request->file('attachment'));
            $form_data['attachment'] = Storage::disk('public')->url($fileurl);
        }

        $request_info = collect($form_data);

        $mail_ids = Multipurpose::getMailIdsFor('contact');
        Mail::to($mail_ids)->send(new ContactRequest($request_info));

        //delete the attachment from server
        if($fileurl)
        {
            Storage::disk('public')->delete($fileurl);
        }

        return redirect()->back()->with('request_ok', true);
    }

}

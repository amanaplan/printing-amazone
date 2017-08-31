<?php

namespace App\Http\Controllers\Backend;

use Auth;

use App\NotificationSetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SettingsCtrl extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the page
     */
    public function Visit()
    {
        $data = [
            'page'  => 'notification',
            'order' => NotificationSetting::ofType('order')->first()->mail_ids,
            'review' => NotificationSetting::ofType('review')->first()->mail_ids,
            'contact' => NotificationSetting::ofType('contact')->first()->mail_ids,
        ];
        return view('backend.settings-notification', $data);
    }

    /**
    *form submission
    */
    public function SaveSettings(Request $request)
    {
        $this->validate($request,[
            'order' => 'required',
            'review' => 'required',
            'contact' => 'required',
        ]);

        $order = NotificationSetting::ofType('order')->first();
        $contact = NotificationSetting::ofType('contact')->first();
        $review = NotificationSetting::ofType('review')->first();

        $order->mail_ids = $request->input('order');
        $order->save();

        $contact->mail_ids = $request->input('contact');
        $contact->save();

        $review->mail_ids = $request->input('review');
        $review->save();

        adminflash('success', 'settings saved');
        return redirect()->back();
    }

}

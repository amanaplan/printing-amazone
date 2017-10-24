<?php

namespace App\Http\Controllers\Frontend;

use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ReviewPosted;

use App\Review;
use App\Product;
use App\Admin;

//required for validation checking
use Validator;
use Illuminate\Validation\Rule;

//for password hashing
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image; //for image manupulation
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class UserRqstCtrl extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    *user sets initial password for account after signing up
    */
    public function InitPassword(Request $request)
    {
        if(Session::get('init_signup'))
        {
            $validator = Validator::make($request->all(), [
                'password'              => 'required|min:5',
                'retype-password'       => 'required|same:password',
            ]);


            if ($validator->fails()) {
                userflash('warning', 'incorrent input data');
                return redirect()->back()->withErrors($validator);
            }

            $user                   = \App\User::find(Auth::user()->id);
            $user->password         = Hash::make($request->input('password'));
            $user->save();

            Session::forget('init_signup');
            userflash('success', 'your account is ready');
            return redirect()->route('user.dashboard');
        }
        else
        {
            abort(404);
        }
    }

    /**
    *user update password request
    */
    public function ChangePasswd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current-password'      => 'required',
            'new-password'          => 'required|min:5',
            'retype-password'       => 'required|same:new-password',
        ]);


        if ($validator->fails()) {
            userflash('warning', 'form error please provide inputs properly');
            return redirect()->back()->withErrors($validator);
        }

        $curr_password  = $request->input('current-password');
        $curr_hashed    = Auth::user()->password;

        if (Hash::check($curr_password, $curr_hashed)) 
        {
            //current password is corrct process request
            $user                   = \App\User::find(Auth::user()->id);
            $user->password         = Hash::make($request->input('new-password'));
            $update = $user->save();
            if($update){
                userflash('success', 'your password successfully updated');
            }
            else
            {
                userflash('danger', 'server error! try later');
            }
        }
        else
        {
            userflash('warning', 'Denied! incorrect current password provided');
        }

        return redirect()->back();
    }

    /**
    *update user's profile pic & name
    */
    public function UpdateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full-name'     => 'required|min:5',
            'profile_pic'   => 'nullable|mimes:jpeg,png,jpg,gif',
            'mobile'        => ['required', 'regex:/^(\+{1})?\d+$/', 'min:6', 'max:20'],
            'birthday'      => ['required', 'regex:/^\d{4}\-\d{2}\-\d{2}$/'],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->except('profile_pic'));
        }

        //otherwise update profile info
        $user = \App\User::findorFail(Auth::id());
        $user->name         = $request->input('full-name');
        $user->mobile       = $request->input('mobile');
        $user->birthday     = $request->input('birthday');
        $user->state        = $request->input('state');
        $user->suburb       = $request->input('suburb');
        $user->post_code    = $request->input('post_code');
        $user->street       = $request->input('street');
        $user->company      = $request->input('company');



        //profile picture upload attempt
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $destinationPath = 'assets/images/users';
            $basename = $file->getClientOriginalName();
            $filename = pathinfo($basename,PATHINFO_FILENAME );
            $extension = $file->getClientOriginalExtension();

            //remove current profile picture if exist
            if(!empty(Auth::user()->photo) && file_exists($destinationPath.'/'.Auth::user()->photo))
            {
                unlink($destinationPath.'/'.Auth::user()->photo);
            }

            //if new file name matches exising image name then save as different name
            $save_as = (file_exists($destinationPath.'/'.$basename))? $filename.time().'.'.$extension : $basename;

            $file->move($destinationPath,$save_as);
            //crop
            $img = Image::make($destinationPath.'/'.$save_as)->resize(200, 200)->save($destinationPath.'/'.$save_as);

            $user->photo = $save_as;
        }

        if($user->save())
        {
            userflash('success', 'your profile successfully updated');
        }
        else
        {
            userflash('warning', 'server error! try later');
        }

        return redirect()->back();
    }

    /**
    *edit review request
    */
    public function EditReviewRq(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required|min:8|max:60',
            'description'   => 'required|min:10',
            'rating'        => 'required|numeric',
        ]);


        if ($validator->fails()) {
            userflash('warning', 'Error ! Incorrent input data');
            return redirect()->back()->withErrors($validator);
        }

        $review = Review::findOrFail($id);

        $owner = $review->user->id;
        if($owner != Auth::user()->id || $review->publish == 1)
        {
            userflash('danger', 'unauthorized access forbidden');
            return redirect()->back()->withErrors($validator);
        }

        $review->title          = $request->input('title');
        $review->description    = $request->input('description');
        $review->rating         = $request->input('rating');

        if($review->save())
        {
            userflash('success', 'Review updated successfully! it will be posted soon .');
            return redirect()->back();
        }
    }

    /**
    *add new review request
    */
    public function AddReviewRq(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product'       => 'required',
            'title'         => 'required|min:8|max:60',
            'description'   => 'required|min:10',
            'rating'        => 'required|numeric',
        ]);


        if ($validator->fails()) {
            userflash('warning', 'Error ! Incorrent input data');
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $review = new Review();
        $product = Product::findOrFail($request->input('product'));

        //check if user has pending review for the product
        $pendingReview = Review::where([['product_id', $product->id],['user_id', Auth::user()->id],['publish', 0]]);
        if($pendingReview->count() == 1)
        {
            userflash('warning', 'Sorry ! you already have one pending review for this product');
            return redirect()->back()->withInput();
        }
        //check if user has pending review for the product

        $review->product_id     = $product->id;
        $review->user_id        = Auth::user()->id;
        $review->title          = $request->input('title');
        $review->description    = $request->input('description');
        $review->rating         = $request->input('rating');

        if($review->save())
        {
            /** sending notification mail to admins **/
            $mailIds = Admin::where('active', 1)->select(['email'])->get();

            $rvwdata = [
                'title'         => $request->input('title'),
                'photo'         => getLoggedinCustomerPic(),
                'name'          => Auth::user()->name,
                'email'         => Auth::user()->email
            ];

            $common = [
                'linktoadmin'   => url('/admin/product/reviews/unpublished'),
                'logo_call'     => asset( 'assets/images/email-img/icon-cal.png' ),
                'logo_main'     => asset( 'assets/images/logo.png' ),
                'website'       => url('/')
            ];
            
            Mail::to($mailIds)->send(new ReviewPosted($rvwdata, $common));
            /** sending notification mail to admins **/

            userflash('success', 'Review submitted successfully! it will be posted soon .');
            return redirect('/user/my-reviews');
        }
    }

}

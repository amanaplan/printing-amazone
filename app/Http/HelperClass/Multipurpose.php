<?php

namespace App\Http\HelperClass;

use Auth;
use App\User;
use App\Category;
use App\Product;
use App\Review;
use App\NotificationSetting;

use Illuminate\Support\Facades\Redis;

use Illuminate\Support\Carbon;

class Multipurpose {

	public function __construct()
	{
		//if required use then
	}

	/**
	*returns profile image of the logged in customer
	*
	*/
	public function getCurrentUserPhoto()
	{
		if(Auth::guard('web')->check())
		{
			$photo = Auth::user()->photo;
			$userimg = (!empty($photo))? asset('assets/images/users').'/'.Auth::user()->photo : asset('assets/images/user.png');
		}
		else
		{
			$userimg = asset('assets/images/user.png');
		}

		return $userimg;
	}

	/**
	*returns profile image of the specific customer
	*
	*/
	public function getUserPhoto($id)
	{
		$user = User::findOrFail($id);
		$photo = $user->photo;
		$userimg = (!empty($photo))? asset('assets/images/users').'/'.$photo : asset('assets/images/user.png');

		return $userimg;
	}


	/**
	*generates cache of the category average rating
	*/
	public function setCategoryCache($id, $remember = (60 * 60 * 8))
	{
		$products = Product::where('category_id', $id)->select('id')->get();
        $givenreviews = Review::whereIn('product_id', $products)->published();
        $avgReview = $givenreviews->avg('rating');
        $totgiven = $givenreviews->count();
        if($avgReview > 0)
        {
            $break = explode('.', round($avgReview, 1));
            if(count($break) == 2)
            {
                $rounded = ($break[1] > 5)? round($avgReview) : $break[0] + 0.5;
                $averageRate = $rounded;
            }
            else
            {
                $averageRate = round($avgReview);
            }
        }
        else
        {
            $averageRate = null;
        }

        //caching the data
        $cacheRatingData = ['rating' => $averageRate, 'total' => $totgiven];
        $cacheRatingData = json_encode($cacheRatingData);
        Redis::set('category:id:'.$id.':rate', $cacheRatingData);
        Redis::command('expire', ['category:id:'.$id.':rate', $remember]);

        return $cacheRatingData;
	}

	/**
	*generates cache of the product average rating
	*/
	public function setProductCache($id, $getreviews = false, $remember = (60 * 60 * 8))
	{
        $givenreviews = Product::find($id)->review()->published();
        $totgiven = $givenreviews->count();
        $avgReview = $givenreviews->avg('rating');
        if($avgReview > 0)
        {
            $break = explode('.', round($avgReview, 1));
            if(count($break) == 2)
            {
                $rounded = ($break[1] > 5)? round($avgReview) : $break[0] + 0.5;
                $averageRate = $rounded;
            }
            else
            {
                $averageRate = round($avgReview);
            }
        }
        else
        {
            $averageRate = null;
        }


        //caching the data
        $cacheRatingData = ['rating' => $averageRate, 'total' => $totgiven];
        $cacheRatingData = json_encode($cacheRatingData);
        Redis::set('product:id:'.$id.':rate', $cacheRatingData);
        Redis::command('expire', ['product:id:'.$id.':rate', $remember]);

        $reviewItems = $givenreviews->latest()->with('user')->get();
        Redis::set('product:id:'.$id.':reviews', $reviewItems);
        Redis::command('expire', ['product:id:'.$id.':reviews', $remember]);

        if($getreviews == true)
        {
        	return $reviewItems;
        }
        else
        {
        	return $cacheRatingData;
        }
        
	}



    /**
    *returns array of appropriate mail ids
    *
    *@param notification type of App\NotificationSetting
    */
    public function getMailIdsFor($type='contact')
    {
        $comma_separated = NotificationSetting::ofType($type)->first()->mail_ids;
        $exploded_arr = explode(',', $comma_separated);

        $list_ids = [];
        foreach($exploded_arr as $mail)
        {
            $the_id = trim($mail);

            if(filter_var($the_id, FILTER_VALIDATE_EMAIL))
            {
                $list_ids[] = $the_id;
            }
        }

        if(count($list_ids) > 0)
        {
            return $list_ids;
        }
        else
        {
            $contact_ids = $this->getMailIdsFor();
            if(count($contact_ids) == 0)
            {
                return 'developer.srv1@gmail.com';
            }
            else
            {
                return $contact_ids;
            }
        }
    }


    /**
    *google recaptcha verification
    *
    *@param client ip address
    *@param recaptcha input data //$request->input('recaptcha');
    *
    *@return bool
    */
    public function RecaptchaValid($client_ip='127.0.0.1', $response)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array('secret' => config('services.recaptcha.secret'), 'response' => $response, 'remoteip' => $client_ip);
        
        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === false)
        {
            return false;
        }
        else
        {
            $google_res = json_decode($result, true);
            if($google_res['success'] === true)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    /**
     * calculate the delivery & printing dates
     */
    public function CalendarDates()
    {
        $printing = 4;
        $delivery = 5;

        $business_dates = [];

        for ($i = 0, $j = 0; $i <= 20; $i++)  //arbitarily picked as 20 days will be checkked & mapped for calendar dates
        {
            $currDate = ($i == 0) ? Carbon::tomorrow() : $currDate->addDay(); //for 1st iteration tomorrow otherwise add 1 day after tomorrow for each iteration
            
            if ($currDate->dayOfWeek === Carbon::SATURDAY || $currDate->dayOfWeek === Carbon::SUNDAY) 
            {
                continue;
            } 
            else if ($j < ($printing + $delivery) )
            {
                $j++;
                $business_dates[] = $currDate->format('jS M');
            } 
            else
            {
                break;
            }

        }

        // return $business_dates;

        return [
            'print' => $business_dates[0] . ' to ' . $business_dates[$printing-1], 
            'delivery' => $business_dates[$printing] . ' to ' . $business_dates[$printing + $delivery - 1]
        ];
    }
}

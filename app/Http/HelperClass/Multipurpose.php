<?php

namespace App\Http\HelperClass;

use Auth;
use App\User;
use App\Category;
use App\Product;
use App\Review;

use Illuminate\Support\Facades\Redis;

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
}
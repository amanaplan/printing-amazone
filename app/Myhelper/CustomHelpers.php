<?php

use App\Http\HelperClass\Multipurpose;

use Illuminate\Support\Facades\Session;

use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\Cookie\Factory as CookieFactory;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Broadcasting\Factory as BroadcastFactory;

/*if (! function_exists('userinfo')) {
    
    function userinfo($field)
    {
        return app(Multipurpose::class)->userdata($field);
    }
}*/


if (! function_exists('adminflash')) {
    
    function adminflash($type='info', $msg)
    {
        Session::flash('flashtype', $type);
        Session::flash('flashmsg', $msg);
    }
}

if (! function_exists('userflash')) {
    
    function userflash($type='info', $msg)
    {
        Session::flash('flashtype', $type);
        Session::flash('flashmsg', $msg);
    }
}

/**
*determines if multiple of the input number 
*/
if (! function_exists('ismultiple')) {
    
    function ismultiple($base, $curr)
    {
        if(fmod($curr, $base) == 0)
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
*returns only first name
*/
if (! function_exists('nickname')) {
    
    function nickname($name)
    {
        if(preg_match("/^(.+)\s(.+)?/", $name, $match))
        {
            return $match[1];
        }
        else
        {
            return $name;
        }
    }
}

if ( ! function_exists('ending_soon'))
{
    /**
    *whether coupon ending soon
    *
    *@param coupon ending timestamp
    *@param day rule default 3 
    */
    function ending_soon($end_date = null, $day = 3)
    {
        $seconds = $day * 86400;

        if($end_date == null)
        {
            return false;
        }
        else
        {
            if($end_date < (time() + $seconds))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
}

if ( ! function_exists('random_string'))
{
    /**
     * Create a Random String
     *
     * Useful for generating passwords or hashes.
     *
     * @param   string  type of random string.  basic, alpha, alnum, numeric, nozero, unique, md5, encrypt and sha1
     * @param   int number of characters
     * @return  string
     */
    function random_string($type = 'alnum', $len = 8)
    {
        switch ($type)
        {
            case 'basic':
                return mt_rand();
            case 'alnum':
            case 'numeric':
            case 'nozero':
            case 'alpha':
                switch ($type)
                {
                    case 'alpha':
                        $pool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'alnum':
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric':
                        $pool = '0123456789';
                        break;
                    case 'nozero':
                        $pool = '123456789';
                        break;
                }
                return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
            case 'unique': // todo: remove in 3.1+
            case 'md5':
                return md5(uniqid(mt_rand()));
            case 'encrypt': // todo: remove in 3.1+
            case 'sha1':
                return sha1(uniqid(mt_rand(), TRUE));
        }
    }
}

/**
*generate font awesome star rating map
*
*@param rating value
*/
function genRatedStar($rating)
{
    $rating = (preg_match("/\.0*$/", $rating))? floor($rating) : $rating;
    $starMap = '';

    if (!is_float($rating))
    {
        $floor = floor($rating);
        for($i=0; $i<$floor; $i++){
            $starMap .= '<i class="fa fa-star"></i> ';
        }
        $starMap .= '<i class="fa fa-star-half-o"></i> ';

        if($floor < 5 && $floor != 4)
        {
            for($i=0; $i< (5 - ($floor + 1)); $i++){
                $starMap .= '<i class="fa fa-star-o"></i> ';
            }
        }
    }
    else
    {
        for($i=0; $i< $rating; $i++){
            $starMap .= '<i class="fa fa-star"></i> ';
        }
        if($rating < 5)
        {
            for($i=0; $i< (5 - $rating); $i++){
                $starMap .= '<i class="fa fa-star-o"></i> ';
            }
        }
    }

    return $starMap;
}

/**
*get loggedin customer profile pic
*/
function getLoggedinCustomerPic()
{
    return app(Multipurpose::class)->getCurrentUserPhoto();
}

/**
*get specific customer profile pic
*/
function getTheCustomerPic($id)
{
    return app(Multipurpose::class)->getUserPhoto($id);
}


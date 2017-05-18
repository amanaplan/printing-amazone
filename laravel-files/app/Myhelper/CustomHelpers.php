<?php

//use App\Http\Srvmultipurpose\Multipurpose;

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

<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Order;
use App\OrderStatus;

use Illuminate\Support\Facades\DB;

class OrderCtrl extends Controller
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
     * Show the order management page
     */
    public function Visit(Request $request, $page)
    {
        $order_id = $request->input('order_id');
        $customer = $request->input('customer');
        $trans_id = $request->input('trans_id');
        $date_added = $request->input('date_added');

        $data = [
            'page'     => ($page == 'completed')? 'order_complete' : 'order_pending',
            'page_title'    => ($page == 'completed')? 'Completed Orders' : 'Pending Orders',
            'statuses'  => OrderStatus::all()
        ];
          

        $customer_found = 0;

        if($order_id || $customer || $trans_id || $date_added)
        {
            $common = DB::table('orders')
                    ->leftJoin('users', 'orders.user_id', '=', 'users.id')
                    ->join('order_status', 'order_status.id', '=', 'orders.status')
                    ->join('order_billing', 'order_billing.order_id', '=', 'orders.id');

            if($page == 'completed')
            {
                $common->where('status', 5);
            }
            else
            {
                $common->where('status', '!=', 5);
            }



            if($order_id)
            {
                $common->where('orders.order_token', $order_id);
            }
            if($trans_id)
            {
                $common->where('orders.transaction_id', $trans_id);
            }
            if($date_added)
            {
                $common->whereDate('orders.created_at', $date_added);
            }
            if($customer)
            {
                $query1 = DB::table('orders')
                          ->join('users', 'users.id', '=', 'orders.user_id')
                          ->where('users.name', 'like', '%'.$customer.'%')
                          ->orWhere('users.email', 'like', '%'.$customer.'%')
                          ->select('orders.id');

                $query2 = DB::table('orders')
                          ->join('order_billing', 'order_billing.order_id', '=', 'orders.id')
                          ->where('order_billing.name', 'like', '%'.$customer.'%')
                          ->orWhere('order_billing.email', 'like', '%'.$customer.'%')
                          ->select('orders.id');

                $order_ids = $query1->union($query2)->get();

                if($order_ids->count() > 0)
                {   
                    $id_arr = [];
                    foreach($order_ids as $row_id)
                    {
                        $id_arr[] = $row_id->id;
                    }

                    $customer_found = 1;

                    $common->whereIn('orders.id', $id_arr);
                }
            }

            $query = $common->select('orders.*', 'users.id as user_id', 'users.name as user_name','users.email as user_email', 'order_status.id as status_id', 'order_status.status_text', 'order_billing.name as billing_name', 'order_billing.email as billing_email');


            if($customer && $customer_found == 0)
            {
                $res = collect(null);
            }
            else
            {
                $res = $query->latest()->get();
            }

            $page = $request->input('page', 1);
            $perpage = 1;

            $offSet = ($page * $perpage) - $perpage;
            $itemsForCurrentPage = array_slice($res->toArray(), $offSet, $perpage, true);
            $res = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($res), $perpage, $page);

            $prefix = ($page == 'completed')? 'completed' : 'pending';
            $data['orders'] = $res->withPath($prefix.'?order_id='.$order_id.'&customer='.$customer.'&trans_id='.$trans_id.'&date_added='.$date_added);

            return view('backend.orders-list-search', $data);
        }
        else
        {
            if($page == 'completed')
            {
                $data['orders'] = Order::ofType('complete')->with(['user', 'orderStatus', 'billing'])->latest()->paginate(1);
            }
            else
            {
                $data['orders'] = Order::ofType('pending')->with(['user', 'orderStatus', 'billing'])->latest()->paginate(1);
            }

            return view('backend.orders-list', $data);
        }
        
    }


}

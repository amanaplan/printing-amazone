<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Order;
use App\OrderStatus;
use App\OrderItem;
use App\OrderArtworkApproval;
use Validator;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
                $common->whereIn('status', [5,6]);
            }
            else
            {
                $common->whereNotIn('status', [5,6]);
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
            $perpage = 5;

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
                $data['orders'] = Order::ofType('complete')->with(['user', 'orderStatus', 'billing'])->latest()->paginate(5);
            }
            else
            {
                $data['orders'] = Order::ofType('pending')->with(['user', 'orderStatus', 'billing'])->latest()->paginate(5);
            }

            return view('backend.orders-list', $data);
        }
        
    }


    /**
    *the order details page
    */
    public function OrderDetails($order_id)
    {
        $order = Order::findOrFail($order_id);

        $data = [
            'page'  => 'order_pending',
            'order' => $order,
            'statuses'  => OrderStatus::all(),
        ];

        return view('backend.order-details', $data);
    }

    /**
    *upload creted mock up based on user's provided artwork
    *and check if any further request changes
    */
    public function OrderArtworkApproval(Request $request, $order_id, $order_item_id)
    {
        $orderItem = OrderItem::findOrFail($order_item_id);

        $data = [
            'page'      => 'order_pending',
            'back_url'  => route('order.details', $order_id),
            'order_item'    => $orderItem,
            'order_id'  => $order_id,
            'item_id' => $order_item_id
        ];

        return view('backend.order-artwork-status', $data);
    }

    /**
    *admin change the default artwork provided by user
    */
    public function OrderModDefArtwork(Request $request, $order_id, $order_item_id)
    {
        $orderItem = OrderItem::findOrFail($order_item_id);
        abort_if($orderItem->order_id != $order_id, 401);

         $validator = Validator::make($request->all(), [
            'artwork'   => 'required|image'
        ]);

        if ($validator->fails()) {

            adminflash('warning', 'error, make sure uploaded file is a image');
            return redirect()->back();
        }

        //upload current image
        $artwork = Storage::disk('public')->putFile('artworks', $request->file('artwork'));

        //if file upload successful
        if ($request->file('artwork')->isValid())
        {
            //delete the current image if any
            if($orderItem->artwork)
            {
                Storage::disk('public')->delete($orderItem->artwork);
            }

            //store new file path in db
            $orderItem->artwork = $artwork;
            $orderItem->save();

            adminflash('success', 'artwork updated successfully');
        }
        else
        {
            adminflash('danger', 'file upload error, try again');
        }
        
        return redirect()->back();
    }

    /**
    *download artwork
    */
    public function DownloadArtwork(Request $request)
    {
        $this->validate($request,[
            'artwork'   => 'required'
        ]);

        return response()->download('storage/'.$request->input('artwork'));
    }


    /**
    *update order status
    */
    public function UpdateStatus(Request $request)
    {
        $this->validate($request,[
            'order' => 'required|exists:orders,id',
            'status' => 'required|exists:order_status,id'
        ]);

        $order = Order::find($request->input('order'));
        $order->status = $request->input('status');
        $order->save();

        adminflash('success', 'order status updated');
        return redirect()->back();
    }

    /**
    *order delete
    */
    public function DeleteOrder(Request $request)
    {
        $this->validate($request,[
            'order' => 'required|exists:orders,id',
        ]);

        $order = Order::find($request->input('order'));

        //delete artworks
        $items = $order->orderItems;
        foreach($items as $item)
        {
            if($item->artwork)
            {
                Storage::disk('public')->delete($item->artwork);
            }
        }

        //delete billing + items + order history
        $order->billing()->delete();
        $order->orderItems()->delete();
        $order->delete();

        adminflash('success', 'order deleted successfully');
        return redirect()->back();
    }

}

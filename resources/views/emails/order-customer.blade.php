<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
  </head>
  <body style="background: #dcdcdc; margin:0;">
    <div style="width: 750px; margin: 0 auto; background: #fff; padding: 12px 0 0;border-top: 5px solid #42b1b2;border-bottom: 5px solid #42b1b2;">
      <p style="font-family: 'Roboto Condensed', sans-serif; color: #000000;margin-top: 0; font-size: 15px; line-height: 20px; text-align: center;">YOUR ORDER ID - <span style="color: #fff;background: #7bb774;padding: 5px;">{{ $order_id }}</span> &amp; TRANSACTION ID - <span style="color: #fff;background: #7bb774;padding: 5px;">{{ $trans_id }}</span></p>
      <div style="background: #242424;padding: 30px 30px;">
        <div style="width: 200px;margin: 0px auto;"><a href="{{ $website }}"><img src="{{ $logo }}" style="width: 200px;margin: 0px auto;text-align: center;"></a></div>
         <div style="clear: both;"></div>         
      </div>
        <table width="100%" style="border-left: 1px solid #999;border-right: 1px solid #999; border-bottom: 1px solid #999; margin-top:0px; font-family: 'Roboto Condensed', sans-serif;" cellspacing="0" border="0">
           <thead style="background: #ccc;">
             <th style="padding: 10px 0;">PRODUCT</th><th>DESCRIPTION</th><th>SIZE</th><th>QTY</th><th>PRICE</th>
           </thead>
           <tbody style="text-align: center;">

           @foreach($items as $item)
             <tr>
              <td style="padding: 10px 0;border-bottom: 1px solid #999;">
                @php
                  $prod = \App\Product::find($item->product_id);
                  $paperstock = \App\OptPaperstock::find($item->paperstock)->option;
                @endphp
                <img src="{{ $prod_logo_dir.'/'.$prod->logo }}" width="50" style="display: block; border: 1px solid #bec0c2;margin: 0 auto;" border="0" alt="">
              </td>
               <td style="text-align: center;border-bottom: 1px solid #999;">
                  <h2 style="font-weight: bold; margin: 0px; font-size: 14px;font-family: 'Roboto Condensed', sans-serif; text-transform: uppercase;">{{ $prod->product_name }}</h2>
                  <span style="font-style: italic;font-size: 13px;">Paperstock- {{ $paperstock }}</span>
              </td>
               <td style="border-bottom: 1px solid #999;"><span style="font-family: 'Roboto Condensed', sans-serif; font-size: 14px; color: #303030;"">{{ $item->width }} x {{ $item->height }} mm<sup>2</sup></span></td>
               <td style="border-bottom: 1px solid #999;"><span style="font-family: 'Roboto Condensed', sans-serif; font-size: 14px; color: #303030;""> {{ $item->qty }}</span></td>
               <td style="border-bottom: 1px solid #999;"><span style="font-family: 'Roboto Condensed', sans-serif; font-size: 14px; color: #303030;""> $ {{ $item->price }}</span></td>
             </tr>
          @endforeach
             <tr>
               <td colspan="2" style="text-align: left; padding: 0; vertical-align: top;border-right: 1px solid #999;width: 60%;">
               <h2 style="background: #42b1b2; color: #fff; padding: 10px 30px; margin: 0; font-size: 20px; font-weight: 400;font-family: 'Roboto Condensed', sans-serif;">Shipping Address</h2>
               <p style="padding-left: 30px;">{{ $city }}, {{ $country }}, {{ $state }} - {{ $zipcode }}</p>
               <p style="padding-left: 30px; padding-right: 30px; margin-bottom: 0;">{{ $street }}</p>  
               <img src="{{ $delivery_img }}" width="142" style="display: block; margin: 0 auto 10px;" border="0">
               </td>
               <td colspan="4" style="text-align: left; font-weight: 600; padding: 0 10px 0 0; vertical-align: top;width: 40%;">
                 <table width="100%" cellpadding="0" cellspacing="0">
                   <tbody>
                     <tr>
                       <td><h2 style="padding: 10px 30px; margin: 0; font-size: 18px;font-family: 'Roboto Condensed', sans-serif;">Subtotal : </h2></td>
                       <td><span>$ {{ $subtotal }}.00</span></td>
                     </tr>
                     <tr>
                       <td><h2 style="padding: 10px 30px; margin: 0; font-size: 18px;font-family: 'Roboto Condensed', sans-serif;">Discount : </h2></td>
                       <td><span style="color: #4CAF50;">$ {{ $discount }}.00</span></td>
                     </tr>
                     <tr>
                       <td><h2 style="padding: 10px 30px; margin: 0; font-size: 18px;font-family: 'Roboto Condensed', sans-serif;">Shipping : </h2></td>
                       <td><span>$ 00.00</span></td>
                     </tr>
                     <tr>
                       <td><h2 style="padding: 10px 30px; margin: 0; text-transform: uppercase; font-size: 20px;font-family: 'Roboto Condensed', sans-serif;">Total Amount : </h2></td>
                       <td><span style="color: #42b1b2; font-size: 18px;">$ {{ $payable }}.00</span></td>
                     </tr>
                   </tbody>
                 </table>
               </td>
             </tr>
           </tbody>
         </table>
         <div style="background: #212121; padding: 15px 0; text-align: center;font-size: 15px;font-family: 'Roboto Condensed', sans-serif;">
           <h2 style="font-size: 20px; margin: 0; color: #fff;font-family: 'Roboto Condensed', sans-serif; font-weight: 400;">Support</h2>
           <p style="font-size: 15px; margin-bottom: 0; color: #999;font-family: 'Roboto Condensed', sans-serif;">If you have any questions or concerns, please feel free to email us : <a href="#" style="text-decoration: none; color: #ff0003;">info@printingamazon.com.au</a></p>
         </div>
    </div>
  </body>
</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
  </head>
  <body style="background: #dcdcdc; margin:0;">
  <div style="background: #fff; width:700px; margin: 0 auto; padding: 25px 20px;border-top:5px solid #42b1b2; border-bottom: 5px solid #42b1b2;">
   <div style="border:1px solid #ddd; text-align: center; background: #242424; padding: 15px 0;"><a href="{{ $website }}"><img src="{{ $logo }}" style="width: 200px; margin: 0 auto;"></a></div>
   <div style="border:1px solid #ddd; padding: 25px; margin: 20px 0;">
     <h2 style="font-family: 'Roboto Condensed', sans-serif; font-size: 25px; font-weight: 400; margin: 0;">Greetings, a new order has been placed just now</h2>
     <p style="font-family: 'Roboto Condensed', sans-serif; font-size: 16px; font-weight: 400; margin: 10px 0; color: #b2b2b2;">please check the admin panel for detailed information of the order - <span style="color: #000000;">ORDER ID#</span> <span style="color: #fff;background: #c1930a;padding: 8px;">{{ $order_id }}</span></p><hr style="margin: 30px auto 0;border-color: #ddd;border-width: 1px;border-style: solid;width: 60%;">
   </div>
   <table style="border: 1px solid #ebebeb; margin-bottom: 20px;" cellspacing="0" width="100%">
   	 <tbody>
   	 <tr>
   	 	<td style="padding: 10px 10px; margin-bottom: 10px; font-family: 'Roboto Condensed', sans-serif; font-size: 18px; font-weight: 600; margin: 0; border-bottom: 1px solid #ddd;">PRODUCT</td>
   	 	<td style="padding: 10px 10px;font-family: 'Roboto Condensed', sans-serif; font-size: 18px; font-weight: 600; margin: 0;border-bottom: 1px solid #ddd;">DESCRIPTION</td>
      <td style="padding: 10px 10px;font-family: 'Roboto Condensed', sans-serif; font-size: 18px; font-weight: 600; margin: 0;border-bottom: 1px solid #ddd;">SIZE</td>
      <td style="padding: 10px 10px;font-family: 'Roboto Condensed', sans-serif; font-size: 18px; font-weight: 600; margin: 0;border-bottom: 1px solid #ddd;">QTY</td>
   	 	<td style="padding: 10px 10px;font-family: 'Roboto Condensed', sans-serif; font-size: 18px; font-weight: 600; margin: 0;border-bottom: 1px solid #ddd;">Price</td>
   	 </tr>

     @foreach($items as $item)

      @php
        $prod = \App\Product::find($item->product_id);
        $paperstock = \App\OptPaperstock::find($item->paperstock)->option;
      @endphp

   	 	<tr>
   	 		<td align="center" valign="middle" bgcolor="#fcfcfc"><img width="80" src="{{ $prod_logo_dir.'/'.$prod->logo }}" style="display:block; margin: 10px 20px; line-height:0; font-size:0; border:0;max-width: 100%;"></td>
   	 		<td style="padding: 0 10px;">
   	 		  <h2 style="font-family: 'Roboto Condensed', sans-serif; font-size: 17px; font-weight: 400; margin: 0;">{{ $prod->product_name }}</h2>
   	 		  <p style="font-family: 'Roboto Condensed', sans-serif; font-size: 14px; font-weight: 400; margin: 10px 0; color: #b2b2b2;">Paperstock- {{ $paperstock }}</p>
   	 		</td>
   	 		<td style="padding: 0 10px;">
   	 		  <p style="font-family: 'Roboto Condensed', sans-serif; font-size: 15px; font-weight: 400; margin: 10px 0; color: #000000;">{{ $item->width }} x {{ $item->height }} mm<sup>2</sup></p>
   	 		</td>
        <td style="padding: 0 10px;">
          <p style="font-family: 'Roboto Condensed', sans-serif; font-size: 15px; font-weight: 400; margin: 10px 0; color: #000000;">{{ $item->qty }}</p>
        </td>
        <td style="padding: 0 10px;">
          <p style="font-family: 'Roboto Condensed', sans-serif; font-size: 15px; font-weight: 400; margin: 10px 0; color: #000000;">$ {{ $item->price }}</p>
        </td>
   	 	</tr>

      @endforeach

   	 </tbody>
   </table>

   <table style="border: 1px solid #ddd;" width="100%" cellspacing="0">
   	<tr>
   		<td colspan="2" style="text-align: left; padding: 0; vertical-align: top;border-right: 1px solid #ddd;width: 60%; padding: 20px 20px;">
   		 <table width="100%">
   		 	<tr>
   		 		<td width="100%" style="font-family: 'Roboto Condensed', sans-serif;"><strong style="display: inline-block; width: 40%; margin-bottom: 10px;">Full Name : </strong> {{ $name }}</td>
   		 	</tr>
   		 	<tr>
   		 		<td style="font-family: 'Roboto Condensed', sans-serif;"><strong style="display: inline-block; width: 40%; margin-bottom: 10px;">Email ID : </strong> {{ $email }}</td>
   		 	</tr>
   		 	<tr>
   		 		<td style="font-family: 'Roboto Condensed', sans-serif;"><strong style="display: inline-block; width: 40%; margin-bottom: 10px;">Phone : </strong> {{ $phone }}</td>
   		 	</tr>
   		 	<tr>
   		 		<td style="font-family: 'Roboto Condensed', sans-serif;"><strong style="display: inline-block; width: 40%; margin-bottom: 10px;">Address : </strong>
                <p>{{ $city }}, {{ $country }}, {{ $state }} - {{ $zipcode }}</p>
                <p>{{ $street }}</p>
          </td>
   		 	</tr>
   		 	<tr>
   		 	    <td style="font-family: 'Roboto Condensed', sans-serif;"><strong style="display: inline-block; width: 40%;">Company : </strong> {{ $company }}</td>
   		 	</tr>
   		 </table>
   		</td>
   		<td colspan="4" style="text-align: left; font-weight: 600; padding: 20px 10px 20px; vertical-align: top;width: 40%;">
                 <table width="100%" cellpadding="0" cellspacing="0">
                   <tbody>
                     <tr>
                       <td><h2 style="padding: 10px 20px; margin: 0; font-size: 18px;font-family: 'Roboto Condensed', sans-serif;">Subtotal : </h2></td>
                       <td><span style="font-family: 'Roboto Condensed', sans-serif;">$ {{ $subtotal }}.00</span></td>
                     </tr>
                     <tr>
                       <td><h2 style="padding: 10px 20px; margin: 0; font-size: 18px;font-family: 'Roboto Condensed', sans-serif;">Discount : </h2></td>
                       <td><span style="font-family: 'Roboto Condensed', sans-serif;">$ {{ $discount }}.00</span></td>
                     </tr>
                     <tr>
                       <td><h2 style="padding: 10px 20px; margin: 0; text-transform: uppercase; font-size: 20px;font-family: 'Roboto Condensed', sans-serif;">Total Amount : </h2></td>
                       <td><span style="color: #42b1b2; font-size: 18px;font-family: 'Roboto Condensed', sans-serif;">$ {{ $payable }}.00</span></td>
                     </tr>
                   </tbody>
                 </table>
               </td>
   	</tr>
   </table>


  </div>
  </body>
</html>



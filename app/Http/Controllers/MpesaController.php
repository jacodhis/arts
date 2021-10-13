<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Safaricom\Mpesa\Mpesa;

class MpesaController extends Controller
{
    //
    public function stk(Request $request){
        // dd($request->all());
        // $CallBackURL = 'http://26937c7b44a7.ngrok.io';
        
        // dd($request->all());

            $BusinessShortCode = env('SHORTCODE');
            $LipaNaMpesaPasskey = env('PASSKEY');
            $TransactionType = 'CustomerPayBillOnline';
            $Amount = $request->amount;
            $PartyA = $request->phone;
            $PartyB = env('SHORTCODE');
            $PhoneNumber = $request->phone;
            // $CallBackURL = 'http://491b-105-163-200-73.ngrok.io/folder/callback.php';
            $CallBackURL = 'https://a690-105-163-250-163.ngrok.io/folder/callback.php';
            $AccountReference = 'art-gallery-payment';
            $TransactionDesc = 'Payment product X';
            $Remarks = 'Payment Succefull!';

            $mpesa= new Mpesa();

           $stkPushSimulation=$mpesa->STKPushSimulation(
            $BusinessShortCode,
            $LipaNaMpesaPasskey,
            $TransactionType,
            $Amount,
            $PartyA,
            $PartyB,
            $PhoneNumber,
            $CallBackURL,
            $AccountReference,
            $TransactionDesc,
            $Remarks
        );
        $senddata = json_encode($stkPushSimulation);

        return $senddata;
            // $this->getDataFromCallback();
    }


}

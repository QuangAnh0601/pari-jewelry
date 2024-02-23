<?php

namespace App\Http\Repositories;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalRepository
{
    public function requestPayment ($data)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $total_price = $data->total_price;
        $USDPrice = $this->convertCurrencyVNDtoUSD($total_price);
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => "http://paris.jewelry.com/checkout/paymentSuccess",
                'cancel_url' => "http://paris.jewelry.com/checkout/paymentCancel"
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        'currency_code' => "USD",
                        "value" => $USDPrice
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve')
                {
                    return redirect()->away($links['href']);
                }
            }
            return redirect('/checkout')->with('error', 'some thing went wrong !');
        }
        else
        {
            return redirect('/checkout')->with('error', $response['message'] ?? 'some thing went wrong !');
        }
    }
    public function paymentSuccess ($data)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($data['token']);
        if(isset($response['status']) && $response['status'] == 'COMPLETED')
        {
            return redirect('/checkout/success')->with('success', 'transaction complete.');
        }
        else
        {
            return redirect('/checkout')->with('error', $response['message'] ?? 'some thing went wrong !');
        }
    }

    public function paymentCancel ()
    {
        return redirect('/checkout')->with('error', $response['message'] ?? 'you have canceled the transaction !');
    }

    function convertCurrencyVNDtoUSD($amountVND) {
        // Tỷ giá hối đoái hiện tại (thay đổi theo thời điểm)
        $exchangeRate = 0.000043; // Ví dụ: 1 VNĐ = 0.000043 USD
    
        // Chuyển đổi
        $amountUSD = $amountVND * $exchangeRate;
    
        // Làm tròn đến 2 chữ số thập phân
        $amountUSD = round($amountUSD, 2);
    
        return $amountUSD;
    }
}
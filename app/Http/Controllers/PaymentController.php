<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

use Illuminate\Http\Request;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $paypalconfig = Config::get(key: 'paypal');

        $this->apicontext = new ApiContext(
            new OAuthTokenCredential(
                $paypalconfig['client_id'],
                $paypalconfig['secret']
            )
        );
    }

    public function payWithPayPal() 
    {
        return 'devuelveme algo';
    }
    //
}

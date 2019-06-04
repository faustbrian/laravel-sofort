<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Sofort.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers;

use Artisanry\Sofort\Facades\Sofort;

class PaymentController extends Controller
{
    public function index()
    {
        Sofort::setAmount(10.21);
        Sofort::setCurrencyCode('EUR');
        Sofort::setReason('Testueberweisung', 'Verwendungszweck');
        Sofort::setSuccessUrl('YOUR_SUCCESS_URL', true); // i.e. http://my.shop/order/success
        Sofort::setAbortUrl('YOUR_ABORT_URL');
        // Sofort::setSenderSepaAccount('SFRTDE20XXX', 'DE06000000000023456789', 'Max Mustermann');
        // Sofort::setSenderCountryCode('DE');
        // Sofort::setNotificationUrl('YOUR_NOTIFICATION_URL', 'loss,pending');
        // Sofort::setNotificationUrl('YOUR_NOTIFICATION_URL', 'loss');
        // Sofort::setNotificationUrl('YOUR_NOTIFICATION_URL', 'pending');
        // Sofort::setNotificationUrl('YOUR_NOTIFICATION_URL', 'received');
        // Sofort::setNotificationUrl('YOUR_NOTIFICATION_URL', 'refunded');
        Sofort::setNotificationUrl('YOUR_NOTIFICATION_URL');
        //Sofort::setCustomerprotection(true);
        Sofort::sendRequest();

        if (Sofort::isError()) {
            // SOFORT-API didn't accept the data
            dd(Sofort::getError());
        } else {
            // get unique transaction-ID useful for check payment status
            $transactionId = Sofort::getTransactionId();

            // buyer must be redirected to $paymentUrl else payment cannot be successfully completed!
            $paymentUrl = Sofort::getPaymentUrl();
            redirect($paymentUrl);
        }
    }
}

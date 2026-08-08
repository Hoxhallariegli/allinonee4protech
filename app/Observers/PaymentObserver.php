<?php

namespace App\Observers;

use App\Models\BerberApp\Payment;
use App\Models\BerberApp\Customer;

class PaymentObserver
{
    public function saved(Payment $payment)
    {
        $this->updateTotalSpend($payment->customer_id);
    }

    public function deleted(Payment $payment)
    {
        $this->updateTotalSpend($payment->customer_id);
    }

    protected function updateTotalSpend($customerId)
    {
        $customer = Customer::find($customerId);
        if ($customer) {
            $total = Payment::where('customer_id', $customerId)
                ->where('status', 'completed')
                ->sum('amount');

            $customer->update(['total_spend' => $total]);
        }
    }
}

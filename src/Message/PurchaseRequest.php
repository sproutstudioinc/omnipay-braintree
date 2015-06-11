<?php
namespace Sproutstudioinc\Braintree\Message;

use Braintree;

class PurchaseRequest extends AbstractRequest
{

    public function getData()
    {
        $this->validate('amount');
        $data['amount'] = $this->getAmount();
        $data['creditCard'] = $this->getCardData();
        $data['options'] = array(
            'submitForSettlement' => true,
        );

        return $data;
    }

    public function sendData($data)
    {
        $response = Braintree\Transaction::sale($data);
        return $this->response = new Response($this, $response);
    }

}

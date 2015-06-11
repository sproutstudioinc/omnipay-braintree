<?php
namespace Sproutstudioinc\Braintree\Message;

use Braintree;

class AuthorizeRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount');
        $data['amount'] = $this->getAmount();
        $data['creditCard'] = $this->getCardData();
        return $data;
    }

    public function sendData($data)
    {
        $response = Braintree\Transaction::sale($data);
        return $this->response = new Response($this, $response);
    }
}

<?php
namespace Sproutstudioinc\Braintree\Message;

class VoidRequest extends AbstractRequest
{
    public function getData()
    {
        return $this->getTransactionId();
    }

    public function sendData($data)
    {
        $response = Braintree\Transaction::void($data);
        return $this->response = new Response($this, $response);
    }
}

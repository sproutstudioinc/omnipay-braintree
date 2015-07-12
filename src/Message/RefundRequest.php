<?php
namespace Omnipay\Braintree\Message;

use Braintree;

class RefundRequest extends AbstractRequest
{

    public function getData()
    {
        $data = array();
        $this->validate('amount');
        $data['amount'] = $this->getAmount();
        $data['transactionId'] = $this->getTransactionId();
        return $data;
    }

    public function sendData($data)
    {
        $response = Braintree\Transaction::refund($data['transactionId'], $data['amount']);
        return $this->response = new Response($this, $response);
    }

}

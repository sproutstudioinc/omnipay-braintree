<?php
namespace Sproutstudioinc\Braintree\Message;

use Braintree;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = '';
    protected $testEndpoint = '';

    public function initialize(array $parameters = array())
    {
        $parentInitialize = Parent::initialize($parameters);
        Braintree\Configuration::reset();
        Braintree\Configuration::environment($this->getTestMode());
        Braintree\Configuration::merchantId($this->getMerchantId());
        Braintree\Configuration::publicKey($this->getPublicKey());
        Braintree\Configuration::privateKey($this->getPrivateKey());

        return $parentInitialize;
    }

    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getPublicKey()
    {
        return $this->getParameter('publicKey');
    }

    public function setPublicKey($value)
    {
        return $this->setParameter('publicKey', $value);
    }

    public function getPrivateKey()
    {
        return $this->getParameter('privateKey');
    }

    public function setPrivateKey($value)
    {
        return $this->setParameter('privateKey', $value);
    }

    protected function getCardData()
    {
        $this->getCard()->validate();

        $card = array();
        $card['number'] = $this->getCard()->getNumber();
        $card['expirationDate'] = $this->getCard()->getExpiryDate('m') . '/' . $this->getCard()->getExpiryDate('y');

        return $card;
    }

}

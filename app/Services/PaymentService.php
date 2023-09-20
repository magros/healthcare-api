<?php

namespace App\Services;

use Openpay;

class PaymentService
{
    protected $openpay;

    public function __construct()
    {
//        Openpay::setId('m5oq4nxdnrjsdgaxswis');
//        Openpay::setApiKey('sk_6d78f1c080a94bbfb683c31a8f8b28da');

//        Openpay::setProductionMode(true);

        $this->openpay = Openpay::getInstance('m5oq4nxdnrjsdgaxswis', 'sk_6d78f1c080a94bbfb683c31a8f8b28da');
    }

    public function addCustomer($data)
    {
        $customerData = [
            'name' => 'Teofilo',
            'last_name' => 'Velazco',
            'email' => 'teofilo@payments.com',
            'phone_number' => '4421112233',
            'address' => [
                'line1' => 'Privada Rio No. 12',
                'line2' => 'Co. El Tintero',
                'line3' => '',
                'postal_code' => '76920',
                'state' => 'Querétaro',
                'city' => 'Querétaro.',
                'country_code' => 'MX'
            ]
        ];

        $customer = $this->openpay->customers->add($customerData);

        return $customer;
    }

    public function getCustomer($id)
    {
        return $this->openpay->customers->get($id);
    }

    public function getCustomers($data = [])
    {
        return $this->openpay->customers->getList($data);
    }

    public function addCharge($data)
    {
        return $this->openpay->charges->create($data);
    }
}

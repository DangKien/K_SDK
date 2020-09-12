<?php
/**
 * Created by ngankt2@gmail.com
 * Website: https://techhandle.net
 */

namespace BizflyCrmSdk\Resources;



class Customer extends Table
{
    /** @var string */
    private $table;
    private $mapping = [
        'phones',
        'emails'
    ];



    public function __construct($client)
    {
        $this->table = 'data_customer';
        parent::setClient($client);
    }



}
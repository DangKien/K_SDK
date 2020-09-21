<?php

namespace BizflyCrmSdk\Resources;



class Product extends Table
{
    /** @var string */

    private $table = 'data_product';
    private $mapping = [
        'phones',
        'emails'
    ];

    public function __construct($client)
    {
        parent::__construct($this->table,$client);
    }



}

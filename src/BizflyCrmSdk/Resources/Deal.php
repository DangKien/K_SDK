<?php

namespace BizflyCrmSdk\Resources;



class Deal extends Table
{
    /** @var string */

    private $table = 'data_deal';
    private $mapping = [
        'phones',
        'emails'
    ];

    public function __construct($client)
    {
        parent::__construct($this->table,$client);

    }



}

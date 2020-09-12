<?php
/**
 * Created by ngankt2@gmail.com
 * Website: https://techhandle.net
 */

namespace BizflyCrmSdk\Resources;



class Product extends Table
{
    /** @var string */

    private $table;
    private $mapping = [
        'phones',
        'emails'
    ];

    public function __construct($client)
    {
        $this->table = 'data_deal';
        parent::setClient($client);
    }



}
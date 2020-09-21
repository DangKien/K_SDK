<?php


namespace BizflyCrmSdk\Resources;



class Activity extends Table
{
    /** @var string */

    private $table = 'data_activity';
    private $mapping = [
        'phones',
        'emails'
    ];

    public function __construct($client)
    {
        parent::__construct($this->table,$client);
    }



}

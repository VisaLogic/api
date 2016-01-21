<?php

namespace VisaLogic\Resources;

use Http\Factory as Http;

class Resource
{
    public $storage;

    public function __construct($data)
    {
        foreach($data as $key => $value)
        {
            $this->{$key} = $value;
        }
    }
}

<?php

namespace VisaLogic\Resources;

class Order extends Resource
{
    public function __construct($data)
    {
        parent::__construct($data);

        $this->applications = [];
    }

    public function addApplication($data)
    {        
        $this->applications = array_merge(
            $this->applications,
            [
                new Application($data)
            ]
        );
    }
}

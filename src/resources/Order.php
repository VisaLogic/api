<?php

namespace VisaLogic\Resources;

class Order extends Resource
{
    public function __construct($data)
    {
        parent::__construct($data);

        $this->applications = [];

        $this->applications = json_decode(json_encode($this->applications));
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

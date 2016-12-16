<?php

namespace VisaLogic\Resources;

use Http\Factory as Http;

class Resource
{
    /**
     * Set all the resource's properties passed through the constructor.
     *
     * @param  array  $data
     * @return void
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}

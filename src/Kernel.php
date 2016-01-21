<?php

namespace VisaLogic;

use Http\Factory as Http;

class Kernel
{
	private $apiUrl = 'http://api.visalogic.dev/api';
	protected $apiKey;
    protected $setStatusCode;

	public function get($resource, $params = [])
	{
        if(isset($params['id']))
            $resource .= '/' . $params['id'];

		$url = $this->apiUrl . '/' . $resource . '?apiKey=' . $this->apiKey;
        $response = Http::get($url, $params);

        $this->setHttpStatusCode($response);

        return $response->response;
	}

    public function post($resource, $params = [])
    {
        $url = $this->apiUrl . '/' . $resource . '?apiKey=' . $this->apiKey;
        
        // die(var_dump(serialize($params)));
        $response = Http::post($url, $params);

        $this->setHttpStatusCode($response);

        return $response->response;
    }

    private function setHttpStatusCode($response)
    {
        if($this->setStatusCode)
            header(
                'Content-Type: application/json',
                true,
                $response->request_info->http_code
            );
    }
}

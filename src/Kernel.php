<?php

namespace VisaLogic;

use Http\Factory as Http;

class Kernel
{
	private $apiUrl = 'https://secure.visalogic.nl/api';
	protected $apiKey;
    protected $setStatusCode;

	public function get($resource, $params = [], $returnPlain = false)
	{
        if(isset($params['id']))
            $resource .= '/' . $params['id'];

		$url = $this->apiUrl . '/' . $resource . '?apiKey=' . $this->apiKey;

        $response = Http::get($url, $params, $returnPlain);

        if ($returnPlain) return $response;

        $this->setHttpStatusCode($response);

        return $response->response;
	}

    public function post($resource, $params = [], $returnPlain = false)
    {
        $url = $this->apiUrl . '/' . $resource . '?apiKey=' . $this->apiKey;

        $response = Http::post($url, $params);

        if ($returnPlain) return $response;

        $this->setHttpStatusCode($response);

        return $response->response;
    }

    private function setHttpStatusCode($response)
    {
        header(
            'Content-Type: application/json',
            true,
            $response->request_info->http_code
        );
    }
}

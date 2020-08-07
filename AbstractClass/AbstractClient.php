<?php


namespace SwarfarmClient\AbstractClass;


use SwarfarmClient\Exception\ClientException;

class AbstractClient
{
    const SWARFARM_API_URL = "https://swarfarm.com/api/v2/";
    const TOLERATED_HTTP_CODES = [
        200, 201
    ];

    /**
     * @param array $data
     * @return string
     */
    protected function generateQuerySetFromArray(array $data) : string
    {
        return '?' . implode(
            '&',
            array_map(
                function($k, $v) {
                    return $k . '=' . $v;
                },
                array_keys($data),
                array_values($data)
            )
        );
    }

    /**
     * @param string $url
     * @param string $verb
     * @param array|null $data
     * @return array
     * @throws ClientException
     */
    protected function requestApi(string $url, string $verb = 'GET', ?array $data = null) : array
    {
        $url = self::SWARFARM_API_URL . $url;
        $content = ($data !== null ? json_encode($data) : '');

        if (extension_loaded('curl')) {
            return $this->requestWithCurl($url, $verb, $content);
        } else if (ini_get('allow_url_fopen')) {
            return $this->requestWithoutCurl($url, $verb, $content);
        } else {
            throw new ClientException("curl or fopen must be used");
        }
    }

    /**
     * Request with curl
     * @param string $url
     * @param string $verb
     * @param string $content
     * @return array
     * @throws ClientException
     */
    private function requestWithCurl(string $url, string $verb, string $content) : array
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $verb,
            CURLOPT_POSTFIELDS => $content,
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "cache-control: no-cache",
                "content-type: application/json",
            ],
        ]);

        $response = curl_exec($ch);

        if ($curlError = curl_errno($ch)) {
            throw new ClientException("Curl error n°" . $curlError);
        } else {
            if (in_array(curl_getinfo($ch, CURLINFO_HTTP_CODE), self::TOLERATED_HTTP_CODES)) {
                return json_decode($response, true);
            } else {
                throw new ClientException("HTTP Error : " . curl_getinfo($ch, CURLINFO_HTTP_CODE));
            }
        }
    }

    /**
     * Request with fopen
     * @param string $url
     * @param string $verb
     * @param string $content
     * @return array
     * @throws ClientException
     */
    private function requestWithoutCurl(string $url, string $verb, string $content) : array
    {
        $opts = [
            'http' => [
                'method'    =>  $verb,
                'header'    =>  "Accept: application/json\r\n" .
                    "Content-Type: application/json",
                'content'   =>  $content,
                'ignore_errors' => true,
            ]
        ];
        $context = stream_context_create($opts);
        $response = file_get_contents($url, false, $context);
        $httpResponseStatus = $http_response_header[0] ?? null;
        preg_match('{HTTP\/\S*\s(\d{3})}', $httpResponseStatus, $statusCode);
        if ($response === false) {
            throw new ClientException("Raised exception : can't get informations with fopen.");
        } else if (!in_array($statusCode[1], self::TOLERATED_HTTP_CODES)) {
            throw new ClientException("HTTP Error : " . $statusCode[1]);
        } else {
            return json_decode($response, true);
        }
    }

}
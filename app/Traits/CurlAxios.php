<?php

namespace App\Traits;

trait CurlAxios
{
    use ApiResponse;

    function makeCurlRequest($url, $method , $key, ?array $data = null)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer {$key}",
                "Cache-Control: no-cache",
            ),
        ));

        if ($method === 'POST') {
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $this->fail("cURL Error: " . $err);
        }

        return $response;
    }
}

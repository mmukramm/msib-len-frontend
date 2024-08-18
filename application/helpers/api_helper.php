<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('callAPI')) {
    /**
     * Call API using cURL
     * 
     * @param string $method The HTTP method (GET, POST, PUT, DELETE)
     * @param string $url The URL to call
     * @param array|object|null $data The data to send with the request (if any)
     * @param array $headers Optional HTTP headers to send with the request
     * 
     * @return array The decoded JSON response or an error message
     */
    function callAPI($method, $url, $data = false, $headers = array())
    {
        $curl = curl_init();

        switch (strtoupper($method)) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, true);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                break;
            default: // GET
                if ($data) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
        }

        // Set default headers
        $defaultHeaders = array(
            'Content-Type: application/json',
        );

        $allHeaders = array_merge($defaultHeaders, $headers);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $allHeaders);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Execute request
        $result = curl_exec($curl);

        // Handle errors
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            return array('error' => true, 'message' => $error_msg);
        }

        curl_close($curl);
        return json_decode($result, true);
    }
}

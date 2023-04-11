<?php
namespace Api;

class SportController
{
    static $API_TOKEN = "ac764fc58a0b47da95c45109231104";
    static $LOCATION = "United States";
    static $BASE_URL = "http://api.weatherapi.com/v1/sports.json";
    private $requestMethod;
    private $path;

    public function __construct($requestMethod, $path)
    {
        $this->requestMethod = $requestMethod;
        $this->path = $path;
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->path === "soccerSchedule") {
                    $response = $this->getSportSchedule();
                }
                break;
            default:
                $response = null;
                break;
        }

        if ($response) {
            header('HTTP/1.1 200 OK');
        } else {
            header('HTTP/1.1 404 Not Found');
        }
        echo json_encode($response);
    }

    private function getSportSchedule()
    {
        $params = array(
            'key' => self::$API_TOKEN,
            'q' => self::$LOCATION
        );
        return $this->getExternalApi($params);
    }

    private function getExternalApi($params)
    {
        // Initialize curl
        $curl = curl_init();

        // Set curl options
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => self::$BASE_URL . '?' . http_build_query($params),
                // set the URL and query parameters
                CURLOPT_RETURNTRANSFER => true,
                // return the response as a string
                CURLOPT_FOLLOWLOCATION => true,
                // follow redirects
            )
        );

        // Send the request and get the response
        $response = curl_exec($curl);

        // Check for errors
        if ($response === false) {
            $error = curl_error($curl);
            // handle the error
        }

        // Close curl
        curl_close($curl);

        // Process the response
        $data = json_decode($response, true); // assuming the response is in JSON format
        return $data;
    }
}
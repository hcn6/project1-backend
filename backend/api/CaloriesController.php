<?php
namespace Api;

class CaloriesController
{
    static $BASE_URL = "https://api.calorieninjas.com/v1/nutrition";
    static $API_KEY = "vv8uXiPcoeLU5Fkv6LLtYg==Ink0nIkL6CzeeSGO";
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
            case 'POST':
                if ($this->path === "nutritionFact") {
                    // var_dump($_POST);
                    $query = json_decode(file_get_contents('php://input'));
                    $response = $this->getNutritionFact($query->query);
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

    private function getNutritionFact($query) {
        $params = array(
            "query" => $query,
        );
        return $this->getExternalApi($params)['items'];
    }

    private function getExternalApi($params)
    {
        // Initialize curl
        $curl = curl_init();
        $header = array(
            'X-Api-Key: '.self::$API_KEY,
            'Content-Type: application/json'
        );
        // Set curl options
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => self::$BASE_URL . '?' . http_build_query($params),
                //set header
                CURLOPT_HTTPHEADER => $header,
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
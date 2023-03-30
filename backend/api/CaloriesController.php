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
            case 'GET':
                if ($this->path === "allClass") {
                    $response = $this->getAllClass();
                }
                if ($this->path === "schedule") {
                    $response = $this->generateSchedule();
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

    public 
}
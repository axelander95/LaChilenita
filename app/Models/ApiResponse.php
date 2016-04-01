<?php 
namespace App\Models;
class ApiResponse
{
    public $error, $message, $data;
    public function __construct ($error, $message, $data)
    {
        $this->error = $error;
        $this->message = $message;
        $this->data = $data;
    }
}
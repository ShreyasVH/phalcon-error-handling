<?php


namespace app\responses;


class Response
{
    public bool $success;
    public ?object $data;
    public string $message;

    public function __construct($data, $success, $message)
    {
        $this->data = $data;
        $this->success = $success;
        $this->message = $message;
    }

    public static function withError(string $message)
    {
        return new Response(null, false, $message);
    }

    public static function withData(object $data)
    {
        return new Response($data, true, "");
    }
}
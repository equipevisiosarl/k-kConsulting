<?php

namespace phpFx\routerFx;
class Response
{
    private $statusCode;
    private $headers = [];
    private $content;

    public function __construct($content = '', $statusCode = 200, $headers = [])
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function setHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }

    public function send()
    {
        $this->sendHeaders();
        $this->sendContent();
    }

    public function sendHeaders()
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
    }

    public function sendContent()
    {
        echo $this->content;
    }

    public function json_send($data, $statusCode = 200, $headers = [])
    {
        $headers['Content-Type'] = 'application/json';
        $this->setStatusCode($statusCode);
        $this->setHeaders($headers);
        $this->setContent(json_encode($data));
        $this->send();
    }

    // Ajoutez d'autres méthodes selon vos besoins...

    private function setHeaders($headers)
    {
        foreach ($headers as $name => $value) {
            $this->setHeader($name, $value);
        }
    }
}

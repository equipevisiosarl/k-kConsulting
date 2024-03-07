<?php

namespace phpFx\routerFx;

class Request
{
    /** check which post method was used **/
	public function methodRequest():string
	{
		return strtoupper($_SERVER['REQUEST_METHOD']);
	}


	/** get a value from the POST variable **/
	public function post(string $key = '', mixed $default = ''):mixed
	{

		if(empty($key))
		{
			return $_POST;
		}else
		if(isset($_POST[$key]))
		{
			return $_POST[$key];
		}

		return $default;
	}

	/** get a value from the FILES variable **/
	public function files(string $key = '', mixed $default = ''):mixed
	{

		if(empty($key))
		{
			return $_FILES;
		}else
		if(isset($_FILES[$key]))
		{
			return $_FILES[$key];
		}

		return $default;
	}

	/** get a value from the GET variable **/
	public function get(string $key = '', mixed $default = ''):mixed
	{

		if(empty($key))
		{
			return $_GET;
		}else
		if(isset($_GET[$key]))
		{
			return $_GET[$key];
		}

		return $default;
	}

    /** get a value from the json variable **/
	public function json(string $key = '', mixed $default = ''):mixed
	{
        $json = json_decode(file_get_contents('php://input'), true);

		if(empty($key))
		{
			return $json;
		}else
		if(isset($json[$key]))
		{
			return $json[$key];
		}

		return $default;
	}

	/** get a value from the REQUEST variable **/
	public function input(string $key, mixed $default = ''):mixed
	{

		if(isset($_REQUEST[$key]))
		{
			return $_REQUEST[$key];
		}

		return $default;
	}

	/** get all values from the REQUEST variable **/
	public function Request():mixed
	{

		return $_REQUEST;

	}


    public function isMethod($method) : bool
    {
        return strtoupper($_SERVER['REQUEST_METHOD']) === strtoupper($method);
    }

    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }


    public function uri() : string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function userAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    public function referer()
    {
        return $_SERVER['HTTP_REFERER'] ?? null;
    }

    public function ipAddress()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    public function isSecure()
    {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    }

    public function getHeaders()
    {
        return getallheaders();
    }

    public function allRequest() : array
    {
        return [
            'get' => $this->get(),
            'post' => $this->post(),
            'files' => $this->files(),
            'json' => $this->json(),
        ];
    }

	/** unset REQUEST variable **/
	public function unset_post(string $key)
	{

		if(isset($_POST[$key]))
		{
			unset($_POST[$key]) ;
		}

	}
}

<?php
namespace App\Library;

class ResponseEstructure
{
	private $response;
	private $messages;
	private $data;

	public function __construct()
	{
		$this->response = false;

		$this->messages = array(
			"messages_errors"=>array(),
			"messages_success"=>array()
		);

		$this->private = array();
	}

	public function set_response($response)
	{
		$this->response = $response;
	}

	public function get_response()
	{
		return $this->response;
	}

	public function set_data($data)
	{
		$this->data = $data;
	}

	public function get_data()
	{
		return $this->data;
	}

	public function add_message_error($message)
	{
		$this->messages["messages_errors"][] = $message;
	}

	public function add_message_success($message)
	{
		$this->messages["messages_success"][] = $message;
	}

	public function get_response_array()
	{
		return array(
			"response"=>$this->response,
			"messages_success"=>$this->messages["messages_success"],
			"messages_errors"=>$this->messages["messages_errors"],
			"data"=>$this->data,
		);
	}
}
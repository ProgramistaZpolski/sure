<?php

namespace Sure;

class TestRunner
{
	protected array $urls = [];
	public function url(String $url, Int $statuscode = 200)
	{
		array_push($this->urls, [
			"url" => $url,
			"status" => $statuscode,
			"failed" => false
		]);
	}
	public function test()
	{
		$data = json_encode($this->urls);
		$bg = require_once "Master.bg.php";
		return require_once "Master.view.php";
	}
}

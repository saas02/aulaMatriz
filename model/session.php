<?php session_start();

class Session
{
	protected $session = array();

	public function __construct()
	{
		$this->session = !empty($_SESSION) ? $_SESSION : NULL;
	}

	public function getSession()
	{
		return $this->session;
	}

	public function setSession($session)
	{
		$this->session = $session;
	}
}

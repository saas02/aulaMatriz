<?php

require_once 'database/entidad.php';

class client extends entidadBase
{

	public $id;
	public $name;
	public $email;
	public $phone;
	public $address;

	public function __construct()
	{
		try {
			$table = "clients";
			parent::__construct($table);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}

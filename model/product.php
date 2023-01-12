<?php

require_once 'database/entidad.php';

class product extends entidadBase
{

	public $id;
	public $name;
	public $description;
	public $price;

	public function __construct()
	{
		try {
			$table = "products";
			parent::__construct($table);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function setPrice($price)
	{
		$this->price = $price;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	
	public function saveProduct()
	{
		$query[] = "INSERT INTO products (name, description, price, created, modified, status)
                VALUES(
					'" . $this->name . "',
					'" . $this->description . "',
					'" . $this->price . "',
					'" . date("Y-m-d H:i:s") . "', 
					'" . date("Y-m-d H:i:s") . "',
					'1'
				);";

		return $this->save($query);
	}
}

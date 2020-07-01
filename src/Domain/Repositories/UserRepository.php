<?php

namespace App\Domain\Repositories;

use PDO;

class UserRepository {

	private $connection;

	public function __construct(PDO $connection)
	{
		$this->connection = $connection;
	}

	public function All() {

		$data = $this->connection->query("SELECT * FROM Usuario", PDO::FETCH_ASSOC);

		return $data;
	}

}

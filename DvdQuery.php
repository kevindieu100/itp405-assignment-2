<?php

namespace Database\Query;

class DvdQuery{
	public $title;
	private $orderByTitle = false;
	private $host = 'itp460.usc.edu';
	private $database_name = 'dvd';
	private $username = 'student';
	private $password = 'ttrojan';
	protected static $pdo;

	public function __construct()
	{
		//if there is no PDO connection
		if(!self::$pdo){
			// echo 'database connection created';
			$connection_string = "mysql:host=$this->host;dbname=$this->database_name";
			self::$pdo = new \PDO($connection_string, $this->username, $this->password);
		}
	}//end of constructor

	public function titleContains($title){
		$this->title = $title;
	}//end of titleContains

	public function orderByTitle(){
		$this->orderByTitle = true;
	}//end of orderByTitle

	public function find(){
		//title, genre, format, rating
		$sql = "
		  SELECT title, rating_name, dvds.id
		  FROM dvds
		  INNER JOIN ratings
		  on dvds.rating_id = ratings.id
		  WHERE title LIKE ?
		";

		if($this->orderByTitle){
			$sql .= "ORDER BY dvds.id";
			$this->orderByTitle = false;
		}

		$statement = self::$pdo->prepare($sql);
		$like = '%' . $this->title . '%';
		$statement->bindParam(1, $like);
		$statement->execute();
		$results = $statement->fetchAll(\PDO::FETCH_OBJ);

		return $results;
	}//end of find

}//end of DvdQuery


//SELECT * FROM dvds
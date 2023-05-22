<?php 

include_once('connection.php'); //my connection is here

class database extends connection{


	public function __construct(){

		parent::__construct();

	}


	public function getRow($query, $params = []){
		try {
			$stmt = $this->datab->prepare($query);
			$stmt->execute($params);
			return $stmt->fetch();	
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}//end getRow

	//get rows

    /**
     * @noinspection php
     * @param $query
     * @param array $params
     * @return array
     * @throws Exception
     */
	public function getRows($query, $params = []){
		try {
			$stmt = $this->datab->prepare($query);
			$stmt->execute($params);
			return $stmt->fetchAll();	
		} catch (PDOException $e) {
			throw new Exception($e->getMessage());	
		}
	}//end getRows

    /**
     * @noinspection php
     * @param $query
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function getNoRows($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }//end getRows

	//insert row
    /**
     * @noinspection php
     * @throws Exception
     */
	public function insertRow($query, $params = []){
		try {
			$stmt = $this->datab->prepare($query);
			$stmt->execute($params);
			return TRUE;	
		} catch (PDOException $e) {
			throw new Exception($e->getMessage());	
		}

	}//end insertRow

	//update row
	public function updateRow($query, $params = []){
        try {
            $this->insertRow($query, $params);
        } catch (Exception $e) {
        }
        return true;
	}//end updateRow

	//delete row
	public function deleteRow($query, $params = []){
        try {
            $this->insertRow($query, $params);
        } catch (Exception $e) {
        }
        return true;
	}//end deleteRow

	//get the last inserted ID
	public function lastID(){
		$lastID = $this->datab->lastInsertId(); 
		return $lastID;
	}//end lastID func	

	public function test()
	{
		echo 'database class test';
	}
}

 ?>
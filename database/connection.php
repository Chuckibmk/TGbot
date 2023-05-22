<?php
class Connection{

	protected $isConn;
	protected $datab;
	protected $transaction;

    public function __construct(
        $username="db_user",
        $password ='db_password',
        $host="localhost",
        $dbname="database",
        $options = []
    ){
		
		$this->isConn = TRUE;
		try{
			$this->datab = new PDO("mysql:host=$host;  dbname=$dbname;", $username, $password);
			$this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->transaction = $this->datab;
			$this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
// 			echo 'Connected Successfully!!!';
            
		}catch(PDOException $e){
// 			echo $e->getMessage();
		}

	}//endDefaultConstructor
 

	//disconnect from db
	public function Disconnect(){
		$this->datab = NULL;//close connection in PDO
		$this->isConn = FALSE;
	}//endDisconnectFunction


}//endClassDatabase

//   $con = new Connection(); //for debugging only

 ?>
<?php

	class DatabaseOperation{

		private $pdo;
    	private $table_name = "proxy_list";
    	// specify your own database credentials
	    private $host = "localhost";
	    private $db_name = "proxy_db";
	    private $username = "root";
	    private $password = "root";

    	// constructor with $db as database connection
	    public function __construct(){
	        

	        // instantiate database and product object
			
			$db = $this->getConnection();
			$this->pdo = $db;
	    }


	    /**
		* COnnect the db
		*
		* @return $conn
	    */
	    private function getConnection(){

	        $this->conn = null;

	        try{
	            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
	            $this->conn->exec("set names utf8");
	            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        }catch(PDOException $exception){
	            echo "Connection error: " . $exception->getMessage();
	        }

	        return $this->conn;
	    }
	    /**
		* Insert the proxy list in the db
		*
		* @param string $tableName
		* @param Array $proxyList
		* @return Mixed
	    */
	    private function InsertMultiple($tableName, $rows)
		{
		    // Get column list
		    $columnList = ['ip','port','code','country','provider','https','last_checked'];
		    $numColumns = count($columnList);
		    $columnListString = implode(",", $columnList);
		    // Generate pdo param placeholders
		    $placeHolders = array();

		    foreach($rows as $row)
		    {
		        $temp = array();

		        for($i = 0; $i < count($row); $i++)
		            $temp[] = "?";

		        $placeHolders[] = "(" . implode(",", $temp) . ")";
		    }

		    $placeHolders = implode(",", $placeHolders);

		    // Construct the query
		    $sql = "insert into $tableName ($columnListString) values $placeHolders ";
		    //die();

		     $sql.= 'ON DUPLICATE KEY UPDATE `ip` = VALUES(`ip`), `port` = VALUES(`port`),`code` = VALUES(`code`),
		    		 `country` = VALUES(`country`),`provider` = VALUES(`provider`), `https` = VALUES(`https`),`last_checked` = VALUES(`last_checked`)';
		    $stmt = $this->pdo->prepare($sql);

		    $j = 1;
		    foreach($rows as $row)
		    {
		        for($i = 0; $i < $numColumns; $i++)
		        {
		            $stmt->bindParam($j, $row[$columnList[$i]]);
		            $j++;
		        }
		    }

		   
		   
		    $stmt->execute();
		}


		/**
		* Insert the proxy list in the db
		*
		* @param string $tableName
		* @param Array $proxyList
		* @return Mixed
	    */
	    private function updateMultiple($tableName, $rows)
		{

			foreach($rows as $id => $row) {
				$row = [
				    'id' => $row['id'],
				    'basic_fun_test' =>  $row['basic_fun_test'],
				    'load_time' => $row['load_time'],
				    'basic_fun_tested_at' => date("Y-m-d H:i:s")
				];
				$sql = "UPDATE $tableName SET basic_fun_test=:basic_fun_test, load_time=:load_time, basic_fun_tested_at=:basic_fun_tested_at WHERE id=:id;";
				$status =$this->pdo->prepare($sql)->execute($row);

			}
		}
	    /**
		* Insert the proxy list in the db
		*
		* @param Array $proxyList
		* @return Mixed
	    */
		public function save($proxyList) 
	    {

	    	try{
	    		
	    		$this->InsertMultiple("proxy_list", $proxyList);
	    		// $affected = $pdo->rowCount();
	    		return true;
            }catch(PDOException $exception){
                echo "Insert execute error: " . $exception->getMessage();
            }
	            
	    }

	    /**
		* get the proxy list from the db
		*
		* 
		* @return proxyList
	    */
	    public function getAllProxyList()
	    {
	    	$query = "SELECT * FROM proxy_list ORDER BY id limit 100";
			$statement = $this->pdo->prepare($query);
			
	        try{
	            $statement->execute();
	            while($row = $statement->fetch(PDO::FETCH_ASSOC))
				{
					$data[] = $row;
				}
	            return $data;
	        }catch(PDOException $exception){
	            echo "Fetch execute error: " . $exception->getMessage();
	        }
	    }

	    /**
		* Update the proxy data
		*
		* @param $id
		* @return bool
	    */
	    public function updateProxy($proxyList)
	    {
	    	try{
	    		
	    		$this->updateMultiple("proxy_list", $proxyList);
	    		// $affected = $pdo->rowCount();
	    		return true;
            }catch(PDOException $exception){
                echo "Insert execute error: " . $exception->getMessage();
            }

	    }

	    /**
		* Delete the proxy data
		*
		* @param $id
		* @return bool
	    */
	    public function deleteProxy()
	    {

	    }


	} 

?>
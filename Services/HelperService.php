<?php
	class HelperService{



    	private function proxyCheck($proxy=null)
	    {
	        $proxy=  explode(':', $proxy);
	        $host = $proxy[0]; 
	        $port = $proxy[1]; 
	        $waitTimeoutInSeconds = 10; 
	        if($fp = @fsockopen($host,$port,$errCode,$errStr,$waitTimeoutInSeconds)){   
	           return '1';
	        } else {
	           return '0';
	        } 
	        fclose($fp);
	    }
	    public function basicFunctionalityTest($proxies)
	    {
			$testpage = "https://www.google.com";
			foreach($proxies as $proxy)
			{

				$passByIPPort= $proxy["ip"] . ":" . $proxy["port"];
				
				$loadingtime = time();
				$status =  $this->proxyCheck($passByIPPort);

				$proxy['basic_fun_test'] = $status;
				$loadingtime = (time() - $loadingtime);
				$proxy['load_time'] = $loadingtime;
				$data[] = $proxy;
			}

			return $data;
	    }
    }

?>
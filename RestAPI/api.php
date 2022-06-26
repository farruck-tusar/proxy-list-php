<?php
ini_set("memory_limit", "-1");
set_time_limit(0);

include_once '../Services/DatabaseOperation.php';
include_once '../Services/ProxyScraping.php';
include_once '../Services/HelperService.php';

// initialize object
$db = new DatabaseOperation();
$scrapedData = new ProxyScraping();
$helper = new HelperService();

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'),true);

// create SQL based on HTTP method
switch ($method) {
  case 'GET':
  	
    if(!empty($_GET['path']))
	{
		if($_GET['path'] == "showProxies")
		{
			$data = $db->getAllProxyList();

			if(count($data)>0)
				response(200,"Data Found.",$data);
			else
				response(204,"Data Not Found.",NULL);
		}


		elseif($_GET['path'] == "getAllProxies")
		{
			$data = $scrapedData->getScrapedData();

			if(count($data)>0) {
				$insertStatus = $db->save($data);
				response(200,"Data Inserted.",$data);
			}
			else {
				response(204,"No Data Found.",NULL);
			}
		}


		elseif($_GET['path'] == "funcTestAll")
		{
			$data = $db->getAllProxyList();
		
			if(count($data)>0) {
				$statusData = $helper->basicFunctionalityTest($data);
				if(count($data)>0)
					$updateStatus = $db->updateProxy($statusData);
					response(200,"Functionality Test Successful.",$updateStatus);
			}
			else {
				response(204,"No Data Found.",NULL);
			}
		}

		else
		{
			response(400,"Invalid Token.",NULL);
		}
		
	}
	else
	{
		response(400,"Invalid Request.",NULL);
	}
    break;
  case 'PUT':
    //newLine
    break;
  case 'POST':
	if(!empty($_GET['path']))
	{
		if($_GET['path'] == "funcTestSingle")
		{
			$data = $db->getAllProxyList();
			//$data = json_decode(file_get_contents("php://input"));
			if(count($data)>0)
				response(200,"Data Found.",$data);
			else
				response(204,"Data Not Found.",NULL);
		}
	}
	
	
    break;
  case 'DELETE':
    //newLine
    break;
}

function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status);
	
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['data']=$data;
	
	$json_response = json_encode($response);
	echo $json_response;
}
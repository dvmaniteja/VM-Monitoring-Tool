<?php

header ( "Content-Type:application/json" );

include 'database.php';

if (!empty($_GET['DEVICES']))

	{
		$resource = $_GET['DEVICES'];
	
		$response = shield($DEVICES);
	
		if(empty($response))

			{
				deliver_response (200," Service Not Found", NULL);
			}
		
		else
	
			{
				deliver_response (200, "Service Found", $response);
			}

	}

else

	{
		deliver_response (400,"No Entry Found", NULL);
	}

function deliver_response ($status, $status_message,$i)

	{

		global $search;

		header("HTTP/1.1 $status $status_message");

		$reply['status']=$status;

		$reply['status_message']=$status_message;
		
		$json_response=json_encode($reply);

		echo "$json_response\n";
		
		for ( $row = 0; $row <$i; $row++ )
	
		{
	
		$result['cpu'] 			= $search[$row]['cpu'];
		$result['memory'] 		= $search[$row]['memory'];
		$result['networkinput'] 	= $search[$row]['networkinput'];
		$result['networkoutput']	= $search[$row]['networkoutput'];
		$result['disk'] 		= $search[$row]['disk'];
	
		}

return($i);

	}
?>

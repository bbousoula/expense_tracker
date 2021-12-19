<?php

//data.php

/* $connect = new PDO("mysql:host=localhost;dbname=testing", "root", ""); */

session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
    header('location:logout.php');
    } else{

if(isset($_POST["action"]))
{
/* 	if($_POST["action"] == 'insert')
	{
		$data = array(
			':language'		=>	$_POST["language"]
		);

		$query = "
		INSERT INTO survey_table 
		(language) VALUES (:language)
		";

		$statement = $connect->prepare($query);

		$statement->execute($data);

		echo 'done';
	} */

	if($_POST["action"] == 'fetch')
	{
        $userid=$_SESSION['detsuid'];
		$query = "
		SELECT ExpenseItem, ExpenseCost AS Total 
		FROM tblexpense 
		GROUP BY ExpenseItem 

		"; 

/*          $query = "
		SELECT BalanceCategory, BalanceAmount, ExpenseItem, ExpenseCost AS Total 
		FROM tblexpense 
		 INNER JOIN tblbalance ON tblexpense.BalanceID = tblbalance.ID
		";  */

		$result = $con->query($query);
        

		$data = array();
        
		foreach($result as $row)
		{
			$data[] = array(
				'expense'		=>	$row["ExpenseItem"],
				'total'			=>	$row["Total"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
		}



		echo json_encode($data);
	}
}

    }
?>
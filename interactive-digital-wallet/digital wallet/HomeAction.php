<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form Action</title>
</head>
<body>
	<h1>Form Action</h1>
	<?php
		$Type = $_POST['Type'];
		$customer = $_POST['customer'];
		$amount = $_POST['amount'];

		if (empty($Type))
		{
			echo "Fill up the type";
		}

		else if (empty($customer))
		{
			echo "Fill up,  you want to send money";
		}
		else if (empty($amount))
		{
			echo "Fill up the amount";
		}
		else {
			echo "Successfully sent";
		}
    ?>
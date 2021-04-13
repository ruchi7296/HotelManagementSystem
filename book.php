<?php
    $username = $_post['username'];
	$email = $_post['email'];
    $mobile = $_post['mobile'];
    $cin = $_post['cin'];
	$cout = $_post['cout'];
	$room = $_post['room'];
	$type = $_post['type'];
	
	if (!empty($username || !empty($email) || !empty($mobile) || !empty($cin) || !empty($cout) || !empty($room) || !empty($type)){
		 $host = "localhost";
		 $dbusername = "root";
		 $password = "";
		 $dbname = "hotel management system";
		 
		 //create connection
		 $conn = new mysqli($host, $dbusername, $password, $dbname);
	} 
		 if (mysqli_connect_error()) {
			 
			 die('Connect error('.mysqli_connect_errno().')'.mysqli_connect_error());
		 }else{
			 $select = "select email from book where email = ? Limit 1";
			 $insert = "insert intro book (username, email, mobile, cin, cout, room, type) values(?,?,?,?,?,?,?)";
			 
			 //prepare statement
			 
			 $stmt = $conn->prepare($select);
			 $stmt->bind_param("s", $email);
			 $stmt->execute();
			 $stmt->bind_result($email);
			 $stmt->store_result();
			 $rnum = $stmt->num_rows;
			 
			 if ($rnum==0){
			    $stmt->close();
				
				$stmt = $conn->prepare($insert);
				$stmt->bind_param("ssssii", $username, $email, $mobile, $cin, $cout, $room, $type);
				$stmt->execute();
				
				echo "New record inserted successfully";
		 }else{
			 echo " Someone already registerd";
		 }
		 $stmt->close();
		 $conn->close();
		 
		 
	} else{
		   echo "All field are required";
		   die();
	}
	
	
?>
<?php

$pin = $_POST['pin'];

$hostname = 'localhost';
$username = 'root';
$password = '';
$databaseName = 'test';

$conn = mysqli_connect($hostname, $username, $password, $databaseName);

if (!$conn) {
	die ("Connection failed: " . mysqli_connect_error());
	}else{
        
        $sql = "SELECT * FROM candidates WHERE pin = $pin";
        $result = mysqli_query($conn, $sql);
        if ($result){
            while ($row = mysqli_fetch_assoc($result)){
                $result_array = array();
                array_push($result_array, $row);
            }
            
        }
        
        header('Content-type: application/json');
        echo json_encode($result_array);

        $conn->close();
    }
	
	
?>

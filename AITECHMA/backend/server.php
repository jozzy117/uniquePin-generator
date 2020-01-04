<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:\xampp\smtp\vendor\autoload.php';
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = 'jonathan.osadino@gmail.com';
$mail->Password = 'joerick117';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];


$hostname = 'localhost';
$username = 'root';
$password = '';
$databaseName = 'test';

$conn = mysqli_connect($hostname, $username, $password, $databaseName);

if (!$conn) {
	die ("Connection failed: " . mysqli_connect_error());
	}else{
        $result = "SELECT * FROM candidates ORDER BY id DESC LIMIT 1";
        $result_set = mysqli_query($conn, $result);
        if ($result_set){
        while ($row = mysqli_fetch_assoc($result_set)){
            $id = $row['pin'];
            $count = substr($id, -4);
        
        }
    }
        $date = date('ymd');
         if($count <10000){
             $count += 1;
         }else{$count = 1000;}
         $unique = $date.$count;
        $sql = "insert into candidates(name, email, phone, pin) values ('$name', '$email', '$phone', '$unique')";
        if($conn->query($sql)){
            
            echo nl2br("Signup Successful.\n\nYour Unique pin is : ".$unique .".\n\n");

            $mail->setFrom('jonathan.osadino@gmail.com', 'Jonathan');
       
            $mail->addAddress($email);   
      
            $mail->isHTML(true);  
            
            $bodyContent = '<h1>AITECHMA Successful Registration</h1>';
            $bodyContent .= '<p>Your Unique number is <b>'.$unique .'</b></p>';
            
            $mail->Subject = 'Email from Localhost by Jonathan Ojakovo';
            $mail->Body    = $bodyContent;
            
            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo nl2br("Message has been sent.\n\n");
            }
            
            
        }
        else{
            echo "Error: ".$sql. "<br>". $conn->error;
        }

        $conn->close();
    }
	
	
?>

<html>
  <body>
    <p> <a href="http://localhost/aitechma/frontend/check.html">Verify Your Details</a>.</p>
  </body>
</html>

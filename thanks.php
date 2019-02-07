<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
<title>Payment Details!</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
<div class="w3-container">
    <h1 class='w3-center'>Your Payment Details!</h1>
    
 <?php

include 'src/instamojo.php';

$api = new Instamojo\Instamojo($api_key, $api_secret,'https://'.$mode.'.instamojo.com/api/1.1/');

$payid = $_GET["payment_request_id"];
$status_transaction = $_GET["payment_status"];

if($status_transaction == "Failed") {

    echo "<h4 style='color:red;margin-left:10%'> Payment Failed. Go back to <a href='index.php'> homepage for payment</a> </h4>";
    $response = $api->paymentRequestStatus($payid);
    $servername = "us-cdbr-iron-east-03.cleardb.net";
                $username = "b5411cc5ff42b1";
                $password = "605d9c13";
                $dbname = "heroku_24da2d24ca5a0ed";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 
                  $payment_id = $response['payments'][0]['payment_id'];
                  $buyer_name = $response['payments'][0]['buyer_name'];
                  $buyer_email = $response['payments'][0]['buyer_email'];
                  $purpose =  $response['purpose'];
                  $payment_status = $response['status'];
                  $payment_amount = $response['amount'];
                $query = mysqli_query($conn,"INSERT INTO payments (payment_id,buyer_name,email,payment_status)
                                      VALUES('$payment_id','$buyer_name','$buyer_email','$payment_status')");
                if ($query) {
                    echo "Data Inserted";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                mysqli_close($conn);

}
else {

  try {
      $response = $api->paymentRequestStatus($payid);

      echo "<h4 style='color:#16bf0d;margin-left:10%'> Payment Success!! </h4>";
      echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>" ;
      echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>" ;
      echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>" ;
      echo "<h4>Purpose: " . $response['purpose'] . "</h4>" ;
      echo "<h4>Payment Status: " . $response['status'] . "</h4>" ;
      echo "<h4>Payment Amount: " . $response['amount'] . " ".$response['payments'][0]['currency']."</h4>" ;

    ?>


    <?php
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}

}

  ?>
 </div>
 </body>
 </html>
<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<title>Ozmenta' 19</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<div class="w3-content w3-border" style="margin-top: 12%">
    <h1 class="w3-center">Ozmenta' 19</h1>
  <div class="w3-container w3-blue">
    <h2>Fill Form to Confirm your ticket</h2>
  </div>
  <form class="w3-container" method='POST' action="">
       <p>      
    <label class="w3-text-black"><b>Registration ID</b></label>
    <input class="w3-input w3-border" placeholder="See your mail for the ID" name="name" type="text" required></p>
    <p>      
    <label class="w3-text-black"><b>Number</b></label>
    <input class="w3-input w3-border" placeholder="Your mobile number"name="number" type="text" required></p>
    <p>      
    <label class="w3-text-black"><b>Email</b></label>
    <input class="w3-input w3-border" placeholder="Your Email ID" name="email" type="text" required></p>
    <p>      
    <label class="w3-text-black"><b>Amount</b></label>
    <input class="w3-input w3-border" value="500" readonly name="amount" type="number" required></p>
    <p>
    <input type="submit" name='submit' class="w3-btn w3-blue" value='Pay now RS 500'></p>
  </form>
</div>

</body>
</html> 

<?php
if(isset($_POST['submit'])){
$amount = $_POST['amount'];
$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://'.$mode.'.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:$api_key",
                  "X-Auth-Token:$api_secret"));
$payload = Array(
    'purpose' => 'Web Development with Flask',
    'amount' => $amount,
    'phone' => $number,
    'buyer_name' => $name,
    'redirect_url' => $redirect_url,
    'send_email' => true,
    'webhook' => $webhook_url,
    'send_sms' => true,
    'email' => $email,
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 


//print_r($response);


$data = json_decode($response, true);

if($data['success'] == 1){
    // for on page payment, use this.
   $payment_id = $data['payment_request']['id'];
   echo '<script src="https://js.instamojo.com/v1/checkout.js"></script>
    <script>
        Instamojo.open("https://'.$mode.'.instamojo.com/@vigneshjayaprakash7/'.$payment_id.'"); 
    </script>
    ';
       //and for redirect to payment page, use this and uncomment the header() below.
       
       //header('Location:'.$data['payment_request']['longurl'].'');
}else{
    echo '<div class="w3-panel w3-red w3-content">
  
  <p>Error Try Again Later!</p>
</div>';
}

}

?>

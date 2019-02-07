<?php
	$email = 'vigneshjayaprakash7@gmail.com'; //To Sent to a notify email whenever a user complete a payment.
    $api_key = 'd89259788f0bae8441794d8cc9a2f995';
    $api_secret = '549de66dc02dff5047dcdc4e9378f8d1';
    $api_salt = '62f238160e694f9fb9f66ba43759235d';
	$webhook_url = 'https://instamojo-otest.herokuapp.com/webhook.php';
	$redirect_url = 'https://instamojo-otest.herokuapp.com/thanks.php';
    $mode = "live"; //You can change it to live by jest replacing it by 'live'
    if($mode == 'live'){
        $mode = 'www';
    }else{
        $mode = 'test';
    }
    
?>
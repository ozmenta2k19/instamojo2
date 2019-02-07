# Instamojo Payment Gateway

This is an updated script of [Instamojo Payment Gateway](https://www.hackerrahul.com/2017/10/integrate-instamojo-payment-gateway-php-mysql/).

## Update Contains -
- Owner will be notified everytime a user complete a payment.
- On page Payment gateway without refreshing the page using instamojo web integration method.
```javascript
<script src="https://js.instamojo.com/v1/checkout.js"></script>
<script>
	Instamojo.open("payment_link_here"); 
</script>
```
In instamojo Payment link is like
```
http://test.instamojo.com/@rahul13gangotri/payment_id_here/
```
Checkout Instamojo [Documentation](https://docs.instamojo.com/docs/) for more.

## How to install

Just open ```config.php``` file.

```php
<?php

	$email = 'YOUR_EMAIL'; //To Sent to a notify email whenever a user complete a payment.
	$api_key = 'YOUR_API_KEY';
	$api_secret = 'YOUR_API_SECRET';
	$api_salt = 'YOUR_API_SALT';
	$webhook_url = 'https://YOUR_WEBSITE_URL/webhook.php';
	$redirect_url = 'https://YOUR_WEBSITE_URL/thanks.php';
	$mode = "test"; //You can change it to live by jest replacing it by 'live'
	if($mode == 'live'){
		$mode = 'www';
	}else{
		$mode = 'test';
	}
    
?>
```

Edit and Replace ```YOUR_EMAIL``` with your email & replace ```API_KEY , API_SECRET AND API_SALT ``` with your own credentials which you can obtain from instamojo dashboard.

And in last edit ```YOUR_WEBSITE_URL``` with your website url and if the instamojo files are in sub-directory then add ```YOUR_WEBSITE_URL/DIRECTORY_NAME/```

NOTE - ```test.instamojo.com``` and ```instamojo.com``` are both different site, the one with subdomain test is only for testing purposes and the ```API_KEY, API_SECRET, & API_SALT``` is different for both the sites.

So if you are planning to use this script in live mode just edit ```$mode = 'test';```  adn replace ```test``` with ```live```

# That's it and you are Good to Go

So Just Go to [Instamojo Payment Gateway Demo](http://demo.hackerrahul.com/instamojo/) and check out the demo.

Here are the Test Debit Card Credentials which you can use to test the Payment gateway.
```
Card Number - 4242424242424242 
expiry Date - 01/20 
CVV - 111 
Second Factor Authentication Code - 1221
```


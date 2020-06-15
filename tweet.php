<?php
	require_once('config.php');
	require_once('TwitterAPIExchange.php');

	$settings = array(
		'oauth_access_token' => TWITTER_ACCESS_TOKEN,
		'oauth_access_token_secret' => TWITTER_ACCESS_TOKEN_SECRET,
		'consumer_key' => TWITTER_CONSUMER_KEY,
		'consumer_secret' => TWITTER_CONSUMER_SECRET
	);

	$url = 'https://api.twitter.com/1.1/statuses/update.json';
	$requestMethod = 'POST';
	$apiData = array(
		'status' => 'This is a confirmation tweet'
	);

	$twitter = new TwitterAPIExchange( $settings );
	$twitter->buildOauth( $url, $requestMethod );
	$twitter->setPostfields( $apiData );
	$response = $twitter->performRequest( true, array( CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0 ) );

	echo "<pre>";
	print_r(json_encode( $response, true ));
<?php
	require_once('config.php');
	require_once('TwitterAPIExchange.php');

	$settings = array(
		'oauth_access_token' => TWITTER_ACCESS_TOKEN,
		'oauth_access_token_secret' => TWITTER_ACCESS_TOKEN_SECRET,
		'consumer_key' => TWITTER_CONSUMER_KEY,
		'consumer_secret' => TWITTER_CONSUMER_SECRET
	);

	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$requestMethod = 'GET';
	$getField = '?screen_name=thecodingcas&count=3';

	$twitter = new TwitterAPIExchange( $settings );
	$twitter->setGetField( $getField );
	$twitter->buildOauth( $url, $requestMethod );
	$response = $twitter->performRequest( true, array( CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0 ) );
	$tweets = json_decode($response, true);

	// echo "<pre>";
	// print_r(json_encode( $response, true ));
?>

<h1>Latest Tweet</h1>
<?php foreach($tweets as $tweet) :  ?>
	<img src="<?php echo $tweet['user']['profile_image_url']; ?>">
	<a href="https://twitter.com/<?php echo $tweet['user']['screen_name']; ?>">
		<b>@<?php echo $tweet['user']['screen_name']; ?></b>
	</a> tweeted:
	<br><br>
	<?php echo $tweet['text']; ?>
	<br><br>
	Tweeted on: <?php echo $tweet['created_at']; ?>
	<br><br>
<?php endforeach; ?>
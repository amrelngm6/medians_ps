<?php

namespace Medians\Application\FaceBook;


use Medians\Infrastructure as Repo;




class FBWebhook 
{


	/**
	* @var Instance
	*/
	private $repo;


	function __construct($repo)
	{

		$this->repo = $repo;

		$this->config = new FBConfig($repo);

	}



	/**
	 * Handle webhook request
	 * 
	*/
	public function webhook_init()
	{

	    $config = $this->config->fbConfigQuery();


	    $verifyToken = '1010'; // You will specify it when you enable the Webhook for your app
	    $appSecret = $config->api_secret;

	    // Handle verification request
	    if (isset($_GET['hub_mode']) && $_GET['hub_mode'] === 'subscribe') {
	        if ($_GET['hub_verify_token'] === $verifyToken) {
	            echo $_GET['hub_challenge'];
	            exit;
	        }
	    }

	    // Validate the integrity and payload and it's origin
	    $payload = file_get_contents('php://input');
	    if (isset($_SERVER['HTTP_X_HUB_SIGNATURE']) && hash_equals(explode('=', $_SERVER['HTTP_X_HUB_SIGNATURE'])[1], hash_hmac('sha1', $payload, $appSecret))) {
	        // Handle payload
	        $data = json_decode($payload, true);
	        file_put_contents(time().'-webhook.php', $payload);

	        exit;
	    } else {

	        $data = json_decode($payload, true);
	        file_put_contents(time().'-webhook.php', $payload);
	    }

	    if (!empty($request->get('hub_challenge')))
	    {
	        return $request->get('hub_challenge');
	    }
	}


}

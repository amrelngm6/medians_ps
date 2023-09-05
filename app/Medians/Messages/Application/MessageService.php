<?php

namespace Medians\Messages\Application;

class MessageService
{

    
	/**
	* @var Object
	*/
	protected $repo;

	/**
	 * @var API URL
	 */
	protected $url = 'https://graph.facebook.com';


	/**
	 * @var API Business Account ID
	 */
	protected $BAID = '111180314953637';

	/**
	 * @var API Phone Number ID
	 */
	protected $PNID = '106672422075870';

	/**
	 * @var API Phone Number ID
	 */
	protected $PNID2 = '107712392430422';

	/**
	 * @var API System User Token
	 */
	protected $SystemUserToken = 'EAANdde82KOYBO5q9iZCdo8FfdffC6j7LbRZCiARVfQ5GnR1weIlQAkIDosZCxKev7ZB3yWEUk0qZBO8zxGxi76VhSFWWRdAepMiazxPYPOfN9TlshHbAhErbCZBLDcTqc9m7dldXdgJM3chaAPPe8rGTR72nqDMx55futDBIdo9tzdat36V5JsV3Y1jLClch08LZBujTaYc5yqaGKZBT';

	/**
	 * @var API System User Token
	 */
	protected $DeveloperToken = 'EAANdde82KOYBOZCvY1uyBGTSc3EEONRylyZCUepZBf0DTHCeOEMs68i7Io2UyHX5ZC9PiVIELj7jj7Bcyf8GKbdOY2EpXd3v86OOexLiSc1XuPiQ4nQQwIBiCv994WIfyTqJbA2AmItta4Wp8fNlMUGELXBxuKrhsPLbA4v42XIQ0Q7pAUJagpcrK4IiaV3qeulycHsJUSujgTBrpR8kHKsZCZAL1ZBZAatgrQZDZD';


	function __construct()
	{
	
	}


	
	/**
     * Get business phone_numbers
     */
	public function getPhoneNumbers()
	{
		return $this->executeGet('/v17.0/'.$this->BAID.'/phone_numbers?access_token='.$this->SystemUserToken);	
	}
	
	
	
	public function getMedia(String $mediaID)
	{
		return $this->executeGet($mediaID);	
	}
	

	/**
	 * Download & Save media file locally
	 */
	public function saveMedia(String $mediaID)
	{
		$Media = json_decode($this->getMedia($mediaID));

		$ua = 'curl/7.64.1';
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $Media->url,
		  CURLOPT_USERAGENT => $ua,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer '.$this->SystemUserToken
		  ),
		));
		
		$response = curl_exec($curl);
		curl_close($curl);

		$mediaFilePath = rand().'.jpg';

		file_put_contents($mediaFilePath, $response);
		
	}


	public function uploadMedia(String $mediapath)
	{
		
		try
		{
			$url = "https://graph.facebook.com/{$this->PNID}/media";

			$headers = array(
				'Authorization: Bearer ' . $this->SystemUserToken
			);

			$data = array(
				'file' => new \CURLFile($mediapath, 'image/jpeg'),
				'messaging_product' => 'whatsapp'
			);

			$ch = curl_init($url);

			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$response = curl_exec($ch);
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			curl_close($ch);
			
			$responseObject = json_decode($response);
			$output = $this->sendMediaMessage($responseObject->id);
			$output->id = $responseObject->id;

			return $output;
		}
		catch (Exception $ex)
		{
			return $ex->getMessage() . PHP_EOL;
		}
		
	}


	public function sendMediaMessage(String $mediaID , String $receiver = '201096869285')
	{
		
		$path = '/v17.0/'.$this->PNID.'/messages';

		$data = array(
            'messaging_product' => 'whatsapp',
			"recipient_type"=> "individual",
            'to' => $receiver,
			"type"=> "image",
			"image"=> [
				"id" => $mediaID
			]
        );

		return $this->wp_web_send($path, $data);
	}


	public function sendTextMessage(String $message_text = 'Hola', String $receiver = '201096869285')
	{
		$path = '/v17.0/'.$this->PNID.'/messages';

		$data = array(
			'messaging_product' => 'whatsapp',
            'to' => $receiver,
            'type' => 'text',
			'text' => ['body'=>$message_text]
        );
		
		$MessageRepository = new \Medians\Messages\Infrastructure\MessageRepository;
		$response = json_decode($this->wp_web_send($path, $data));
		$message = $response->messages[0];
		$data['conversation_id'] = '';
		$data['to'] = $receiver;
		$data['sender_id'] = $this->PNID;
		$data['message_id'] = $message->id;
		$data['message_text'] = $message_text;
		$data['media_id'] = '';
		return $MessageRepository->saveMessage($data, $this->PNID);
	}
	

	/**
	 * Mark message as read
	 */
	public function markRead($messageID)
	{
		$path = '/v17.0/'.$this->PNID.'/messages';

		$data = array(
            'messaging_product' => 'whatsapp',
            'status' => 'read',
			"message_id"=> $messageID,
        );

		return $this->wp_web_send($path, $data);
	}
	


	/**
	 * Request verification code
	 */
	public function request_code()
	{
		$path = '/v17.0/'.$this->PNID.'/request_code';

		$data = array(
            'code_method' => 'SMS',
            'language' => 'en',
        );

		return $this->wp_web_send($path, $data);
	}
	

	/**
	 * Get messages
	 */
	public function getMessages()
	{
		$path = '/v17.0/'.$this->PNID;

		return $this->wp_web_send($path, []);
	}
	
	/**
	 * Get Business info
	 */
	public function getInfo()
	{
		$path = $this->BAID;

		return $this->executeGet($path, []);
	}
	
	/**
	 * Get Business info
	 */
	public function getTemplates()
	{
		$path = $this->BAID . '/message_templates';

		return $this->executeGet($path, []);
	}

	
    public function wp_web_send(String $path,  Array $data = [])
    {

		// Super user
        $accessToken = $this->SystemUserToken;

		$headers = array(
			'Content-Type: application/json'
		);

		if (!empty($data))
		{
            array_push($headers, 'Authorization: Bearer ' . $accessToken);
		}
		
		return $this->executePost($path, $data, $headers);

    } 
	

	/**
	 * API url  
	 */
	public function apiURL($path)
	{
        return $this->url . $path;
    } 


	/**
	 * Excute POST request 
	 */
	public function executeGet($path)
	{
		echo $this->apiURL($path);
		$headers = array(
			'Authorization: Bearer ' . $this->SystemUserToken
		);
		
		$ch = curl_init($this->apiURL($path));
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		curl_close($ch);

		return $response;
	}
	
	
	/**
	 * Excute POST request 
	 */
	public function executePost($path, $data, $headers)
	{
        $ch = curl_init();

		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_URL, $this->apiURL($path));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return 'Error: ' . curl_error($ch);
        }

        curl_close($ch);
        print_r($response);

		return json_decode($response);
	}


}

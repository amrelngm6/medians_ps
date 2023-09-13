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
	protected $DeveloperToken = 'EAANdde82KOYBOwhuWkI5gyiTnotmh0HTTfEA9jNI9LhMJnvOTQyHu11JHiS7gfsOOF0DkQRcnrsnMdsHyYaqjhHkZALvfh1D5FuS54IVnH636BCd0wxhrcurNUzHemcQeLaFAZB1ejlyzBKGtdE40OsltQ6JZBJAeQ9doEuCjW8KZC1ZBvqjsPceR0TXXstxZBYKz1jomTM90K8SubYLBs0hZCYIByBDLOJZAgZDZD';


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
	 * Get file type
	 */
	public function getFileType($value)
	{
		
		$fileTypeFirst = explode('/', $value->getClientMimeType());

        switch ($fileTypeFirst[0]) 
        {
			case 'image':
			case 'video':
            case 'audio':
                return $fileTypeFirst[0];
                break;
            
            default:
                return 'document';
                break;
        }
	}


	/**
	 * Get media ext
	 */
	public function mediaExtension($Media)
	{
		$type = explode('/', $Media->mime_type);
		switch ($type[0]) 
		{
			case 'image/jpeg':
			case 'image/jpg':
				return 'jpg';
				break;
			
			case 'image/png':
				return 'png';
				break;
				
			case 'audio/amr':
			case 'audio/mpeg':
			case 'audio/mp4':
			case 'audio/aac':
			case 'audio/ogg':
				return end($type);
				break;
				
			case 'video/mp4':
			case 'video/3gp':
				return end($type);
				break;
				
			default:
				return end($type);
				break;
		}
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

		$mediaFilePath = './uploads/images/'.rand().rand().'.'.$this->mediaExtension($Media);

		file_put_contents($mediaFilePath, $response);
		
		return str_replace('./', '/', $mediaFilePath);
	}


	public function uploadMedia(String $mediapath, $filetype = 'image/jpeg')
	{
		try
		{
			$url = "https://graph.facebook.com/{$this->PNID}/media";

			$headers = array(
				'Authorization: Bearer ' . $this->SystemUserToken
			);
			
			$data = array(
				'file' => new \CURLFile($_SERVER['DOCUMENT_ROOT'].$mediapath, $filetype),
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
			echo $ex->getMessage();
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
		
        $app = new \config\APP;

		$MessageRepository = new \Medians\Messages\Infrastructure\MessageRepository;
		$response = $this->wp_web_send($path, $data);
		$message = $response->messages[0];
		$data['conversation_id'] = '';
		$data['to'] = $receiver;
		$data['sender_id'] = $this->PNID;
		$data['message_id'] = $message->id;
		$data['message_text'] = $message_text;
		$data['media_id'] = '';
		$data['message_time'] = '';
		$data['message_type'] = 'text';
        $data['inserted_by'] = $app->auth()->id;
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

		$output = json_decode($response);
		if (isset($output->error->message)) {
			echo $response; return null;
		}

		return $output;
	}


}

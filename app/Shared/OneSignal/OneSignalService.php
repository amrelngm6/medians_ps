<?php
namespace Shared\OneSignal;

use Shared\dbaser\CustomController;

class OneSignalService 
{

    /**
     * OneSignal APP ID
     */
    protected $APP_ID;

    /**
     * OneSignal APP KEY TOKEN
     */
    protected $APP_KEY_TOKEN;

    /**
     * OneSignal USER KEY TOKEN
     */
    protected $USER_KEY_TOKEN;

    protected $receiver_id;

    protected $user_onesignal_id;

    protected $config;

    protected $apiInstance;

    function __construct($id)
	{
		$this->app = new \config\APP;
        $this->APP_ID = '8c316c75-1878-4bf9-99ad-3964bb83f525';
        $this->APP_KEY_TOKEN = 'ZDE4MGQ3YmEtZjljZS00ZWFmLThkMDQtNjMzYzk0YjlmMWZk';
        $this->USER_KEY_TOKEN = '<YOUR_USER_KEY_TOKEN>';

        $this->user_onesignal_id = $id;
	}


    public function send($receiver, $subject, $messageText)
    {

        $this->sendNotification($receiver, $subject, $messageText);
    }


    function sendNotification($receiver, $subject, $messageText) {
        
        $headings = array(
            "en" => strip_tags($subject)
        );

        $content = array(
            "en" => strip_tags($messageText)
        );
    
        $fields = array(
            'app_id' => $this->APP_ID,
            // 'included_segments' => , // Send to all subscribers
            'included_segments' => ['segment D-23'], // Send to all subscribers
            'headings' => $headings,
            'contents' => $content,
            // 'include_external_user_ids' => [$this->user_onesignal_id],
            // 'data' => $receiver,
            'target_channel' => 'push',
            'include_aliases' => ['external_id'=>['D-23', '23']]
        );
        

        $fields = json_encode($fields);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . $this->APP_KEY_TOKEN
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    
        $response = curl_exec($ch);
        curl_close($ch);
        
        $responseObject =  json_decode($response);

        if (isset($responseObject->errors))
        {
            return throw new \Exception($responseObject->errors, 1);
        }

        return $response;
    }
    
}
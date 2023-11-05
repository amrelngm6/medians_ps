<?php
namespace Shared\OneSignal;

use Shared\dbaser\CustomController;


use \DateTime;
use onesignal\client\api\DefaultApi;
use onesignal\client\Configuration;
use onesignal\client\model\GetNotificationRequestBody;
use onesignal\client\model\Notification;
use onesignal\client\model\StringMap;
use onesignal\client\model\Player;
use onesignal\client\model\UpdatePlayerTagsRequestBody;
use onesignal\client\model\ExportPlayersRequestBody;
use onesignal\client\model\Segment;
use onesignal\client\model\FilterExpressions;
use PHPUnit\Framework\TestCase;
use \GuzzleHttp;


class OneSignalService extends CustomController 
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

        $this->config = Configuration::getDefaultConfiguration()
            ->setAppKeyToken($this->APP_KEY_TOKEN)
            ->setUserKeyToken($this->USER_KEY_TOKEN);

        $this->apiInstance = new DefaultApi(
            new GuzzleHttp\Client(),
            $this->config
        );
	}


    public function send($receiver, $subject, $message)
    {

		error_log(json_encode($receiver->field['onesignal_id']), 3, "./uploads/error_logs.log");

        $notification = $this->createNotification('PHP Test notification');

        $result = $this->apiInstance->createNotification($notification);

        print_r($result->getId());

    }



    function createNotification($enContent): Notification {
        $content = new StringMap();
        $content->setEn($enContent);
    
        $notification = new Notification();
        $notification->setAppId($this->APP_ID);
        $notification->setContents($content);
        $notification->setTargetChannel('push');
        $notification->setIncludeAliases(['external_id'=>[$this->user_onesignal_id]]);
    
        return $notification;
    }
}
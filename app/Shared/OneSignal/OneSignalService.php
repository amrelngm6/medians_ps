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

    function __construct($id)
	{

		$this->app = new \config\APP;
        $this->APP_ID = '<YOUR_APP_ID>';
        $this->APP_KEY_TOKEN = '<YOUR_APP_KEY_TOKEN>';
        $this->USER_KEY_TOKEN = '<YOUR_USER_KEY_TOKEN>';


        $this->user_onesignal_id = $id;

        $config = Configuration::getDefaultConfiguration()
            ->setAppKeyToken(APP_KEY_TOKEN)
            ->setUserKeyToken(USER_KEY_TOKEN);

        $apiInstance = new DefaultApi(
            new GuzzleHttp\Client(),
            $config
        );
	}


    public function send($receiver, $subject, $message)
    {

		error_log(json_encode($receiver->field['onesignal_id']), 3, "./uploads/error_logs.log");

        $notification = createNotification('PHP Test notification');

        $result = $apiInstance->createNotification($notification);
        print_r($result);

    }



    function createNotification($enContent): Notification {
        $content = new StringMap();
        $content->setEn($enContent);
    
        $notification = new Notification();
        $notification->setAppId($this->APP_ID);
        $notification->setContents($content);
        $notification->include_aliases(['external_id'=>[$this->user_onesignal_id]]);
    
        return $notification;
    }
}
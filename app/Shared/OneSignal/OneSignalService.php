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

    function __construct()
	{

		$this->app = new \config\APP;

	}


    public function send()
    {
        $args = func_get_args();

		error_log(json_encode($args), 3, "./uploads/error_log.log");
    }


}
<?php

namespace Medians;

use \Shared\dbaser\CustomController;

use \libphonenumber\PhoneNumberUtil;
use \libphonenumber\PhoneNumberFormat;
use \libphonenumber\PhoneNumberType;

class FrontendController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $app;
	protected $repo;
	protected $contentRepo ;



	function __construct()
	{
		$this->app = new \config\APP;

		$this->contentRepo = new \Medians\Content\Infrastructure\ContentRepository;
		$this->repo = new \Medians\Bookings\Infrastructure\BookingRepository;
	
	}


	/**
	 * Model object 
	 * 
	 */
	public function form_submit($type)
	{

		$params = $this->app->request()->get('params');

		try {
				
			// Create an instance of PhoneNumberUtil
			$phoneNumberUtil = PhoneNumberUtil::getInstance();

			$number = $params['custom_field']['mobile_key'] . $params['custom_field']['mobile'];

			if (empty($params['custom_field']['mobile']))
			{
				echo  json_encode(array('error'=>1, 'result'=> translate("Mobile is required")));
				return ; 
			}

			try {
				// Parse the phone number
				$phoneNumber = $phoneNumberUtil->parse($number, $params['custom_field']['mobile_country']);

				// Validate the phone number
				$isValid = $phoneNumberUtil->isValidNumber($phoneNumber);

				// Get the phone number in a standardized format
				$formattedPhoneNumber = $phoneNumberUtil->format($phoneNumber, PhoneNumberFormat::INTERNATIONAL);

				// Get the type of phone number (Mobile, Fixed Line, etc.)
				$numberType = $phoneNumberUtil->getNumberType($phoneNumber);

				if (!$isValid)
				{
					$response = array('error'=>1,'result'=>translate("MOBILE_ERR"));

				}  else {

					$Object = $this->repo->store($params);
					$response = $Object ? array('success'=>1, 'result'=> translate('BOOKING_NOTE'), 'title'=>translate('BOOKING_THANKS')) : array('error'=>1 , 'result'=>translate('Error')) ;
				}

			} catch (\libphonenumber\NumberParseException $e) {
				$response = array('error'=>1,'result'=>translate('MOBILE_ERR') );
				// $response = array('error'=>1,'result'=>$e->getMessage());
			}


		} catch (Exception $e) {
			$response  = array('error'=>1, 'result'=>$e->getMessage()) ;
		}

		$response['redirect'] = (isset($response['success']) && isset($Object->class) && strtolower($Object->class) == 'booking') ? ('/booking_confirm/booking') : null;
		$response['redirect'] = (isset($response['success']) && isset($Object->class) && strtolower($Object->class) == 'onlineconsultation') ? ('/booking_confirm/online_consultation') : $response['redirect'];
		$response['redirect'] = (isset($response['success']) && isset($Object->class) && strtolower($Object->class) == 'offers') ? ('/booking_confirm/offers') : $response['redirect'];
		$response['redirect'] = (isset($response['success']) && isset($Object->class) && strtolower($Object->class) == 'contact') ? ('/booking_confirm/contact') : $response['redirect'];

		echo json_encode($response);
	} 

	public function switchLang($lang)
	{

		if (empty($_SERVER['HTTP_REFERER'])) {
			echo (new \config\APP)->redirect('/');
			return null;
		}

		$prefix = str_replace([$this->app->CONF['url'], $this->app->CONF['url'].'/en'], '', $_SERVER['HTTP_REFERER']);

		if (empty($prefix))
		{
			echo (new \config\APP)->redirect('/'); 
			return true;
		}

		$object = $this->contentRepo->find(urldecode($prefix));
		if (empty($object)){
			echo (new \config\APP)->redirect('/'.$prefix); 
			return true;
		}

		$item = $this->contentRepo->switch_lang($object);

		echo (new \config\APP)->redirect('/'.$item->prefix); 
		
		$_SESSION['site_lang'] = in_array($lang, ['arabic', 'english']) ? $lang : 'arabic';

		// echo (new \config\APP)->redirect($_SERVER['HTTP_REFERER']);
	}
	

	public function storeCustomerComment() 
	{
		$forumController = new Forum\Application\ForumController;	
		return $forumController->storeCustomerComment();
	}


	
    /**
     * videos for frontend
     */
    public function videos()
    {	
		

		$settings = $this->app->SystemSetting();

		try {
			
            return render('views/front/'.($settings['template'] ?? 'default').'/videos.html.twig', [
                'title' => translate('Homepage'),
                'page' => $page,
                'item' => $page,
	        	'headerPosition'=> 'lg-fixed',
            ]);
            
		} catch (\Exception $e) {
			
			throw new \Exception($e->getMessage(), 1);
		}
    }
}	

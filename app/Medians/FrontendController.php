<?php

namespace Medians;

use \Shared\dbaser\CustomController;

class FrontendController extends CustomController 
{

	/**
	* @var Object
	*/
	protected $repo;



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

		$request = $this->app->request()->get('params');

		try {
			
			$Object = $this->repo->store($request);

			$response = $Object ? array('success'=>1, 'result'=> __('BOOKING_NOTE'), 'title'=>__('BOOKING_THANKS')) : 'error' ;

		} catch (Exception $e) {
			$response  = array('error'=>$e->getMessage()) ;
		}


		echo json_encode($response);
	} 

	public function switchLang($lang)
	{

		if (empty($_SERVER['HTTP_REFERER'])) {
			echo (new \config\APP)->redirect('/');
			return null;
		}

		$prefix = str_replace($this->app->CONF['url'], '', $_SERVER['HTTP_REFERER']);

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
}	

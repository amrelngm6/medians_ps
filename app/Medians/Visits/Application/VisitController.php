<?php

namespace Medians\Visits\Application;
use Medians\Visits\Infrastructure\VisitRepository;
use Medians\Visits\Domain\Visit;
use Shared\dbaser\CustomController;


class VisitController extends CustomController 
{

    public $app;

    public $repo;

    function __construct()
    {
        $this->app = new \Config\APP;
    }
    

	

	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index( ) 
	{
		
		try {
			
		    return render('timeline', [
		        'load_vue' => true,
		        'title' => translate('Visitors timeline'),
				'visits_list' => Visit::totalVisits(date('Y-m-d', strtotime(' -7 days ')), date('Y-m-d', strtotime(' +1 days ')))->with('item')->orderBy('updated_at', 'desc')->limit(1000)->get(),
				'visits_ip_list' => Visit::totalVisits(date('Y-m-d', strtotime(' -7 days ')), date('Y-m-d', strtotime(' +1 days ')))->with('item')->orderBy('updated_at', 'desc')->groupBy('ip')->limit(100)->get()
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}

    
}
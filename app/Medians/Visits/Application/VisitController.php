<?php

namespace Medians\Visits\Application;
use Medians\Visits\Infrastructure\VisitRepository;
use Medians\Menus\Infrastructure\MenuRepository;
use Medians\Content\Infrastructure\ContentRepository;
use Medians\Visits\Domain\Visit;
use Medians\Products\Domain\Product;
use Medians\Categories\Domain\Category;
use Shared\dbaser\CustomController;



use Medians\Specializations\Infrastructure\SpecializationRepository;
use Medians\Categories\Infrastructure\CategoryRepository;
use Medians\Blog\Infrastructure\BlogRepository;
use Medians\Doctors\Infrastructure\DoctorRepository;
use Medians\StoryDates\Infrastructure\StoryDateRepository;
use Medians\Stories\Infrastructure\StoryRepository;
use Medians\Technologies\Infrastructure\TechnologyRepository;
use Medians\OnlineConsultations\Infrastructure\OnlineConsultationRepository;

class VisitController extends CustomController 
{

    public $app;

    public $repo;

    public $contentRepo;

    public $menuRepo;
    public $technologyRepo;
    public $categoryRepo;
    public $doctorRepo;
    public $blogRepo;
    public $storyDateRepo;
    public $storyRepo;
    public $specsRepo;
    public $consultationRepo;

    function __construct()
    {
        $this->app = new \Config\APP;
        $this->repo = new VisitRepository;
        $this->contentRepo = new ContentRepository;
        $this->menuRepo = new MenuRepository;
		
		$this->specsRepo = new SpecializationRepository();
		$this->consultationRepo = new OnlineConsultationRepository();
		$this->categoryRepo = new CategoryRepository();
		$this->blogRepo = new BlogRepository();
		$this->doctorRepo = new DoctorRepository();
		$this->storyDateRepo = new StoryDateRepository();
		$this->storyRepo = new StoryRepository();
		$this->technologyRepo = new TechnologyRepository();
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
		        'items' => $this->repo->get(),
				'visits_list' => Visit::totalVisits($this->start, $this->end)->with('item')->orderBy('updated_at', 'desc')->limit(1000)->get(),
				'visits_ip_list' => Visit::totalVisits($this->start, $this->end)->with('item')->orderBy('updated_at', 'desc')->groupBy('ip')->limit(100)->get()
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}

    
}
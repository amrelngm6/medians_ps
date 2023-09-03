<?php

namespace Medians;

use \Shared\dbaser\CustomController;

use Medians\Infrastructure as Repo;

class HomeController extends CustomController 
{


	function __construct()
	{
		$this->app = new \config\APP;
		$this->blogRepo = new \Medians\Blog\Infrastructure\BlogRepository;
		$this->doctorRepo = new \Medians\Doctors\Infrastructure\DoctorRepository;
		$this->specsRepo = new \Medians\Specializations\Infrastructure\SpecializationRepository;
		$this->storiesRepo = new \Medians\Stories\Infrastructure\StoryRepository;
		$this->storyDateRepo = new \Medians\StoryDates\Infrastructure\StoryDateRepository;
		$this->pagesRepo = new \Medians\Pages\Infrastructure\PageRepository;
	}

	/**
	 * Model object 
	 */
	public function index()
	{
		try {

			$item = $this->pagesRepo->homepage();
			$item->addView();

	        return  render('views/front/page.html.twig',[
	        	'blog'=> $this->blogRepo->getFront(3),
	        	'doctors'=> $this->doctorRepo->getHome(3),
	        	'specializations'=> $this->specsRepo->get_root(),
	        	'stories'=> $this->storiesRepo->get(3),
	        	'all_stories'=> $this->storiesRepo->get(),
	        	'headerPosition'=> 'fixed',
		        'item' => $item,
	        	'story_dates'=> $this->storyDateRepo->get(10)
	        ]);
	        
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	} 




}

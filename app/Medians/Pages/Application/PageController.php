<?php

namespace Medians\Pages\Application;

use Medians\Pages\Infrastructure\PageRepository;
use Medians\Content\Infrastructure\ContentRepository;


class PageController
{

	/**
	* @var Object
	*/
	protected $repo;

	

	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new PageRepository();
		$this->contentRepo = new ContentRepository();
	}



	/**
	 * Front page 
	 * @var Int
	 */
	public function page()
	{

		try {
			
			return render('views/front/index.html.twig', []);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	} 





	/**
	 * Editor page 
	 * @var Int
	 */
	public function editor()
	{
		try {
			
			return render('views/front/editor.html.twig', []);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	} 

	/**
	 * Submit builder requests
	 */ 
	public function updateContent()
	{	

		$request = $this->app->request();
		
		if (!$request->get('section') || !$request->get('content'))			
			return true;

		$content = $request->get('content');
		$section = $request->get('section');
		$page = str_replace('-section', '.html.twig', $section);
		$fileLocation = $_SERVER['DOCUMENT_ROOT'].'/app/views/front/content/'.$page;

		if (!is_file($fileLocation))
			return true;

		file_put_contents($fileLocation, $content);

		echo 'Done';
	}

}
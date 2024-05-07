<?php

namespace Medians\Builders\Application;
use Shared\dbaser\CustomController;

use Medians\Builders\Infrastructure\BuilderRepository;
use Medians\Content\Infrastructure\ContentRepository;


class BuilderController extends CustomController 
{	

	
	protected $app;
	protected $repo;
	public $contentRepo;
	public $emailController;

	function __construct()
	{
		$this->app = new \Config\APP;

		$this->repo = new BuilderRepository;
		$this->contentRepo = new ContentRepository;
		$this->emailController = new EmailBuilderController;

	}

	/**
	 * Index builder 
	 */ 
	public function index()
	{

		try {
			

			$request = $this->app->request();
			$check = $this->contentRepo->find($request->get('prefix'));
			$check->switch_lang = $this->contentRepo->switch_lang($check);

			return render('views/admin/builder/index.html.twig', [
				'page' => $check, 
				'precode' => isset($check->content) && (substr(trim($check->content), 0, 8) == '<section') ? '' : '<section id="newKeditItem" class="kedit">', 
				'postcode' => isset($check->content) && (substr(trim($check->content), 0, 8) == '<section') ? '' : '</section>', 
			]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	}



	/**
	 * Load builder assets
	 */ 
	public function load()
	{

		try {
			
			$request = $this->app->request();
			$page = $request->get('page');
			switch ($page) {
				case 'blocks':
					echo json_encode($this->repo->get());
					break;
					
				case 'email_blocks':
					echo json_encode($this->repo->getEmailBlocks());
					break;
			}

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	}


	/**
	 * Load builder meta
	 */ 
	public function meta()
	{

		try {
			
			$request = $this->app->request();
			$check = $this->contentRepo->find($request->get('prefix'));

			render('views/admin/builder/templates/meta.html.twig',['page'=>$check]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	}

	/**
	 * Load builder meta
	 */ 
	public function languages()
	{

		try {
			
			$request = $this->app->request();
			$check = $this->contentRepo->find($request->get('prefix'));

			render('views/admin/builder/templates/languages.html.twig',['page'=>$check]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	}

	/**
	 * Load builder scrab page
	 */ 
	public function scrab_get()
	{

		try {
			
			$request = $this->app->request();
			$check = $this->contentRepo->find($request->get('prefix'));

			render('views/admin/builder/templates/scrab.html.twig',['page'=>$check]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	}

	
	/**
	 * Extract sections from html page
	 */
	public function scrapeAndExtractSections($url) 
	{
		// Initialize cURL session
		$ch = curl_init($url);
		
		// Set cURL options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
		// Execute cURL session and get the HTML content
		$htmlContent = curl_exec($ch);
	
		// Check for cURL errors
		if (curl_errno($ch)) {
			echo 'Curl error: ' . curl_error($ch);
			curl_close($ch);
			return;
		}
	
		// Close cURL session
		curl_close($ch);
	
		// Create a SimpleHTMLDom object
		$dom = new simple_html_dom();
		
		// Load HTML content into the DOM parser
		$dom->load($htmlContent);
	
		// Find and extract section elements
		$sections = array();
		foreach ($dom->find('section') as $section) {
			// Add section content to the array
			$sections[] = $section->outertext;
		}
	
		// Clean up the DOM parser
		$dom->clear();
		
		// Output the extracted sections
		return $sections;
	}

	/**
	 * Scrab sections
	 */
	public function scrab()
	{
		echo translate('Done');
	}

	
	/**
	 * Submit builder requests
	 */ 
	public function updateContent()
	{	

		$request = $this->app->request();
		
		if (!$request->get('contentJSON') || !$request->get('prefix'))			
			return true;

		$contentJSON = json_decode($request->get('contentJSON'));
		$check = $this->contentRepo->find($request->get('prefix'));
		$check->content = str_replace('data-src', 'src', $contentJSON->contentArea);
		$check->update(['content' => $check->content]);
		echo $check->content;
	}




	/**
	 * Update meta tags
	 */ 
	public function updateMeta()
	{	

		$request = $this->app->request();
		
		if (!$request->get('title') || !$request->get('prefix'))			
			return true;


		return $this->repo->updateMeta($request);
	}




	/**
	 * Submit builder requests
	 */ 
	public function submit()
	{


		try {
			
			$request = $this->app->request();
			$supermode = $request->get('supermode');
			switch ($supermode) 
			{
				case 'configUpdate':
					return $this->updateContent();		
					break;

				case 'configEmailUpdate':
					return $this->emailController->updateContent();		
					break;
				
				case 'updateMeta':
					return $this->updateMeta();		
					break;
				
				case 'insertContent':
					echo $this->repo->find($request->get('id'))->content;
					return true;		
					break;
				
				case 'insertEmailContent':
					echo $this->app->renderTemplate($this->repo->findEmailBlock($request->get('id'))->content)->render( ['app' => $this->app ]  );

					// echo $this->repo->findEmailBlock($request->get('id'))->content;
					return true;		
					break;
				
				default:
					// code...
					break;
			}

			if ($request->get('prefix') && $supermode == 'updateMeta')
			{

			}

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	}
}

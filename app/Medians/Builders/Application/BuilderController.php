<?php

namespace Medians\Builders\Application;
use Shared\dbaser\CustomController;
use Shared\simple_html_dom;

use Medians\Builders\Infrastructure\BuilderRepository;
use Medians\Templates\Infrastructure\EmailTemplateRepository;
use Medians\Content\Infrastructure\ContentRepository;
use Medians\Pages\Infrastructure\PageRepository;
use Medians\OnlineConsolutations\Domain\OnlineConsolutation;
use Medians\Offers\Domain\Offer;
use Medians\Languages\Infrastructure\Language;
use Medians\Doctors\Domain\Doctor;
use Medians\Blog\Domain\Blog;
use Medians\Pages\Domain\Page;
use Medians\Specializations\Domain\Specialization;


class BuilderController extends CustomController 
{	

	
	protected $app;
	protected $repo;
	public $contentRepo;
	public $pageRepo;
	public $emailTemplateRepo;
	public $emailController;

	function __construct()
	{
		$this->app = new \Config\APP;

		$this->repo = new BuilderRepository;
		$this->contentRepo = new ContentRepository;
		$this->pageRepo = new PageRepository;
		$this->emailTemplateRepo = new EmailTemplateRepository;

		$this->emailController = new EmailBuilderController;

	}

	/**
	 * Index builder 
	 */ 
	public function index()
	{
		try {
			
			$request = $this->app->request();

			$lang = $request->get('lang') ?? $this->app->setLang()->lang;
			$type = $request->get('item_type') ?? 'Page';
			$itemId = $request->get('item_id');
			
			if ($request->get('prefix'))
			{
				$item = $this->contentRepo->find($request->get('prefix'));
			} else {
				$item = $this->contentRepo->findItemByLang($itemId, $lang, $type );
			}
			
			$check = isset($item->item_type) ? (new $item->item_type)->find($item->item_id) : null;

			(empty($check->content)) ? $this->handleMissingContent($type, $itemId, $lang) : null;

			return render('views/admin/builder/index.html.twig', [
				'page' => $item ?? $check->lang_content, 
				'item' => $check,
				'current_lang' => $lang,
				'isEmpty' => trim($item->content) == null,
				'canScrab' => true,
				'canCreate' => true,
				'type' => $type,
				'item_id' => $item->item_id,
			]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	}


	public function handleMissingContent($type, $itemId, $lang)
	{
		try 
		{
			switch (strtolower($type)) {
				case 'doctor':
					$type = Doctor::class;
					break;
				case 'blog':
					$type = Blog::class;
					break;
			}

			if (class_exists($type))
			{

				$pageRepo = new \Medians\Pages\Infrastructure\PageRepository;

				$save = $pageRepo->storeLang(['item_type' => $type, 'title'=>'.'] , $lang, $itemId);
				
				return $save;
			}

		} catch (\Throwable $th) {

			return null;
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
	public function template_preview()
	{
		try {
			
			$request = $this->app->request();

			$check = $this->contentRepo->find($request->get('prefix'));

			render('views/email/email.html.twig',['msg'=>$check->content]);

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

			if ($request->get('type') == 'email')
			{
				return $this->email_languages();
			}

			$lang = $request->get('lang') ? $request->get('lang') : $this->app->setLang()->lang;
			$type = $request->get('item_type') ?? 'Page';
			$itemId = $request->get('item_id') ?? $request->get('prefix');
			
			if ($request->get('prefix'))
			{
				$item = $this->contentRepo->find($request->get('prefix'));
				
			} else {
				
				$item = $this->contentRepo->findItemByLang($itemId, $lang, $type );
			}

			$check = isset($item->item_type) ? (new $item->item_type)->find($item->item_id) : null;

			$check->content = $check->lang_content = $item;
				
			return render('views/admin/builder/templates/languages.html.twig',['page'=>$check, 'type' => $type, 'item_id' => $item->item_id , 'current_lang' => $lang]);

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	}

	/**
	 * Load builder meta
	 */ 
	public function email_languages()
	{
		try {
			
			$request = $this->app->request();
		
			$check = $this->emailTemplateRepo->find($request->get('item_id'));
			
			return render('views/admin/builder/templates/email_languages.html.twig',['page'=>$check]);

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
		
		if (!$request->get('contentJSON') || !$request->get('id'))			
			return true;

		$contentJSON = json_decode($request->get('contentJSON'));
		$check = $this->contentRepo->findById($request->get('id'));
		$check->content = str_replace('data-src', 'src', $contentJSON->contentArea);
		$check->update(['content' => $check->content]);
		echo $check->content;

		return $this->handleCache($check);
		
	}

	public function handleCache($object)
	{
		$cacheFile = $_SERVER['DOCUMENT_ROOT'].'/app/cache/_'. $object->prefix. '.html';

		switch ($object->item_type) {
			case Doctor::class:
				# code...
				break;
			
			case Blog::class:
				(new \Medians\Blog\Application\BlogController)->cache_page($object);
				break;
			
			case Page::class:
				(new \Medians\Pages\Application\PageController)->cache_page($object);
				break;
			
			case Specialization::class:
				# code...
				break;
			
			default:
				# code...
				break;
		}
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
					echo $this->repo->findEmailBlock($request->get('id'))->content;
					return true;		
					break;

			}

			if ($request->get('prefix') && $supermode == 'updateMeta')
			{

			}

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	}

	

	/**
	 * Load builder mew block page
	 */ 
	public function new_get()
	{
		try {

			return render('views/admin/builder/templates/new.html.twig',[]);

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
		$request = $this->app->request();

		$url = $request->get('url');
		$category = $request->get('category');
		$template = $request->get('template');

		$sections = $this->scrapeAndExtractSections($url);

		foreach ($sections as $key => $section) {
			$section = str_replace('assets/','https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/', $section);
			$this->repo->store(['content'=>$section, 'category'=>$category, 'template'=>$template]);
		}

		echo translate('Done');
	}
}

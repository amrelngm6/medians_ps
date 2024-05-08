<?php

namespace Medians\Builders\Application;
use Shared\dbaser\CustomController;

use Medians\Builders\Infrastructure\BuilderRepository;
use Medians\Templates\Infrastructure\EmailTemplateRepository;
use Medians\Content\Infrastructure\ContentRepository;
use Medians\Pages\Infrastructure\PageRepository;


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

			$lang = $request->get('lang') ? $request->get('lang') : $this->app->setLang()->lang;
			$check = $this->pageRepo->findByLang($request->get('page_id'), $lang );

			(isset($check->page_id) && !$check->lang_content) ? $this->contentRepo->handleMissingContent($check, $lang) : null;
			$check->content = $check->lang_content;
			return render('views/admin/builder/index.html.twig', [
				'page' => $check->lang_content ?? [], 
				'item' => $check,
				'current_lang' => $lang,
				'precode' => isset($check->lang_content) && (substr(trim($check->lang_content), 0, 8) == '<section') ? '' : '<section id="newKeditItem" class="kedit">', 
				'postcode' => isset($check->lang_content) && (substr(trim($check->lang_content), 0, 8) == '<section') ? '' : '</section>', 
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
			$check = $this->pageRepo->findByLang($request->get('item_id'), $lang );

			return render('views/admin/builder/templates/languages.html.twig',['page'=>$check, 'current_lang' => $lang]);

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
					echo $this->repo->findEmailBlock($request->get('id'))->content;
					// echo $this->app->renderTemplate($this->repo->findEmailBlock($request->get('id'))->content)->render( ['app' => $this->app ]  );
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

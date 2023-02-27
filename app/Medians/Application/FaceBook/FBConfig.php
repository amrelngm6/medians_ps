<?php

namespace Medians\Application\FaceBook;


use Medians\Infrastructure as Repo;




class FBConfig 
{


	/**
	* @var Instance
	*/
	private $repo;



	function __construct($repo)
	{

		$this->repo = $repo;

	}


	/**
	 * Display login page 
	 * 
	 */
	public function fbConfigQuery()
	{
	    return $this->repo->getAll()->first();
	}

	public function fbConfig()
	{

		$config = $this->fbConfigQuery();

	    return new \Facebook\Facebook([
	        'app_id' => $config->api_id, 
	        'app_secret' => $config->api_secret,
	        'default_graph_version' => 'v10.0',
	        'fileUpload'    =>TRUE
	    ]);
	}

	public function fbConfigHelper()
	{
	    return $this->fbConfig()->getRedirectLoginHelper();
	}

}

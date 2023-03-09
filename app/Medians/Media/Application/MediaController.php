<?php

namespace Medians\Media\Application;

use Medians\Media\Infrastructure\MediaRepository;


class MediaController
{

	function __construct()
	{
		$this->repo = new MediaRepository;
	}

	public function list()
	{

		return json_encode($this->repo->getList());

	}


	public function media()
	{
		$this->app = new \config\APP;

		echo json_encode(['media'=> ($this->app->request()->get('page') == 1) ? $this->repo->getList($this->app->request()->get('media')) : []]);

	}

	public function upload()
	{
		$this->app = new \config\APP;

		foreach ($this->app->request()->files as $key => $value) {
			$this->repo->upload($value);
		}
		return json_encode(['data'=> ['message'=>'Uploaded successfully']]);
		
	}

	public function delete()
	{
		try {
			

			$this->app = new \config\APP;
		
		    $item = json_decode($this->app->request()->get('file_name'));

			echo $this->repo->delete($item->file_name);

			echo json_encode(['data'=> ['message'=>__('Deleted')]]);
			

		} catch (\Exception $e) {
			throw new Exception("Error Processing Request ".$e->getMessage(), 1);
			
		}
	}



}

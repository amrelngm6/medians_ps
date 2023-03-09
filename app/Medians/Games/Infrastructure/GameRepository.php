<?php

namespace Medians\Games\Infrastructure;

use Medians\Games\Domain\Game;


class GameRepository 
{

	function __construct()
	{
		$this->app = new \config\APP;
	}


	public static function getModel()
	{
		return new Game();
	}


	public function find($id)
	{
		return Game::with('cat')->withCount('devices')->find($id);
	}

	public function get($limit = 100)
	{
		return Game::withCount('devices')->with('cat')->where('branch_id', $this->app->branch->id)->limit($limit)->get();
	}





	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Game();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}		

		// Return the FBUserInfo object with the new data
    	$Object = Game::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Game::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);

    	return $Object;

    }


	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function delete($id) 
	{
		try {
			
			return Game::find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


 
}

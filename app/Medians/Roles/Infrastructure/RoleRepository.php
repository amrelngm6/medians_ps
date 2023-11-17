<?php

namespace Medians\Roles\Infrastructure;

use Medians\Roles\Domain\Role;


class RoleRepository 
{



	public function find($id)
	{
		return Role::find($id);
	}

	public function get($limit = 100)
	{
		return Role::limit($limit)->get();
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{
		$Model = new Role();
		
		$dataArray = array('name'=>$data['name']);
		
		// Return the FBUserInfo object with the new data
    	$Object = Role::create($dataArray);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Role::find($data['id']);
		
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
			
			$delete = Student::find($id)->delete();
			return true;

		} catch (\Exception $e) {
			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
		}
	}


 
}
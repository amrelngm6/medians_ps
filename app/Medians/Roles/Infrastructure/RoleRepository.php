<?php

namespace Medians\Roles\Infrastructure;

use Medians\Roles\Domain\Role;
use Medians\Roles\Domain\Permission;


class RoleRepository 
{



	public function find($id)
	{
		return Role::find($id);
	}

	public function get($limit = 100)
	{
		return Role::with('permissions','permissions_group')->limit($limit)->get();
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{
		$Model = new Role();
		
		$dataArray = array('name'=>$data['name']);

		// Return the  object with the new data
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

		if (isset($data['permissions']))
		{
			$this->updatePermissions($data['permissions']);
		}

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
			
			$delete = $id > 3 ? Role::find($id)->delete() : '';
			return true;

		} catch (\Exception $e) {
			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
		}
	}

	/**
	* Update permissions of role
	*
	* @Returns Boolen
	*/
	public function updatePermissions($data) 
	{
		try {
			
			print_r($data);
			$Model = new Permission();
			
			foreach ($data as $key => $value) 
			{
				$permission = Permission::find($value['permission_id']);
				$permission->update(['access'=> $value['access'] ? 1 : null]);
			}		
			
			return true;

		} catch (\Exception $e) {
			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
		}
	}


 
}
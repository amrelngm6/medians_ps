<?php

namespace Medians\Menus\Infrastructure;

use Medians\Menus\Domain\Menu;
use Medians\Menus\Domain\MenuField;



/**
 * Menu class database queries
 */
class MenuRepository 
{

	/**
	* Find item by `id` 
	*/
	public function find($id) 
	{

		return Menu::find($id);
	}

	/**
	* Find items by `params` 
	*/
	public function get($params = null) 
	{
		return Menu::with('children', 'page')->get();
	}


	public function getMenuPages($type)
	{
		return Menu::where('type', $type)
		->whereHas('page', function($q) {
			$q->where('status', 'on');
		})
		->get();
	}


	/**
	* Update item to database
	*/
    public function update($params)
    {
		Menu::where('type', $params['type'])->delete();
		foreach ($params['items'] as $key => $item )
		{
			
			try {
				
				$value = (array) $item;
				$fields = [];
				$fields['name'] = $value['name'];	
				$fields['page_id'] = $value['page_id'];	
				$fields['parent_id'] = 0;	
				$fields['position'] = $key;	
				$fields['type'] = isset($params['type']) ? $params['type'] : 'header';	
				$Model = Menu::firstOrCreate($fields);

			} catch (\Throwable $th) {
				throw new \Exception($th->getMessage(), 1);
			}
			
		}

		return isset($Model) ? $Model : null;		
    } 



	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function delete($id) 
	{
		try {
			
			return Menu::find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


	
	/**
	* Save related items to database
	*/
	public function storeItems($data, $id) 
	{
		Menu::where('type', $type)->delete();

		if ($data)
		{

			foreach (json_decode($data) as $item )
			{
				
				try {
					
					$value = (array) $item;
					if (isset($value['title']) && isset($value['code']))
					{
						$fields = [];
						$fields['menu_id'] = $id;	
						$fields['title'] = $value['title'];	
						$fields['code'] = $value['code'];	
						$fields['type'] = isset($value['type']) ? $value['type'] : 'text';	
						
						$Model = MenuField::firstOrCreate($fields);
					}

				} catch (\Throwable $th) {
					error_log($th->getMessage());
				}
				
			}
	
			return $Model;		
		}
	}
}
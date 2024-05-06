<?php

namespace Medians\Menus\Domain;

use Medians\Pages\Domain\Page;
use Shared\dbaser\CustomModel;

/**
 * Transaction class database queries
 */
class Menu extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'menus';

    protected $primaryKey = 'menu_id';

	protected $fillable = [
		'type',
    	'name',
    	'page_id',
		'parent_id',
		'position',
	];


    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'menu_id');
    }

    public function page()
    {
        return $this->hasOne(Page::class, 'page_id', 'page_id');
    }


}

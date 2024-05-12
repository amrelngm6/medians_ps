<?php

namespace Medians\Products\Domain;

use Medians\Categories\Domain\Category;
use Medians\Shipping\Domain\Shipping;
use Medians\Content\Domain\Content;
use Medians\CustomFields\Domain\CustomField;
use Shared\dbaser\CustomModel;


class Product extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'products';

    protected $primaryKey = 'product_id';
	
	public $fillable = [
		'name',
		'description',
		'old_price',
		'price',
		'picture',
		'category_id',
		'user_type',
		'user_id',
		'status',
	];

	public $appends = ['content_langs', 'lang_content','class_name'];

	public function getClassNameAttribute()
	{
		return 'Product';
	} 

	public function getContentLangsAttribute()
	{
		return $this->langs->keyBy('lang');
	} 


	public function getLangContentAttribute()
	{
		$lng = curLng();
		return isset($this->content_langs[$lng]) ? $this->content_langs[$lng] : [];
	} 


	/**
	 * Relations with onother Models
	 */
	public function category() 
	{
		return $this->hasOne(Category::class , 'category_id', 'category_id')->where('model', Product::class)->with('parent');	
	}
	 
	public function shipping() 
	{
		return $this->hasManyThrough(Shipping::class, ProductShipping::class, 'product_id', 'shipping_id', 'product_id', 'shipping_id');	
	}

	public function product_categories() 
	{
		return $this->hasManyThrough(Category::class, ProductCategory::class, 'product_id', 'category_id', 'product_id', 'category_id');	
	}

	public function product_colors() 
	{
		return $this->hasMany(ProductColor::class , 'product_id', 'product_id');	
	}
	

	public function product_sizes() 
	{
		return $this->hasMany(ProductSize::class , 'product_id', 'product_id');	
	}
	

	public function product_tags() 
	{
		return $this->hasMany(ProductTag::class , 'product_id', 'product_id');	
	}
	
	public function variants() 
	{
		return $this->morphMany(CustomField::class , 'model')->where('code', 'variants');	
	}
	

	public function images() 
	{
		return $this->hasMany(ProductImage::class , 'product_id', 'product_id');	
	}
	
	public function product_fields() 
	{
		return $this->hasOne(ProductField::class , 'product_id', 'product_id');	
	}
	
	public function langs() 
	{
		return $this->morphMany(Content::class , 'item')->groupBy('lang');	
	}
	
	public function lang_content() 
	{
		return $this->morphOne(Content::class , 'item')->where('lang', curLng());	
	}

}

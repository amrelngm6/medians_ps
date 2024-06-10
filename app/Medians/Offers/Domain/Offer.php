<?php

namespace Medians\Offers\Domain;

use Shared\dbaser\CustomModel;
use \Medians\Specializations\Domain\Specialization;
use \Medians\CustomFields\Domain\CustomField;


class Offer extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'offers';

    protected $fillable = [
        'title',
        'price',
        'speciality_id',
        'status',
        'created_by',
    ];



    public $appends = ['field','speciality_name'];


    public function getFieldAttribute() 
    {
        return !empty($this->custom_fields) ? array_column($this->custom_fields->toArray(), 'value', 'code') : [];
    }

    public function custom_fields()
    {
        return $this->morphMany(CustomField::class, 'model');
    }


    public function getSpecialityNameAttribute() 
    {
        return !empty($this->speciality) ? $this->speciality->title : '';
    }

    public function getFields()
    {
        return $this->fillable;
    }

    public function speciality()
    {
        return $this->belongsTo(Specialization::class);
    }


}

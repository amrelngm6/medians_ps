<?php

namespace Medians\OnlineConsultations\Domain;

use Shared\dbaser\CustomModel;
use \Medians\Doctors\Domain\Doctor;
use \Medians\CustomFields\Domain\CustomField;
use \Medians\Content\Domain\Content;


class OnlineConsultation extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'online_consultation';

    protected $fillable = [
        'price',
        'doctor_id',
        'status',
        'sorting',
        'created_by',
    ];


    public $appends = ['field','doctor_name'];


    public function getFieldAttribute() 
    {
        return !empty($this->custom_fields) ? array_column($this->custom_fields->toArray(), 'value', 'code') : [];
    }

    public function getDoctorNameAttribute() 
    {
        return !empty($this->doctor->title) ? $this->doctor->title : '';
    }

    public function custom_fields()
    {
        return $this->morphMany(CustomField::class, 'model');
    }


	public function getFields()
	{
		return $this->fillable;
	}

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function lang_content()
	{
		return $this->morphOne(Content::class, 'item')->where('lang',$_SESSION['lang']);
	}



}

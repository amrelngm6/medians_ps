<?php

namespace Medians\Trips\Domain;

use Shared\dbaser\CustomModel;

use Medians\Trips\Domain\Trip;
use Medians\Trips\Domain\PrivateTrip;


class TripTrack extends CustomModel
{

	/*
	/ @var String
	*/
	protected $table = 'trip_track';

    protected $primaryKey = 'trip_track_id';
	
	public $fillable = [
		'trip_id',
		'trip_type',
		'latitude',
		'longitude',
		'speed',
		'speed_accuracy',
	];


	public function trip() 
	{
		return $this->morphTo();	
	}

    public function addItem($data)
    {
        $data['trip_type'] = $this->handleTripType($data['trip_type']);
        
        return TripTrack::firstOrCreate($data);
    }

    public function handleTripType($type)
    {
        switch (strtolower($type)) 
        {
            case 'trip':
                return Trip::class;
                break;
        
            case 'privatetrip':
                return PrivateTrip::class;
                break;
            
            default:
                return $type;
                break;
        }
    }


}

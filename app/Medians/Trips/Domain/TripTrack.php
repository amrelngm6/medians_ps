<?php

namespace Medians\Trips\Domain;

use Shared\dbaser\CustomModel;

use Medians\Trips\Domain\Trip;
use Medians\Trips\Domain\TaxiTrip;


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

    public static function addItem($data)
    {
        $data['trip_type'] = TripTrack::handleTripType($data['trip_type']);

        return TripTrack::firstOrCreate($data);
    }

    public static function handleTripType($type)
    {
        switch (strtolower($type)) 
        {
            case 'trip':
                return Trip::class;
                break;
        
            case 'taxitrip':
            case 'taxiTrip':
                return TaxiTrip::class;
                break;
            
            default:
                return $type;
                break;
        }
    }


}

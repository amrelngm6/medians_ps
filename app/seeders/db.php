<?php
include_once('vendor/autoload.php');
$pdo = new PDO('mysql:host=localhost;dbname=medians_ps', 'root', 'root');
$seeder = new \tebazil\dbseeder\Seeder($pdo);

$array = [
	'apartment'=>'Apartment',
	'apartment_block'=>'Apartment Block',
	'Duplex'=>'Duplex',
	'Penthouse'=>'Penthouse',
	'Studio'=>'Studio',
	'Building'=>'Building',
	'shopping_mall'=>'Shopping Mall',
	'Multipurpose_space'=>'Multipurpose space',
];

$cols = [];
foreach ($array as $key => $value) 
{
	$cols[] = [
		'id',
	    'model' => "Medians\\Domain\\Properties\\Property",
	    'title'=>$value,
	    'code'=>strtolower($key),
	    'category'=>'type',
	    'position'=>1,
	];
}
$cols = array_filter($cols);
$seeder->table('model_options')->data($cols, [false,'model','title','code','category','position'])->rowQuantity(count($cols));
$seeder->refill();


$seeder->table('properties')->data([['1', '2', 1],['2', '4', 1]], ['name','description','status'])->rowQuantity(2);
$seeder->refill();


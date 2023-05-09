<?php

namespace Medians\Reports\Application;

use Medians\Reports\Infrastructure as Repo;



class ReportController
{


	/*
	/ @var new ReportRepository
	*/
	private $repo;


	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new Repo\ReportRepository($this->app);
	}


	/**
	 * Index page
	 * 
	 */
	public function index($report)
	{
		return render('views/admin/reports/list.html.twig', [
			'reports' =>  $this->query($report),
	        'title' => 'Reports',
	        'app' => $this->app,
	    ]);
	} 


	/**
	 * Create page
	 * 
	 */
	public function query($report)
	{
		$return = '';
		$title = '';
		switch ($report) 
		{
			case 'orders':
				$return = $this->repo->orders_report(5);
				break;
		}

		return  $this->filterReport($return, $title);
	} 





	/**
	*  Filter report
	*/
	public function filterReportLabel($type, $data) 
	{
		$list = [];
		foreach ($data as $key => $value) 
		{
			$list[$key] = isset($value->$type) ? $value->$type : null;
		}

		return $list;
	}



	/**
	*  Filter report
	*/
	public function filterReportColors($data) 
	{

        $colors = ['rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(205, 255, 86)',
            'rgb(86, 205, 86)',
            'rgb(54, 162, 235)',
        ];

		$list = [];
		foreach ($data as $key => $value) 
		{
			$list[$key] = $colors[$key];
		}

		return $list;
	}


	/**
	*  Store item
	*/
	public function filterReport($data, $title) 
	{
		return array(
			'labels' => $this->filterReportLabel('title', $data),
			'datasets' => [
				array(
					'label'=> $title
					,'data'=> $this->filterReportLabel('bookings_count', $data)
					,'backgroundColor'=> $this->filterReportColors($data)
					,'hoverOffset'=> 4
				)
			]
		);
	} 


	


	/**
	*  Store item
	*/
	public function store() 
	{


		$params_request = $this->app->request()->get('params');
		$params = isset($params_request['report']) ? (array) json_decode($params_request['report']) : $params_request;

		try {	

			if (empty($params['name']))
	        	return array('error'=>__('Name is required'), 'result'=>__('Name is required'));

			if (empty($params['mobile']))
	        	return array('error'=> __('Phone is required'), 'result'=> __('Phone is required'));

			if (strlen($params['mobile']) != 11)
	        	return array('error'=> __('MOBILE_ERR'), 'result'=> __('MOBILE_ERR') );

			$params['created_by'] = $this->app->auth()->id;
			$Item = $this->repo->store($params);

        	return array('success'=>1, 'result'=> $Item);

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}



	/**
	*  Store item
	*/
	public function update($request, $app) 
	{

		$params = (array)  json_decode($request->get('params')['report']);

		try {

			$this->repo->app = $app;
			$Property = $this->repo->update($params);

        	return array('success'=>1, 'result'=>'Updated');

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}


	/**
	 * Find report by mobile
	 */

	public function search($text)
	{
		$data = $this->repo->search($text);


		echo json_encode(array('success'=>1, 'result'=> $data->toArray()));

	}  

}

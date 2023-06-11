<?php

namespace Medians\Reports\Application;
use \Shared\dbaser\CustomController;

use Medians\Reports\Infrastructure as Repo;



class ReportController extends CustomController
{


	/*
	/ @var new ReportRepository
	*/
	private $repo;


	function __construct()
	{

		$this->app = new \config\APP;

		$this->repo = new Repo\ReportRepository();
		$this->userRepo = new \Medians\Users\Infrastructure\UserRepository;
		$this->branchRepo = new \Medians\Branches\Infrastructure\BranchRepository;
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
	 * Handle the rdaily reports
	 * for all branches
	 */ 
	public function handleDailyReports()
	{
		foreach ($this->branchRepo->getIds() as $key => $value) 
		{
			$save = $this->store($value->id);
		}

		return $this;
	}


	/**
	*  Store item
	*/
	public function store(Int $branchId) 
	{

		try {	
	

			$DashboardController = new \Medians\DashboardController;
			$branch = $this->branchRepo->find($branchId);
			$a = new \Medians\Auth\Application\AuthService;
			// $this->app->setBranch($branch);


			$DashboardController->start = date('Y-m-d') . ' 00:00:00';
			$DashboardController->end = date('Y-m-d') . ' 23:59:59';
			// $DashboardController->start = '2023-0-01 00:00:00';
	        $data['bookings_count'] = $DashboardController->DevicesRepository->eventsByDate(['start'=>$DashboardController->start, 'end'=>$DashboardController->end], $branchId)->where('status', 'paid')->count();
	        $data['products_count'] = $DashboardController->StockRepository->getLatest(1000, $branchId)->where('type', 'pull')->where('date' ,'>=', $DashboardController->start)->count();
	        $data['products_sales'] = $DashboardController->OrderDevicesRepository->loadProductsIncome(['start'=>$DashboardController->start, 'end'=>$DashboardController->end], $branchId);
	        $data['bookings_sales'] = $DashboardController->OrderDevicesRepository->loadBookingsIncome(['start'=>$DashboardController->start, 'end'=>$DashboardController->end], $branchId);

			$data['expenses'] = $DashboardController->ExpensesRepository->getSumByDate('amount', $DashboardController->start, $DashboardController->end, $branchId);

    		$data['tax'] = $DashboardController->DevicesRepository->getSumByDate('tax',$DashboardController->start,$DashboardController->end, $branchId);

    		$data['discounts'] = $DashboardController->DevicesRepository->getSumByDate('discount',$DashboardController->start,$DashboardController->end, $branchId);

    		$revenue = $DashboardController->DevicesRepository->getSumByDate('subtotal',$DashboardController->start,$DashboardController->end, $branchId);

    		$data['revenue'] = $this->getRevenue($revenue, $data);

			foreach ($data as $key => $value) {
				$data[$key] = $value ? round((float) $value, 2) : 0;
			}

			$data['branch_id'] = $branchId;
			$data['date'] = date('Y-m-d');

			$this->repo->store_daily_report($data);

        } catch (Exception $e) {

        }
	}



	/**
	*  Store item
	*/
	public function getRevenue($revenue, $data) 
	{

		$val = round($revenue, 2);

		if (!empty($data['expenses']))
			$val -= round($data['expenses'], 2);


		if (!empty($data['tax']))
			$val -= round($data['tax'], 2);


		return $val;
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

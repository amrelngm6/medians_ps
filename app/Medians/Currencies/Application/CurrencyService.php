<?php

namespace Medians\Currencies\Application;
use \Shared\dbaser\CustomController;

use Medians\Currencies\Infrastructure\CurrencyRepository;
use Medians\Users\Domain\User;

class CurrencyService
{

	
	public $app;

	public $repo;


	function __construct()
	{

		$this->app = new \config\APP;
		
		$this->repo = new CurrencyRepository();
	}
	
	
	public function getCurrency($currencyCode)
	{
		try {

            $result = $this->repo->load($currencyCode);

            if ($result->last_check == date('Y-m-d'))
            {
    			echo($result ? json_encode($result) : '');
                
            } else {
                
                $response = $this->checkAPI($setting['currency'], $currencyCode);

                $data = [
                    'code' => $currencyCode,
                    'ratio' => $response['data'][$currencyCode]['value']
                ];

                if ($this->repo->update($data ))
                {
                    return $this->getCurrency($currencyCode);
                }
            }

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}
	
	
	public function load()
	{
		try {

            $result = $this->repo->load_active();
			echo(json_encode($result));

		} catch (\Throwable $th) {
			return array('error'=>$th->getMessage());
		}
	}
	

	public function update()
	{
		$params = $this->app->request()->get('params');

        try {

            if ($this->repo->update($params))
            {
                return array('success'=>1, 'result'=>translate('Updated'), 'reload'=>1);
            }

        } catch (\Exception $e) {
        	throw new \Exception("Error Processing Request", 1);
        	
        }
	}

    
	public function checkAPI($from, $to)
	{
        $stting = $this->app->SystemSetting();
		$currencyApi = new \CurrencyApi\CurrencyApi\CurrencyApiClient($stting['currency_converter_api']);
		return $currencyApi->latest([
			'base_currency' => $from,
			'currencies' => $to,
		]);
	}

}

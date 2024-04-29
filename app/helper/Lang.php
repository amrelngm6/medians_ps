<?php

namespace helper;

use Medians\Languages\Infrastructure\TranslationRepository;

class Lang
{
	public $lang;
	
	public $repo;
	
	function __construct($lang)
	{
		$this->lang = $lang;
		$this->repo = new TranslationRepository();
	}

	public function load()
	{
		switch ($this->lang) 
		{
			default:
				return array_column($this->repo->findByLang($this->lang), 'code', 'value');
				break;
		}
	}

	
	public function translate($langkey)
	{
		return $this->repo->findByCodeLang($langkey, $this->lang) ;
	}

}


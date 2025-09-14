<?php

namespace helper;

use Medians\Languages\Infrastructure\TranslationRepository;

class Lang
{
	public $lang;
	
	public $repo;

	private $translations = [];
	
	function __construct($lang, $langs = null)
	{
		$this->lang = $lang ?? 'english';
		$this->repo = new TranslationRepository();
		$this->translations = $langs ?? include(__DIR__.'/langs/'.$lang.'.php');
	}

	public function load()
	{
		switch ($this->lang) 
		{
			default:
				return $this->translations;
				break;
		}
	}

	
	public function translate($langkey)
	{
		if ($langkey == 'lang') return $this->lang;
		return $this->translations[$langkey] ?? ucfirst(str_replace('_', ' ', $langkey));
	}

}


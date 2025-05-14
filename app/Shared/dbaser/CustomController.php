<?php

namespace Shared\dbaser;


/**
 * Using this class for the common
 * functions between Controllers
 * and services inside APP layer
 * 
 */   
class CustomController 
{
	
    /** 
     * Handle the request and check if it has nofollow at head  
     * 
     * */
    public function filterHeadIndexMeta($item  )
    {
        $arr = explode('/', $_SERVER['REQUEST_URI']);
        if (count(array_filter($arr)) > 1 && !empty($arr[1] != 'en')) {
            return true;
        } else {
            return $item->noindex ?? false;
        }
    }
}




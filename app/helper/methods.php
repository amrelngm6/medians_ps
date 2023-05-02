<?php

try {
    
    $app = new \config\APP;
    $lng = isset($app->auth()->branch->id) && !empty($app->setting('lang')) ? $app->setting('lang') : 'arabic';

    include('app/helper/langs/'.$lng.'.php');
    

} catch (\Exception $e) {
    throw new Exception($e->getMessage(), 1);    
}




/** 
 * Render function
 * @param String twig file path
 * @param [] List of data
 */
function render($path, $data, $responseType = 'html')
{

    try {
        
        $app = new \config\APP;
            
        $ettings = $app->Settings();
        
            
    } catch (\Exception $e) {
        echo ('CHECK DATABASE CONNECTION ');
        die();
    }

    /**
     * Check if response is required in JSON
     */  
    if (!empty($app->request()->get('load')) && $app->request()->get('load') == 'json' )
    {
        echo json_encode($data);
        return true;
    }

    /**
     * While request is not required in JSON
     * Response will be override only
     * In case the system works In Vue APP
     */ 
    $path = isset($data['override_vue']) ? $path : 'views/admin/vue.html.twig';

    $app = new \config\APP;
    $data['app'] = $app;
    $data['app']->auth = $app->auth();
    $data['app']->branch = $app->branch;
    $data['app']->Settings = $ettings;
    $data['startdate'] = !empty($app->request()->get('start')) ? $app->request()->get('start') : date('Y-m-d');
    $data['enddate'] = !empty($app->request()->get('end')) ? $app->request()->get('end') : date('Y-m-d');
    $data['lang'] = new Langs;
    
    echo $app->template()->render($path, $data);
 } 



/**
 * Page not found 
 * @param Object $twig, Object $app 
 * @return Page not found template 
 */
function Page404()
{
    $app = new \config\APP;
    return $app->template()->render('views/404.html.twig', [
        'title' => 'Page not found',
        'app' => $app
    ]);
}


/**
 * Page not authorized 
 * @param Object $twig, Object $app 
 * @return Page not found template 
 */
function Page403()
{
    $app = new \config\APP;
    return $app->template()->render('views/admin/404.html.twig', [
        'title' => 'Not authorized to acces this Page.',
        'app' => '',
    ]);
}



/**
 * Handle routes response 
 * based on session & Permissions
*/
function response($response)
{
    
    $app = new \config\APP;

	echo isset($app->auth()->id) ? (is_array($response) ? json_encode($response) : $response) : Page403();

}

/** 
 * Filter language variable by code
 * 
 * @param String $langkey
 * @return String 
*/ 
function __($langkey = null)
{
    return Langs::__($langkey);
}


<?php
    
try {
    
    $app = new \config\APP;

    $lng = isset($app->auth()->branch->id) && !empty($app->setting('lang')) ? $app->setting('lang') : 'english';

    include('app/helper/langs/'.$lng.'.php');


} catch (\Exception $e) {
    throw new Exception($e->getMessage(), 1);    
}




/** 
 * Render function
 * @param String twig file path
 * @param [] List of data
 */
function render($path, $data)
{

    try {
        
        $app = new \config\APP;
            
        $ettings = $app->Settings();
        
            
    } catch (\Exception $e) {
        echo ('CHECK DATABASE CONNECTION ');
        die();
    }

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


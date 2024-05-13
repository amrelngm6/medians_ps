<?php

$app = new \config\APP;
$app->setLang();

use Shared\simple_html_dom;

/** 
 * Render function
 * @param String twig file path
 * @param [] List of data
 */
function render($template, $data, $responseType = 'html')
{

    $app = new \config\APP;

    /**
     * Check if response is required in JSON
     */  
    if (!empty($app->request()->get('load')) && $app->request()->get('load') == 'json' )
    {
        echo json_encode($data);
        return true;
    }

    /**
     * Response will be override only
     * In case the system works In Vue APP
     */ 
    $isFront = strpos($template, 'front/');
    
    $path = isset($data['load_vue']) ? 'views/admin/vue.html.twig' : $template;
    $app = new \config\APP;
    $data = loadConfig($template, $data);
    $output =  $app->template()->render($path, $data);

    $isFront ? file_put_contents($_SERVER['DOCUMENT_ROOT'].'/app/cache/'. (str_replace('/', '_', $app->currentPage)). '.html', $output) : '';
    
    if ($responseType == 'html')
    {
        echo $output;
    } else {
        return $output;
    }
 } 


 /**
  * Load the main configuration in Array
  */
  function loadConfig($template, $data)
  {
    

    try {
        
        $app = new \config\APP;
            
        $business_setting = $app->BusinessSettings();
        $setting = $app->SystemSetting();
        $languages = $app->Languages();  
        
            
    } catch (\Exception $e) {
        echo ('CHECK DATABASE CONNECTION ');
        die();
    }
    $app = new \config\APP;
    $data['component'] = $template;
    $data['app'] = $app;
    $data['app']->auth = $app->auth();
    $data['app']->business_setting = $business_setting;
    $data['app']->setting = $setting;
    $data['app']->currency = $app->currency();
    $data['menu'] = $app->menu();
    $data['langs'] = $languages;
    $data['startdate'] = !empty($app->request()->get('start')) ? $app->request()->get('start') : date('Y-m-d');
    $data['enddate'] = !empty($app->request()->get('end')) ? $app->request()->get('end') : date('Y-m-d');
    $data['lang'] = new helper\Lang($_SESSION['lang']);
    $data['lang_json'] = (new helper\Lang($_SESSION['lang']))->load();
    $data['lang_key'] = substr($_SESSION['lang'],0,2);
    return $data;
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
 * Page not found 
 * @param Object $twig, Object $app 
 * @return Page not found template 
 */
function errorPage($data)
{
    $app = new \config\APP;
    echo $app->template()->render('views/front/error.html.twig', [
        'title' => 'Error',
        'msg' => $data,
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
function translate($langkey = null)
{
    $translation = (new helper\Lang($_SESSION['lang']))->translate($langkey);
    return $translation ?? ucfirst(str_replace('_', ' ', $langkey));
}




/**
 * Extract sections from html page
 */
function scrapeAndExtractSections($url) 
{
    // Initialize cURL session
    $ch = curl_init($url);
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session and get the HTML content
    $htmlContent = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        curl_close($ch);
        return;
    }

    // Close cURL session
    curl_close($ch);

    // Create a SimpleHTMLDom object
    $dom = new simple_html_dom();
    
    // Load HTML content into the DOM parser
    $dom->load($htmlContent);

    // Find and extract section elements
    $sections = array();
    foreach ($dom->find('section') as $section) {
        // Add section content to the array
        $sections[] = $section->outertext;
    }

    // Clean up the DOM parser
    $dom->clear();
    
    // Output the extracted sections
    return $sections;
}

/**
 * Secure the inputs from XSS vulneribility
 * Save from cyber attacks
 */
function sanitizeInput($input) {
    if (!$input)
        return;
    
    if (is_array($input) || is_object($input)) {
        // If input is an array, sanitize each element recursively
        foreach ($input as $key => $value) {
            $input[$key] = is_array($value) ? sanitizeInput($value) : (sanitizeInput($value) ?? '');
        }
        return $input;
    } else {
        // If input is a string, sanitize it
        return str_replace(["&lt;", "&quot", "&gt;"], "",  htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    }
}

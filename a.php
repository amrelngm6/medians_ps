<?php


// Function to scrape URL and extract section elements
function scrapeAndExtractSections($url) {
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
    print_r($sections);
}

// URL to scrape
$url = 'https://winsfolio.net/html/sasnio/index-3.html';

// Call the function
scrapeAndExtractSections($url);
?>

<?php
/**
 * Google Reviews Fetcher - PHP Class to load reviews from Google Places API
 * 
 * Requirements:
 * - Google Places API Key
 * - cURL extension enabled
 * - Write permissions for cache directory
 */

class GoogleReviewsFetcher {
    
    private $api_key;
    private $place_id;
    private $cache_duration = 3600; // 1 hour cache
    private $cache_dir = 'cache/';
    private $enable_cache;
    private $sort_by_latest;
    
    public function __construct($api_key, $place_id, $enable_cache = true, $sort_by_latest = true) {
        $this->api_key = $api_key;
        $this->place_id = $place_id;
        $this->enable_cache = $enable_cache;
        $this->sort_by_latest = $sort_by_latest;
        
        // Create cache directory if it doesn't exist
        if (!is_dir($this->cache_dir)) {
            mkdir($this->cache_dir, 0755, true);
        }
    }
    
    /**
     * Main function to get reviews
     * @param int $limit Number of reviews to return (max 5 from Google)
     * @return array Reviews data
     */
    public function getReviews($limit = 5) {
        $cache_file = $this->cache_dir . 'reviews_' . $this->place_id . '.json';
        
        // Check if cached data exists and is still valid
        if ($this->enable_cache && file_exists($cache_file) && (time() - filemtime($cache_file)) < $this->cache_duration) {
            $cached_data = json_decode(file_get_contents($cache_file), true);
            if ($cached_data && isset($cached_data['reviews'])) {
                // Apply sorting to cached reviews as well
                $sorted_reviews = $this->sortReviewsByLatest($cached_data['reviews']);
                return array_slice($sorted_reviews, 0, $limit);
            }
        }
        
        // Fetch fresh data from Google Places API
        $reviews_data = $this->fetchFromAPI();
        
        if ($reviews_data) {
            // Sort reviews by latest if enabled
            $sorted_reviews = $this->sortReviewsByLatest($reviews_data['reviews']);
            
            // Update the reviews data with sorted reviews
            $reviews_data['reviews'] = $sorted_reviews;
            
            // Cache the data
            file_put_contents($cache_file, json_encode($reviews_data));
            return array_slice($sorted_reviews, 0, $limit);
        }
        
        return [];
    }
    
    /**
     * Fetch data from Google Places API
     * @return array|false API response data or false on failure
     */
    private function fetchFromAPI() {
            // Build the URL
        $fields = urlencode('name,rating,reviews,user_ratings_total');  // can add more: formatted_address, opening_hours, etc.
        $url = "https://maps.googleapis.com/maps/api/place/details/json"
            . "?place_id=" . urlencode($this->place_id)
            . "&language=" . urlencode($_GET['lang'] ?? 'ar')
            . "&reviews_sort=newest"
            . "&key=" . urlencode($this->api_key);

        // Use cURL to fetch
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Optionally set timeouts, SSL options, etc.
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo("cURL error in getGoogleReviewsByPlaceId: " . curl_error($ch));
            curl_close($ch);
            return false;
        }
        curl_close($ch);

        // Decode JSON
        $data = json_decode($response, true);
        if (!isset($data['status'])) {
            // Unexpected response

            return false;
        }
        if ($data['status'] !== 'OK') {
            // Can log $data['error_message'] if needed
            error_log("Google Places API error: " . ($data['error_message'] ?? $data['status']));
            return false;
        }

        // Extract info
        $result = $data['result'];

        // Extract reviews; these are up to 5
        $reviews = $result['reviews'] ?? [];

        // Some business info optionally
        $business = [
            'name' => $result['name'] ?? '',
            'rating' => $result['rating'] ?? null,
            'total_ratings' => $result['user_ratings_total'] ?? 0
            // add more fields if you requested them
        ];

        return [
            'business' => $business,
            'reviews' => $reviews,
        ];
        
    }
    
    /**
     * Sort reviews by timestamp (latest first)
     * @param array $reviews Reviews array
     * @return array Sorted reviews
     */
    private function sortReviewsByLatest($reviews) {
        if (!$this->sort_by_latest) {
            return $reviews;
        }
        
        usort($reviews, function($a, $b) {
            $timeA = $a['time'] ?? 0;
            $timeB = $b['time'] ?? 0;
            return $timeB - $timeA; // Sort descending (latest first)
        });
        
        return $reviews;
    }
    
    /**
     * Format reviews data for display
     * @param array $reviews Raw reviews from API
     * @return array Formatted reviews
     */
    private function formatReviews($reviews) {
        $formatted = [];
        
        foreach ($reviews as $review) {
            $formatted[] = [
                'author_name' => $review['author_name'] ?? 'Anonymous',
                'author_url' => $review['author_url'] ?? '',
                'profile_photo_url' => $review['profile_photo_url'] ?? '',
                'rating' => $review['rating'] ?? 0,
                'text' => $review['text'] ?? '',
                'time' => $review['time'] ?? time(),
                'relative_time' => $review['relative_time_description'] ?? 'Recently',
                'language' => $review['language'] ?? 'en'
            ];
        }
        
        return $formatted;
    }
    
    /**
     * Get business information
     * @return array Business info
     */
    public function getBusinessInfo() {
        $cache_file = $this->cache_dir . 'business_' . $this->place_id . '.json';
        
        if ($this->enable_cache && file_exists($cache_file) && (time() - filemtime($cache_file)) < $this->cache_duration) {
            return json_decode(file_get_contents($cache_file), true);
        }
        
        $data = $this->fetchFromAPI();
        if ($data) {
            file_put_contents($cache_file, json_encode($data['business']));
            return $data['business'];
        }
        
        return null;
    }
    
    /**
     * Display reviews as HTML
     * @param int $limit Number of reviews to display
     * @return string HTML output
     */
    public function displayReviewsHTML($limit = 5) {
        $reviews = $this->getReviews($limit);
        $business_info = $this->getBusinessInfo();
        
        if (empty($reviews)) {
            return '<div class="no-reviews">No reviews available at this time.</div>';
        }
        
        $html = '';
       
        // Reviews
        foreach ($reviews as $review) {
            $html .= $this->renderReviewHTML($review);
        }
        
        
        return $html;
    }
    
    /**
     * Render individual review as HTML
     * @param array $review Review data
     * @return string HTML for single review
     */
    private function renderReviewHTML($review) {
        $avatar_url = 'https://lh3.googleusercontent.com/a/default-user=s40-c';



        $html = '<div class="review-card">';
        $html .= '    <div class="review-header">';
        $html .= '        <div class="reviewer-info">';
        $html .= '            <img src="' . htmlspecialchars($avatar_url) . '" alt="' . htmlspecialchars($review['author_name']) . '" class="reviewer-avatar">';
        $html .= '            <div class="reviewer-details">';
        $html .= '                <h4 class="reviewer-name">' . htmlspecialchars($review['author_name']) . '</h4>';
        $html .= '                <div class="review-date">' . htmlspecialchars($review['relative_time'] ?? '') . '</div>';
        $html .= '            </div>';
        $html .= '        </div>';
        $html .= '        <div class="google-icon">';
        $html .= '            <i class="fab fa-google"></i>';
        $html .= '        </div>';
        $html .= '    </div>';
        $html .= '    <div class="review-rating">' . $this->renderStars($review['rating']) . '</div>';
        $html .= '    <div class="review-text">';
        $html .= '        <p>' . htmlspecialchars(substr($review['text'], 0, 300)) . '</p>';
        $html .= '    </div>';
        $html .= '</div>';
        
        return $html;
    }
    
    /**
     * Render star rating
     * @param float $rating Rating value
     * @return string Star HTML
     */
    private function renderStars($rating) {
        $stars = '';
        $rating = round($rating);
        for ($i = 0; $i < 5; $i++) {
            if ($i < $rating) {
                $stars .= '<i class="fas fa-star"></i>';
            } else {
                $stars .= '<i class="far fa-star"></i>'; // Using far for empty star
            }
        }
        return $stars;
    }
    
    /**
     * Generate avatar placeholder URL
     * @param string $name Person's name
     * @return string Placeholder avatar URL
     */
    private function generateAvatarPlaceholder($name) {
        $initials = '';
        $name_parts = explode(' ', $name);
        foreach ($name_parts as $part) {
            if (!empty($part)) {
                $initials .= strtoupper($part[0]);
            }
        }
        return 'https://via.placeholder.com/50x50/4285f4/white?text=' . urlencode(substr($initials, 0, 2));
    }
    
    /**
     * Get reviews as JSON
     * @param int $limit Number of reviews
     * @return string JSON string
     */
    public function getReviewsJSON($limit = 5) {
        $reviews = $this->getReviews($limit);
        return json_encode($reviews, JSON_PRETTY_PRINT);
    }
    
    /**
     * Clear cache
     * @return bool Success status
     */
    public function clearCache() {
        $files = glob($this->cache_dir . '*.json');
        foreach ($files as $file) {
            unlink($file);
        }
        return true;
    }
}

// Usage Example and Configuration
try {
    // Configuration
    $config = [
        'api_key' => 'AIzaSyCIW3yu0NLwlAROWKLR-LEbMT9L2lfL__o', // Get from Google Cloud Console
        'place_id' => 'ChIJ2Yn3-SlBWBQR172kjd-DzdU', // Find using Google Place ID Finder
        'reviews_to_show' => 5,
        'enable_cache' => false, // Set to false to always get latest reviews
        'sort_by_latest' => true // Sort reviews by latest first
    ];
    
    // Initialize the reviews fetcher
    $reviews_fetcher = new GoogleReviewsFetcher($config['api_key'], $config['place_id'], $config['enable_cache'], $config['sort_by_latest']);
    
    // Method 1: Get reviews as array
    $reviews = $reviews_fetcher->getReviews($config['reviews_to_show']);
    
    // Method 2: Get business info
    $business_info = $reviews_fetcher->getBusinessInfo();
    
    // Method 4: Get as JSON for AJAX
    // header('Content-Type: application/json');
    // echo $reviews_fetcher->getReviewsJSON($config['reviews_to_show']);
    
} catch (Exception $e) {
    echo "Error loading reviews: " . $e->getMessage();
}

/* 
CSS Styles to include in your stylesheet:
*/
?>
<!DOCTYPE html>
<html lang="ar" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Reviews Widget</title>
    <link rel="stylesheet" href="google-reviews-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="reviews-widget-container">
        <!-- Header Section -->
        <div class="reviews-header">
            <div class="reviews-logo">
                <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png" alt="Google" class="google-logo">
            </div>
            <div class="reviews-summary">
                <div class="rating-overview flex">
                    <div class="rating-score"><?php echo number_format($business_info['rating'], 1) ?> </div>
                    <div>
                        <div class="rating-stars">
                            <?php
                            $rating = $business_info['rating'] ?? 0;
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= floor($rating)) {
                                    echo '<i class="fas fa-star"></i>';
                                } elseif ($i - 0.5 <= $rating) {
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                } else {
                                    echo '<i class="far fa-star"></i>';
                                }
                            }
                            ?>
                        </div>
                        <div class="total-reviews"><?php echo $business_info['total_ratings']; ?> مراجعة Google</div>
                    </div>
                </div>
                <a target="_blank" style="text-decoration: none;" href="https://admin.trustindex.io/api/googleWriteReview?place-id=ChIJ2Yn3-SlBWBQR172kjd-DzdU" class="write-review-btn">
                    <i class="fas fa-edit"></i>
                    كتابة مراجعة
                </a>
            </div>
        </div>

        <!-- Reviews Carousel -->
        <div class="reviews-carousel">
            <button class="carousel-btn prev-btn" id="prevBtn">
                <i class="fas fa-chevron-left"></i>
            </button>
            
            <div class="reviews-container" id="reviewsContainer">
                <?php 
                echo $reviews_fetcher->displayReviewsHTML($config['reviews_to_show']);
                ?>
            </div>
            
            <button class="carousel-btn next-btn" id="nextBtn">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <!-- Carousel Indicators -->
        <div class="carousel-indicators" id="indicators">
            <span class="indicator active" data-slide="0"></span>
            <span class="indicator" data-slide="1"></span>
            <span class="indicator" data-slide="2"></span>
            <span class="indicator" data-slide="3"></span>
            <span class="indicator" data-slide="4"></span>
        </div>
    </div>

    <script src="google-reviews-script.js"></script>
</body>
</html>
<?php
function get_movie_details($imdb_id)
{
    $api_key = '1090f864';  // جایگزین با کلید API خود
    $url = "http://www.omdbapi.com/?i={$imdb_id}&apikey={$api_key}";
    $ch = curl_init();
    
    curl_setopt_array($ch, [
        CURLOPT_URL            => $url,         // استفاده مستقیم از URL ورودی
        CURLOPT_RETURNTRANSFER  => true,         // دریافت پاسخ به عنوان رشته
        CURLOPT_SSL_VERIFYHOST  => 2,            // بررسی SSL بدون اعتبارسنجی کامل
        CURLOPT_SSL_VERIFYPEER  => false,        // غیرفعال کردن تأیید گواهی SSL
        CURLOPT_FOLLOWLOCATION  => true,         // دنبال کردن ریدایرکت‌ها
        CURLOPT_MAXREDIRS       => 3             // حداکثر ۳ ریدایرکت
    ]);
    
    $response = curl_exec($ch);
    $error = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);

    if ($error || $httpCode !== 200) {
        return null;
    }

    return json_decode($response) ?: null;
}


function getActorDataRapidAPI($imdb_id) {
    $api_key = "810f3bfc08msha626fe39e65d05dp1cb9f6jsn7975fd08f695";
    $url = "https://movie-database-imdb-alternative.p.rapidapi.com/?i=" . $imdb_id . "&r=json";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "X-RapidAPI-Key: " . $api_key
    ]);

    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response, true);

    if ($data) {
        return [
            'Name' => $data['Title'] ?? 'ناموجود',
            'Year' => $data['Year'] ?? 'ناموجود',
            'Genre' => $data['Genre'] ?? 'ناموجود',
            'Plot' => $data['Plot'] ?? 'ناموجود'
        ];
    } else {
        return null;
    }
}





// Add this code to your theme's functions.php file

// Function to count page views
function set_post_views($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Function to display the views
function get_post_views($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 Views";
    }
    return $count . ' Views';
}

// Add the set_post_views function to the wp_head hook
function track_post_views($post_id)
{
    if (!is_single())
        return;
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    set_post_views($post_id);
}
add_action('wp_head', 'track_post_views');



function  movie_data($data){
    $movie_details = get_movie_details(get_post_meta(get_the_ID(), '_my_input_value_key', true));
    if ($movie_details) {
        echo $movie_details->$data;
    }
};
function  get_the_movie_data($data){
    $movie_details = get_movie_details(get_post_meta(get_the_ID(), '_my_input_value_key', true));
    if ($movie_details) {
        return $movie_details->$data;
    }
};



function checkCategory()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";

    // دریافت هاست (دامنه)
    $host = $_SERVER['HTTP_HOST'];

    // دریافت مسیر (Path)
    $path = $_SERVER['REQUEST_URI'];

    // ساخت URL کامل
    $url = $protocol . "://" . $host . $path;


    // جدا کردن لینک با استفاده از '/'
    $parts = explode('/', $url);

    // بررسی وجود 'anime' در آرایه
    if (in_array('anime', $parts)) {
        return 'anime';
    }
    if (in_array('movies', $parts)) {
        return 'movies';
    }
    if (in_array('series', $parts)) {
        return 'series';
    }
}

function checkTag()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";

    // دریافت هاست (دامنه)
    $host = $_SERVER['HTTP_HOST'];

    // دریافت مسیر (Path)
    $path = $_SERVER['REQUEST_URI'];

    // ساخت URL کامل
    $url = $protocol . "://" . $host . $path;


    // جدا کردن لینک با استفاده از '/'
    $parts = explode('/', $url);

    // بررسی وجود 'anime' در آرایه
    if (in_array('action', $parts)) {
        return 'action';
    }
    if (in_array('animation', $parts)) {
        return 'animation';
    }
    if (in_array('biography', $parts)) {
        return 'biography';
    }
    if (in_array('historical', $parts)) {
        return 'historical';
    }
    if (in_array('horror', $parts)) {
        return 'horror';
    }
    if (in_array('crime', $parts)) {
        return 'crime';
    }
    if (in_array('family', $parts)) {
        return 'family';
    }
    if (in_array('drama', $parts)) {
        return 'drama';
    }
    if (in_array('mystery', $parts)) {
        return 'mystery';
    }
    if (in_array('science-fiction', $parts)) {
        return 'science-fiction';
    }
    if (in_array('romance', $parts)) {
        return 'romance';
    }
    if (in_array('fantasy', $parts)) {
        return 'fantasy';
    }
    if (in_array('comedy', $parts)) {
        return 'comedy';
    }
    if (in_array('adventure', $parts)) {
        return 'adventure';
    }

}
<?php

function getBaseUrl() {
    // Detect HTTPS (also works behind proxies like Cloudflare)
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
          || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');

    $scheme = $https ? 'https' : 'http';
    $host   = $_SERVER['HTTP_HOST'];

    //calculate new path to qsl_designs
    $basePath = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/\\');
    if ($basePath === '/' || $basePath === '') $basePath = '';

    return $scheme . '://' . $host . $basePath;
}

//get baseURL
$baseurl = getBaseUrl();
$prefix  = rtrim($baseurl, '/') . '/qsl_designs/';

//send header JSON
header('Content-Type: application/json');

// Allow access from any origin
header("Access-Control-Allow-Origin: *");

try {
    
    // connect to the database
    $db = new PDO('sqlite:../../database/mam.sqlite');

    // build base query and parameters
    $sql = 'SELECT sort, :prefix || filename AS filename
            FROM qsl_designs
            ORDER BY sort ASC';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':prefix', $prefix, PDO::PARAM_STR);
    $stmt->execute();

    // fetch results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // return JSON
    http_response_code(200);
    echo json_encode($results);

} catch (PDOException $e) {
    // return error JSON
    http_response_code(418);
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    exit;
}
?>

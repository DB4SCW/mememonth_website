<?php
//send header JSON
header('Content-Type: application/json');

// Allow access from any origin
header("Access-Control-Allow-Origin: *");

try {
    
    // try to read links for url data from file
    $urls_filename = "../database/urls.json";
    $urldata = [];
    
    //check if file exists, only then load urldata
    if(file_exists($urls_filename))
    {
      try {
        $jsonString = file_get_contents($urls_filename);
        // Decode JSON into an associative array
        $urldata = json_decode($jsonString, true);
      } catch (\Throwable $th) {
        $urldata = [];
      }
    }

    // return JSON
    http_response_code(200);
    echo json_encode($urldata);

} catch (PDOException $e) {
    // return error JSON
    http_response_code(418);
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    exit;
}
?>

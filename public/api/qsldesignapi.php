<?php
//send header JSON
header('Content-Type: application/json');

// Allow access from any origin
header("Access-Control-Allow-Origin: *");

try {
    
    // connect to the database
    $db = new PDO('sqlite:../../database/mam.sqlite');

    // build base query and parameters
    $sql = "SELECT sort, filename FROM qsl_designs ORDER BY sort ASC";

    // prepare, bind, and execute
    $stmt = $db->prepare($sql);
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

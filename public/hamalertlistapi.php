<?php
//send header Text
header('Content-Type: text/html; charset=utf-8');

// Allow access from any origin
header("Access-Control-Allow-Origin: *");

try {
    
    // connect to the database
    $db = new PDO('sqlite:../database/mam.sqlite');

    // get Post or Get parameters
    $year = $_POST['year'] ?? $_GET['year'] ?? null;

    // validate year
    if($year != null)
    {
        if (!ctype_digit($year)) {
            http_response_code(400);
            echo ("Invalid or missing 'year' parameter.");
            exit;
        }
    }

    if($year == null)
    {
        http_response_code(400);
        echo ("Invalid or missing 'year' parameter.");
        exit;
    }

    // build base query and parameters
    $sql = "SELECT callsign FROM callsigns WHERE hide = 0";

    // add year filter
    $sql .= " AND year = :year";
    $params[':year'] = (int)$year;

    // add sorting
    $sql .= " ORDER BY region ASC, sort ASC, id ASC";

    // prepare, bind, and execute
    $stmt = $db->prepare($sql);
    $stmt->execute($params);

    // fetch results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $callsigns = implode(',', array_column($results, 'callsign'));

    // return JSON
    http_response_code(200);
    echo($callsigns);

} catch (PDOException $e) {
    // return error JSON
    http_response_code(418);
    echo("Database error: " . $e->getMessage());
    exit;
}
?>

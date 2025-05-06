<?php
//send header JSON
header('Content-Type: application/json');

// Allow access from any origin
header("Access-Control-Allow-Origin: *");

try {
    
    // connect to the database
    $db = new PDO('sqlite:../database/mam.sqlite');

    // get Post or Get parameters
    $year = $_POST['year'] ?? $_GET['year'] ?? null;
    $region = $_POST['region'] ?? $_GET['region'] ?? null;

    // validate year
    if($year != null)
    {
        if (!ctype_digit($year)) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid or missing 'year' parameter."]);
            exit;
        }
    }

    //validate region
    if($region != null)
    {
        if (!ctype_digit($region)) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid 'region' parameter."]);
            exit;
        }

        if($region < 1 or $region > 3)
        {
            http_response_code(418);
            echo json_encode(["error" => "Invalid 'region' parameter."]);
            exit;
        }
    }

    // build base query and parameters
    $sql = "SELECT year, region, callsign, mainop, flag, sort FROM callsigns WHERE hide = 0";

    // add filters dynamically
    if ($year !== null) {
        $sql .= " AND year = :year";
        $params[':year'] = (int)$year;
    }

    if ($region !== null) {
        $sql .= " AND region = :region";
        $params[':region'] = (int)$region;
    }

    // add sorting
    $sql .= " ORDER BY year ASC, region ASC, sort ASC, id ASC";

    // prepare, bind, and execute
    $stmt = $db->prepare($sql);
    $stmt->execute($params);

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

<?php
// Set response headers for CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if (isset($_GET['lat']) && isset($_GET['lon'])) {
    $lat = $_GET['lat'];
    $lon = $_GET['lon'];

    // OpenStreetMap API URL
    $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat=$lat&lon=$lon&accept-language=id";

    // Make the API request
    $response = file_get_contents($url);

    if ($response === false) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch data from OpenStreetMap']);
        exit;
    }

    // Ensure the response is valid JSON
    $json = json_decode($response, true);
    if ($json === null) {
        http_response_code(500);
        echo json_encode(['error' => 'Invalid JSON from OpenStreetMap']);
        exit;
    }

    // Return the response
    echo $response;
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid parameters']);
}

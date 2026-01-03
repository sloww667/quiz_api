<?php
// CORS headers for Flutter Web
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");

// Handle OPTIONS preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Include DB connection
include "db.php";

// Fetch questions
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

if (!$result) {
    http_response_code(500);
    echo json_encode(["error" => "Database query failed"]);
    exit();
}

// Prepare JSON
$questions = [];
while ($row = $result->fetch_assoc()) {
    $options = [
        $row["option1"] => boolval($row["option1_is_correct"]),
        $row["option2"] => boolval($row["option2_is_correct"]),
        $row["option3"] => boolval($row["option3_is_correct"]),
        $row["option4"] => boolval($row["option4_is_correct"]),
    ];

    $questions[] = [
        "id" => (string)$row["id"],
        "title" => $row["title"],
        "options" => $options
    ];
}

// Return JSON
http_response_code(200);
echo json_encode($questions, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
exit();

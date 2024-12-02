<?php
header('Content-Type: text/plain');

echo "Reset script is running\n";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = file_put_contents('scores.json', json_encode([]));

    if ($result !== false) {
        echo "Leaderboard reset successfully";
    } else {
        http_response_code(500);
        echo "Failed to reset leaderboard";
    }
} else {
    http_response_code(405);
    echo "Invalid request";
}
?>

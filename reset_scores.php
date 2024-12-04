<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filePath = 'scores.json';
    
    // Check if the file exists before attempting to clear it
    if (file_exists($filePath)) {
        file_put_contents($filePath, json_encode([])); // Clear the file contents
        echo json_encode(['message' => 'Leaderboard reset successful']);
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Leaderboard file not found']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Invalid request method']);
}
?>

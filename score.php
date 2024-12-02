<?php
// Handle adding a new score to scores.json
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);

    if ($inputData) {
        $scores = json_decode(file_get_contents('scores.json'), true) ?? [];
        $scores[] = $inputData;

        // Sort the scores based on time in ascending order
        usort($scores, function($a, $b) {
            return $a['time'] <=> $b['time'];
        });

        // Save the updated scores to the file
        file_put_contents('scores.json', json_encode($scores, JSON_PRETTY_PRINT));
    }
}
?>

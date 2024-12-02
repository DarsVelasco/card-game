<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Matching Game</title>
    <link rel="stylesheet" href="game.css">
    <link href="https://fonts.googleapis.com/css2?family=Lacquer&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

</head>
<body>

<div class="main-container">
    <h1>Card Matching Game</h1>
    
    <p class="welcome-message">Welcome to the Card Matching Game! Enter your name to start playing.</p>
    
    <form action="game.php" method="POST" class="name-form">
        <input type="text" name="playerName" placeholder="Enter your name" required class="name-input">
        <button type="submit" class="start-btn">Start Game</button>
    </form>

    
    <div class="leaderboard-container">
        <h2>Leaderboard</h2>
        <ul class="leaderboard-list">
        </ul>
        <button id="resetLeaderboard" class="reset-btn">Reset Leaderboard</button>
    </div>
</div>

<script>
    fetch('scores.json')
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to load scores.json');
        }
        return response.json();
    })
    .then(scores => {
        const leaderboardList = document.querySelector('.leaderboard-list');
        leaderboardList.innerHTML = '';
        scores.sort((a, b) => a.time - b.time);
        scores.forEach(score => {
            const listItem = document.createElement('li');
            listItem.textContent = `${score.name} - ${score.time}s - ${score.timestamp}`;
            leaderboardList.appendChild(listItem);
        });
    })
    .catch(error => {
        console.error('Error loading leaderboard:', error);
    });
    document.getElementById('resetLeaderboard').addEventListener('click', () => {
        if (confirm('Are you sure you want to reset the leaderboard?')) {
            fetch('reset_scores.php', {
                method: 'POST'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to reset leaderboard. Status: ' + response.status);
                }
                return response.text();
            })
            .then(data => {
                console.log('Reset response:', data); // Log the response from the server
                alert('Leaderboard reset successfully!');
                window.location.reload(); // Refresh the page to show the updated leaderboard
            })
            .catch(error => {
                console.error('Error resetting leaderboard:', error); // Log any errors to the console
                alert('Failed to reset leaderboard. Please check the console for details.');
            });
        }
    });
</script>

</body>
</html>
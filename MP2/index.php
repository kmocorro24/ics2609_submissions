<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Card Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-top: 50px;
        }

        button {
            padding: 10px;
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <?php
    session_start();

    function generateCard($max)
    {
        return rand(1, $max);
    }

    function areCardsIdentical($card1, $card2)
    {
        return $card1 === $card2;
    }

    function playRound(&$points)
    {
        $round = isset($_SESSION['round']) ? $_SESSION['round'] : 1;

        if ($round > 10) {
            echo "<div>";
            echo "<p>Game Over! Your final points: $points</p>";
            session_unset();
            session_destroy();
            return; // End the game loop
        }

        $card1 = generateCard(13);
        $card2 = generateCard(13);

        echo "<p>Round $round: Cards Drawn - $card1, $card2</p>";

        if (areCardsIdentical($card1, $card2)) {
            echo "<p>JACKPOT! You got identical cards!</p>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='round' value='$round'>";
            echo "<input type='hidden' name='card1' value='$card1'>";
            echo "<input type='hidden' name='card2' value='$card2'>";
            echo "<p>Choose <button type='submit' name='higher'>HIGHER</button> or <button type='submit' name='lower'>LOWER</button></p>";
            echo "</form>";
        } else {
            echo "<form method='post'>";
            echo "<input type='hidden' name='round' value='$round'>";
            echo "<input type='hidden' name='card1' value='$card1'>";
            echo "<input type='hidden' name='card2' value='$card2'>";
            echo "<p>Choose <button type='submit' name='deal'>DEAL</button> or <button type='submit' name='no_deal'>NO DEAL</button></p>";
            echo "</form>";
        }
        echo "<hr>";
    }

    function playGame()
    {
        $points = isset($_SESSION['points']) ? $_SESSION['points'] : 0;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $round = isset($_POST['round']) ? $_POST['round'] : 1;

            // Display the round details only if the submitted round matches the current round
            if ($round == $_SESSION['round']) {
                $card1 = isset($_POST['card1']) ? $_POST['card1'] : null;
                $card2 = isset($_POST['card2']) ? $_POST['card2'] : null;
                $card3 = generateCard(20);

                echo "<p>Third Card: $card3</p>";

                if (areCardsIdentical($card1, $card2)) {
                    $userChoice = isset($_POST['higher']) ? 'HIGHER' : 'LOWER';

                    if (($userChoice === 'HIGHER' && $card3 > $card1) || ($userChoice === 'LOWER' && $card3 < $card1)) {
                        echo "<p>WIN! You got it right!</p>";
                        $points += 10;
                    } else {
                        echo "<p>LOSE! Better luck next time.</p>";
                    }
                } else {
                    $userChoice = isset($_POST['deal']) ? 'DEAL' : 'NO DEAL';

                    if ($userChoice === 'DEAL') {
                        if ($card3 > min($card1, $card2) && $card3 < max($card1, $card2)) {
                            echo "<p>WIN! You got it right!</p>";
                            $points += 10;
                        } else {
                            echo "<p>LOSE! Better luck next time.</p>";
                            // Deduct points only if the user clicked "DEAL" and didn't win
                            $points -= 5;
                            // Ensure points do not go below zero
                            $points = max(0, $points);
                        }
                    } else {
                        // Add points if the third card is not between the first and second card
                        if ($card3 <= min($card1, $card2) || $card3 >= max($card1, $card2)) {
                            echo "<p>NO DEAL! Points added.</p>";
                            $points += 10;
                        } else {
                            echo "<p>NO DEAL! Points not added.</p>";
                        }
                    }
                }

                // Display the current points without showing the previous round details
                echo "<p>Current Points: $points</p><hr>";

                $round++; // Move to the next round

                $_SESSION['round'] = $round;
                $_SESSION['points'] = $points;

                if ($round <= 10) {
                    playRound($points); // Display the next round
                    return; // Continue the game loop
                }
            }
        }

        // Display the current round
        playRound($points);
    }

    if (!isset($_SESSION['round'])) {
        $_SESSION['round'] = 1;
    }

    if (isset($_POST['play_again']) && $_POST['play_again'] === 'yes') {
        $_SESSION['round'] = 1;
        $_SESSION['points'] = 0;
    }

    playGame();
    ?>


















    </div>

</body>

</html>
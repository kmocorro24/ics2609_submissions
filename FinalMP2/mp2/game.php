<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In-Between Card Game</title>
    <link rel="stylesheet" href="stl.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Poppins&display=swap" rel="stylesheet">
    <audio autoplay loop>
        <source src="bgm2.mp3" type="audio/mp3">
    </audio>
    <a href="index.php">
        <div class="logo-container">
            <img src="logo.png" alt="Logo" class="logo">
        </div>
    </a>
</head>

<body>


    <div class="scroll">
        <div class="container">
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
                    echo "<form method='post'>";
                    echo "<p>Do you want to play again? ";
                    echo "<button type='submit' name='play_again' value='yes'>YES</button> ";
                    echo "<a href='index.php'><button type='button'>NO</button></a></p>";
                    echo "</form>";
                    echo "</div>";

                    session_unset();
                    session_destroy();
                    return; // End the game loop
                }

                $card1 = 1;
                $card2 = 1;

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
                if (!isset($_SESSION['round'])) {
                    $_SESSION['round'] = 1;
                }

                if (isset($_POST['play_again']) && $_POST['play_again'] === 'yes') {
                    session_unset();
                    session_destroy();
                    session_start();
                    $_SESSION['round'] = 1;
                    $_SESSION['points'] = 0;
                }

                $points = isset($_SESSION['points']) ? $_SESSION['points'] : 0;
                $round = $_SESSION['round'];

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Display the round details only if the submitted round matches the current round
                    if ($round == $_SESSION['round']) {
                        $card1 = isset($_POST['card1']) ? $_POST['card1'] : null;
                        $card2 = isset($_POST['card2']) ? $_POST['card2'] : null;
                        $card3 = 1;

                        echo "<p>Third Card: $card3</p>";

                        if (areCardsIdentical($card1, $card2)) {
                            $userChoice = isset($_POST['higher']) ? 'HIGHER' : 'LOWER';

                            if (($userChoice === 'HIGHER' && $card3 = $card1 && $card2) || ($userChoice === 'LOWER' && $card3 = $card1 && $card2)) {
                                echo "<p>JACKPOT! You got it right!</p>";
                                $points += 50;
                            } 
                            else {
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

                        if ($round > 10) {
                            playRound($points); // Display the final points without showing the first round
                            return; // End the game loop
                        }
                    }
                }

                // Display the current round
                playRound($points);
            }

            playGame();
            ?>











        </div>

    </div>

</body>

</html>
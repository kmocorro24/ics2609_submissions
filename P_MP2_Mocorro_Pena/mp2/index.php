<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In-Between Game</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Poppins&display=swap" rel="stylesheet">
    <style>
        body.homepage {
            font-family: 'MedievalSharp', sans-serif;
            background-image: url('bg1.gif');
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .logo-container.homepage {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo.homepage {
            max-width: 100%;
        }

        .container.homepage {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        h1.homepage {
            color: #333;
        }

        p.homepage {
            margin: 10px 0;
        }

        button {
            font-family: 'MedievalSharp';
            color: white;
            padding: 17px 40px;
            border-radius: 50px;
            cursor: pointer;
            border: 0;
            background-color: green;
            box-shadow: rgb(0 0 0 / 5%) 0 0 8px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-size: 15px;
            transition: all 0.5s ease;
        }

        button:hover {
            letter-spacing: 3px;
            background-color: gray;
            color: hsl(0, 0%, 100%);
        }

        button:active {
            letter-spacing: 3px;
            background-color: gray;
            color: hsl(0, 0%, 100%);
            transform: translateY(10px);
            transition: 100ms;
        }
    </style>
</head>

<body class="homepage">
    <audio autoplay loop>
        <source src="bgm.mp3" type="audio/mp3">
    </audio>
    <div class="logo-container">
        <img src="logo.png" alt="Logo" class="logo-homepage">
    </div>

    <div class="button homepage">

        <a href="game.php" class="play-button homepage"><button>Play Game</button></a>

    </div>

</body>

</html>
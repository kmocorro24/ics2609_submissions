<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxxy: A Tax Calculator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">

</head>

<body>
    <header class="intro">
        <h1>Taxxy: A Tax Calculator</h1>
    </header>

    <div class="container mt-5">

        <form action="calculate.php" method="post">
            <label for="salary">Enter your Salary:</label>
            <input type="text" id="salary" name="salary" required><br><br>
            <label for="type">Select Salary Type:</label>
            <select name="type" required>
                <option value="monthly">Monthly</option>
                <option value="bmonthly">Bi-Monthly</option>
            </select><br><br>
            <button>Calculate</button>

            <div class="result">
                <?php


                ?>
            </div>

            <footer class="footer">
            </footer>
</body>

</html>
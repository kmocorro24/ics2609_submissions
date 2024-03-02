<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxxy: A Tax Calculator - Result</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <header class="intro">
        <h1>Taxxy: A Tax Calculator Result</h1>
    </header>

    <div class="container results mt-5">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $salary = $_POST['salary'];
                $saltype = $_POST['type'];
                if (!is_numeric($salary)) {
                    echo '<div class="alert alert-danger" role="alert">Please enter a valid numeric amount.</div>';
                } else {

                    if ($saltype === 'bmonthly') {
                        $salary *= 2;
                    }

                    $ansalary = $salary * 12;
                    $antax = 0;
                    $monthlytax = 0;

                    if ($ansalary <= 250000) {
                    } elseif ($ansalary <= 400000) {
                        $monthlytax = ($ansalary - 250000) * 0.2 / 12;
                    } elseif ($ansalary <= 800000) {
                        $monthlytax = ($ansalary - 400000) * 0.25 / 12 + 22500 / 12;
                    } elseif ($ansalary <= 2000000) {
                        $monthlytax = ($ansalary - 800000) * 0.3 / 12 + 102500 / 12;
                    } elseif ($ansalary <= 8000000) {
                        $monthlytax = ($ansalary - 2000000) * 0.32 / 12 + 102500 / 12 + 300000 / 12;
                    }

                    $antax = $monthlytax * 12;

                    echo "<div class='card text-center'>";
                    echo "<div class='card-body'>";
                    echo "<h2 class='card-title'>Results</h2>";
                    echo "<p class='card-text'>Annual Salary: PHP" . number_format($ansalary, 2) . "</p>";
                    echo "<p class='card-text'>Annual Tax: PHP" . number_format($antax, 2) . "</p>";
                    echo "<p class='card-text'>Monthly Tax: PHP" . number_format($monthlytax, 2) . "</p>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        }
        ?>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
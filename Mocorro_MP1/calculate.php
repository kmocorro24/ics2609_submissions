<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxxy: A Tax Calculator - Result</title>
    <link rel="stylesheet" href="main.css">

</head>

<body>
    <header class="intro">
        <h1>Taxxy: A Tax Calculator Result</h1>
    </header>

    <div class=" results">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $salary = $_POST['salary'];
                $saltype = $_POST['type'];
        
                
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
        
                
                echo "<h2>Results</h2>";
                echo "<p>Annual Salary: PHP $ansalary</p>";
                echo "<p>Annual Tax: PHP $antax</p>";
                echo "<p>Monthly Tax: PHP $monthlytax</p>";
            }
                    
            }
    
        ?>
    </div>
</body>

</html>
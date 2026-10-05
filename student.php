<?php
require_once "./includes/nav.php";
require_once "./config/database.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $seach = $_POST['search_name'];
    $sql = "SELECT * FROM students WHERE name LIKE '%$seach%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    while ($student = mysqli_fetch_assoc($result)) {
        $score = $student['score'];
        $isPass = $score >= 50;
        $statusText = $isPass ? "Pass" : "Fail";
        $badgeClass = $isPass ? "alert-success" : "alert-danger";

        echo "<div class='card shadow p-4 text-center border-0 mb-4'>";
        echo "<h4 class='text-secondary'>Official Result Card</h4>";
        echo "<hr>";
        echo "<h2 class='text-dark mb-3'>" . htmlspecialchars($student['name']) . "</h2>";
        echo "<h3 class='mb-4'>Score: <strong>$score</strong> / 100</h3>";
        echo "<div class='alert $badgeClass fw-bold fs-4 mb-0'>Status: $statusText</div>";
        echo "</div>";
    }
} else {
    echo "<div class='alert alert-warning text-center fw-bold'>No student found.</div>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Portal - Check Result</title>
</head>
<body class="bg-light">

<div class="container mt-5 ">
    <div class="row justify-content-center  ">
        <div class="col-md-6 py-5">
            <div class="card shadow-lg p-5 rounded-4 mb-4 border-0">
                <h3 class="text-dark mb-3 text-center">Find Your Result</h3>

                <form method="POST" action="student.php">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Enter Your Name:</label>
                        <input type="text" name="search_name" class="form-control form-control-lg" placeholder="e.g. Ahmed" required>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 btn-lg">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
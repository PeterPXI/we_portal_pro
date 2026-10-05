<?php
require_once "./config/database.php";
require_once "./includes/nav.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $score = $_POST['score'];

    if (!empty($name) && is_numeric($score)) {
        $sql = "INSERT INTO students (name, score) VALUES ('$name', $score)";
        mysqli_query($conn, $sql);
    }
}

$res = mysqli_query($conn, "SELECT * FROM students");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>

<body class="bg-light">

<div class="container py-5">
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow-lg p-4 rounded-4 border-0">
                <h3 class="text-dark text-center mb-4">Add Student</h3>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Enter Name:</label>
                        <input type="text" name="name" class="form-control form-control-lg" placeholder="Ahmed" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Enter Score:</label>
                        <input type="number" name="score" class="form-control form-control-lg" placeholder="80" min="0" max="100" required>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 btn-lg">Add Student</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-lg p-4 rounded-4 border-0">
                <h3 class="text-primary mb-4">Student Records</h3>

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle text-center mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Score</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($res)) {
                                $isPass = $row['score'] >= 50;

                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td class='fw-bold'>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td>" . $row['score'] . "</td>";
                                echo "<td>";

                                if ($isPass) {
                                    echo "<span class='badge bg-success px-3 py-2'>Pass</span>";
                                } else {
                                    echo "<span class='badge bg-danger px-3 py-2'>Fail</span>";
                                }

                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

</body>
</html>
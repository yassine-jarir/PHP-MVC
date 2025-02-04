<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
</head>
<body>
    <h1>Welcome to the Student Dashboard</h1>
    <h2>Available Courses:</h2>
    <ul>
        <?php foreach ($courses as $course): ?>
            <li><?= $course['title'] ?> - <?= $course['description'] ?></li>
        <?php endforeach; ?>
    </ul>
    <!-- <a href="/logout">Logout</a> -->
</body>
</html>

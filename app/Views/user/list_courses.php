<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Courses</title>
</head>
<body>
    <h1>Available Courses</h1>
    <ul>
        <?php foreach ($courses as $course): ?>
            <li>
                <h2><?= $course['title'] ?></h2>
                <p><?= $course['description'] ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>

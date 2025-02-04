<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <form method="POST" action="/admin/add_course">
        <input type="text" name="title" placeholder="Course Title" required />
        <textarea name="description" placeholder="Course Description" required></textarea>
        <button type="submit">Add Course</button>
    </form>

    <h2>Existing Courses</h2>
    <ul>
        <?php foreach ($courses as $course): ?>
            <li><?= $course['title'] ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>

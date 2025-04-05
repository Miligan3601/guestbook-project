<?php
// Обробка форми
$name = '';
$showForm = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = trim($_POST['name']);
        $showForm = false;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Завдання 3.11.3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <?php if ($showForm): ?>
        <h2>Введіть ваше ім'я</h2>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Ім'я</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Відправити</button>
        </form>
    <?php else: ?>
        <div class="alert alert-success">
            <h2>Привіт, <?php echo htmlspecialchars($name); ?>!</h2>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
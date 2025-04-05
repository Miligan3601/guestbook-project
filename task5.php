<?php
// Обробка форми
$year = date('Y'); // Текущий год по умолчанию
$result = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['year']) && !empty($_POST['year'])) {
        $year = (int)$_POST['year'];

        // Проверка на високосный год
        if (($year % 400 === 0) || ($year % 4 === 0 && $year % 100 !== 0)) {
            $result = "$year - високосний рік";
        } else {
            $result = "$year - не високосний рік";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Завдання 3.11.5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Перевірка року на високосність</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="year" class="form-label">Рік</label>
            <input type="number" class="form-control" id="year" name="year" value="<?php echo $year; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Перевірити</button>
    </form>

    <?php if (!empty($result)): ?>
        <div class="alert alert-info mt-3">
            <?php echo $result; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
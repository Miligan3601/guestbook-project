<?php
// Обробка форми
$sum = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['num3'])) {
        $num1 = is_numeric($_POST['num1']) ? (float)$_POST['num1'] : 0;
        $num2 = is_numeric($_POST['num2']) ? (float)$_POST['num2'] : 0;
        $num3 = is_numeric($_POST['num3']) ? (float)$_POST['num3'] : 0;
        $sum = $num1 + $num2 + $num3;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Завдання 3.11.2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Обчислення суми трьох чисел</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="num1" class="form-label">Перше число</label>
            <input type="number" step="any" class="form-control" id="num1" name="num1" required>
        </div>
        <div class="mb-3">
            <label for="num2" class="form-label">Друге число</label>
            <input type="number" step="any" class="form-control" id="num2" name="num2" required>
        </div>
        <div class="mb-3">
            <label for="num3" class="form-label">Третє число</label>
            <input type="number" step="any" class="form-control" id="num3" name="num3" required>
        </div>
        <button type="submit" class="btn btn-primary">Обчислити</button>
    </form>

    <?php if ($sum !== null): ?>
        <div class="alert alert-success mt-3">
            Сума чисел: <?php echo $sum; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
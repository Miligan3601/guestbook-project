<?php
// Обробка форми
$fullName = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['lastName']) && isset($_POST['firstName']) && isset($_POST['patronymic'])) {
        $lastName = trim($_POST['lastName']);
        $firstName = trim($_POST['firstName']);
        $patronymic = trim($_POST['patronymic']);
        $fullName = "$lastName $firstName $patronymic";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Завдання 3.11.1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Введіть ваші ПІБ</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="lastName" class="form-label">Прізвище</label>
            <input type="text" class="form-control" id="lastName" name="lastName" required>
        </div>
        <div class="mb-3">
            <label for="firstName" class="form-label">Ім'я</label>
            <input type="text" class="form-control" id="firstName" name="firstName" required>
        </div>
        <div class="mb-3">
            <label for="patronymic" class="form-label">По батькові</label>
            <input type="text" class="form-control" id="patronymic" name="patronymic" required>
        </div>
        <button type="submit" class="btn btn-primary">Відправити</button>
    </form>

    <?php if (!empty($fullName)): ?>
        <div class="alert alert-success mt-3">
            Ви ввели: <?php echo htmlspecialchars($fullName); ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
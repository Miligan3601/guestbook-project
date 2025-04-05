<?php
// Обробка форми
$text = '';
$wordCount = 0;
$charCount = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['text'])) {
        $text = $_POST['text'];

        // Подсчет слов и символов
        $wordCount = str_word_count($text);
        $charCount = mb_strlen($text);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Завдання 3.11.11</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Підрахунок слів та символів</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="text" class="form-label">Введіть текст</label>
            <textarea class="form-control" id="text" name="text" rows="5" required><?php echo htmlspecialchars($text); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Підрахувати</button>
    </form>

    <?php if (!empty($text)): ?>
        <div class="alert alert-info mt-3">
            <p>Кількість слів: <?php echo $wordCount; ?></p>
            <p>Кількість символів: <?php echo $charCount; ?></p>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
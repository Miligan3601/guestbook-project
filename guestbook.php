<?php
// TODO 1: PREPARING ENVIRONMENT: 1) session 2) functions
session_start();

// Функція для відображення коментарів
function renderComments() {
    $comments = [];
    $filename = 'comments.csv';

    if (file_exists($filename)) {
        $fileStream = fopen($filename, "r");

        while (!feof($fileStream)) {
            $jsonString = fgets($fileStream);
            $comment = json_decode($jsonString, true);

            if (empty($comment)) break;

            $comments[] = $comment;
        }

        fclose($fileStream);
    }

    // Сортування коментарів у зворотному порядку (нові зверху)
    $comments = array_reverse($comments);

    if (empty($comments)) {
        echo '<div class="alert alert-info">Коментарів поки немає. Будьте першим!</div>';
    } else {
        foreach ($comments as $comment) {
            echo '<div class="card mb-3">';
            echo '<div class="card-header">';
            echo '<strong>' . htmlspecialchars($comment['name']) . '</strong>';
            echo ' <small class="text-muted">(' . htmlspecialchars($comment['email']) . ')</small>';
            echo '</div>';
            echo '<div class="card-body">';
            echo '<p class="card-text">' . nl2br(htmlspecialchars($comment['text'])) . '</p>';
            echo '</div>';
            echo '<div class="card-footer text-muted">';
            echo 'Дата: ' . $comment['date'];
            echo '</div>';
            echo '</div>';
        }
    }
}

// TODO 2: ROUTING

// TODO 3: CODE by REQUEST METHODS (ACTIONS) GET, POST, etc. (handle data from request): 1) validate 2) working with data source 3) transforming data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Перевірка наявності даних
    if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['text'])) {
        $email = trim($_POST['email']);
        $name = trim($_POST['name']);
        $text = trim($_POST['text']);

        // Валідація
        $errors = [];

        if (empty($email)) {
            $errors[] = "Поле Email обов'язкове для заповнення";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Невірний формат Email";
        }

        if (empty($name)) {
            $errors[] = "Поле Ім'я обов'язкове для заповнення";
        }

        if (empty($text)) {
            $errors[] = "Поле Текст обов'язкове для заповнення";
        }

        // Якщо немає помилок, зберігаємо коментар
        if (empty($errors)) {
            $comment = [
                'email' => $email,
                'name' => $name,
                'text' => $text,
                'date' => date('Y-m-d H:i:s')
            ];

            $jsonString = json_encode($comment);
            $fileStream = fopen('comments.csv', 'a');
            fwrite($fileStream, $jsonString . "\n");
            fclose($fileStream);

            // Перенаправлення для уникнення повторної відправки форми при оновленні сторінки
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}

// TODO 4: RENDER: 1) view (html) 2) data (from php)
?>

<!DOCTYPE html>
<html>

<?php require_once 'sectionHead.php' ?>

<body>

<div class="container">

    <!-- navbar menu -->
    <?php require_once 'sectionNavbar.php' ?>
    <br>

    <!-- guestbook section -->
    <div class="card card-primary">
        <div class="card-header bg-primary text-light">
            Гостьова книга
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-sm-6">

                    <!-- TODO: create guestBook html form   -->
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Ім'я</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">Текст коментаря</label>
                            <textarea class="form-control" id="text" name="text" rows="4" required><?php echo isset($_POST['text']) ? htmlspecialchars($_POST['text']) : ''; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Відправити</button>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <br>

    <div class="card card-primary">
        <div class="card-header bg-body-secondary text-dark">
            Коментарі
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">

                    <!-- TODO: render guestBook comments   -->
                    <?php renderComments(); ?>

                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
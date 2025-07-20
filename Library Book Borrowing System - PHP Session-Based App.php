<?php
// Start session and manage session ID
session_start();

// Set a session cookie with a 1-hour expiration time
if (!isset($_COOKIE['session_id'])) {
    $session_id = session_id();
    setcookie("session_id", $session_id, time() + 3600, "/");
}

// Initialize borrowing list if not set
if (!isset($_SESSION['borrowing_list'])) {
    $_SESSION['borrowing_list'] = [];
}

// Handle adding a book
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_book'])) {
    $book_id = filter_input(INPUT_POST, 'book_id', FILTER_SANITIZE_STRING);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
    $duration = filter_input(INPUT_POST, 'duration', FILTER_VALIDATE_INT);

    if ($book_id && $title && $author && $duration) {
        $_SESSION['borrowing_list'][$book_id] = [
            'title' => $title,
            'author' => $author,
            'duration' => $duration
        ];
    }
}

// Handle removing a book
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_book'])) {
    $book_id = filter_input(INPUT_POST, 'book_id', FILTER_SANITIZE_STRING);

    if ($book_id && isset($_SESSION['borrowing_list'][$book_id])) {
        unset($_SESSION['borrowing_list'][$book_id]);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Book Borrowing System</title>
</head>
<body>
    <h1>Library Book Borrowing System</h1>

    <!-- Form to add a book -->
    <h2>Add a Book</h2>
    <form method="POST">
        <label for="book_id">Book ID:</label>
        <input type="text" name="book_id" id="book_id" required><br>

        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br>

        <label for="author">Author:</label>
        <input type="text" name="author" id="author" required><br>

        <label for="duration">Borrowing Duration (days):</label>
        <input type="number" name="duration" id="duration" required><br>

        <button type="submit" name="add_book">Add Book</button>
    </form>

    <!-- Display borrowing list -->
    <h2>Your Borrowing List</h2>
    <?php if (!empty($_SESSION['borrowing_list'])): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Borrowing Duration</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['borrowing_list'] as $book_id => $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><?php echo htmlspecialchars($book['duration']); ?> days</td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book_id); ?>">
                                <button type="submit" name="remove_book">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>Total Books: <?php echo count($_SESSION['borrowing_list']); ?></p>
    <?php else: ?>
        <p>Your borrowing list is empty.</p>
    <?php endif; ?>
</body>
</html>

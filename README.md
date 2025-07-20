#  Library Book Borrowing System - PHP Session-Based App

This is a beginner-friendly PHP web application that allows users to manage a book borrowing list using **PHP sessions** and **cookies** — all handled client-side without a database. Users can add books, define borrowing durations, and remove them dynamically. The list persists for one hour using session cookies.

---

##  Features

-  Add books to a borrowing list
-  Remove books from the list
-  Session cookie lasts for 1 hour
-  Displays current borrowing list in a table
-  Secure input handling using `filter_input()` and `htmlspecialchars()`

---

##  Technologies Used

- PHP (pure, no framework)
- HTML5
- Sessions & cookies
- No database needed

---

## How to Run

### Option 1: Using Localhost (XAMPP, WAMP, etc.)
1. Place the project folder inside the `htdocs` directory (for XAMPP)
2. Start **Apache server**
3. Visit: `http://localhost/your-project-folder/`

### Option 2: Using PHP Built-in Server
```bash
cd your-project-folder
php -S localhost:8000

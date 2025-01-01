<?php
require '../db.php'; // Adjust path based on file structure

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['note'])) {
    $uploadDir = '../uploads/';
    $fileName = basename($_FILES['note']['name']);
    $filePath = $uploadDir . $fileName;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($_FILES['note']['tmp_name'], $filePath)) {
        $stmt = $pdo->prepare("INSERT INTO notes (filename, filepath) VALUES (:filename, :filepath)");
        $stmt->execute(['filename' => $fileName, 'filepath' => $filePath]);
        $message = "<p class='success'>Note uploaded successfully!</p>";
    } else {
        $message = "<p class='error'>Error uploading file.</p>";
    }
}

// Handle note deletion
if (isset($_GET['delete_id'])) {
    $noteId = $_GET['delete_id'];
    // Fetch the file path from the database
    $stmt = $pdo->prepare("SELECT filepath FROM notes WHERE id = :id");
    $stmt->execute(['id' => $noteId]);
    $note = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($note) {
        // Make sure the path is correct
        $filePath = realpath($note['filepath']); // Use realpath() to ensure an absolute path

        if ($filePath && unlink($filePath)) { // Check if the file exists and delete it
            // Delete the note record from the database
            $stmt = $pdo->prepare("DELETE FROM notes WHERE id = :id");
            $stmt->execute(['id' => $noteId]);
            $message = "<p class='success'>Note deleted successfully!</p>";
        } else {
            $message = "<p class='error'>Error deleting the file. File might not exist.</p>";
        }
    } else {
        $message = "<p class='error'>Note not found.</p>";
    }
}

$stmt = $pdo->query("SELECT * FROM notes ORDER BY uploaded_at DESC");
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Notes</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        header {
            background-color: #000;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        main {
            padding: 20px;
            max-width: 900px;
            margin: 0 auto;
            background: white;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        section {
            margin-bottom: 30px;
        }

        h2 {
            color: #000;
            margin-bottom: 10px;
            border-bottom: 2px solid #000;
            display: inline-block;
            padding-bottom: 5px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input[type="file"] {
            padding: 5px;
        }

        button {
            background-color: #000;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #333;
        }

        .notes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .note-card {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .note-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }

        .note-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #000;
        }

        .note-download {
            text-decoration: none;
            color: white;
            background-color: #000;
            padding: 10px 15px;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .note-download:hover {
            background-color: #333;
        }

        .note-delete {
            color: white;
            background-color: red;
            padding: 5px 10px;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .note-delete:hover {
            background-color: #cc0000;
        }

        .success {
            color: green;
            margin-top: 10px;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Upload and View Notes</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="AboutUs.php">About Us</a>
            <a href="./serv/service.php">Services</a>
            <a href="reviews.php">Reviews</a>
        </nav>
    </header>
    <main>
        <section>
            <h2>Upload a Note</h2>
            <?php if (!empty($message)) echo $message; ?>
            <form action="ournotes.php" method="POST" enctype="multipart/form-data">
                <label for="note">Select a file:</label>
                <input type="file" name="note" id="note" required>
                <button type="submit">Upload</button>
            </form>
        </section>
        <section>
            <h2>Available Notes</h2>
            <div class="notes-grid">
                <?php if ($notes): ?>
                    <?php foreach ($notes as $note): ?>
                        <div class="note-card">
                            <div class="note-title"><?php echo htmlspecialchars($note['filename']); ?></div>
                            <a href="<?php echo htmlspecialchars($note['filepath']); ?>" class="note-download" download>Download</a>
                            <a href="ournotes.php?delete_id=<?php echo $note['id']; ?>" class="note-delete" onclick="return confirm('Are you sure you want to delete this note?')">Delete</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No notes available.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>

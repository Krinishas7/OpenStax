<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reviews</title>
    <link rel="stylesheet" href="css/review.css" />
    <style>
      .delete-btn {
        margin-top: 10px;
        padding: 5px 10px;
        background-color: red;
        color: white;
        border: none;
        cursor: pointer;
      }

      .delete-btn:hover {
        background-color: darkred;
      }
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
        <nav>
            <a href="home.php">Home</a>
            <a href="AboutUs.php">About Us</a>
            <a href="serve/service.php">Services</a>
            <a href="reviews.php">Reviews</a>
        </nav>
    </header>

    
      <h1>What Our Users Say</h1>
      <p>
        Read honest reviews from students and learners who use OpenStax for
        notes and tutorials.
      </p>
      
    <section class="reviews">
      <div class="review-card">
        <h3>Want to Say Something?</h3>
        <form action="reviews.php" method="POST">
          <input
            type="text"
            placeholder="Full Name"
            name="name"
            class="input-field"
          />
          <textarea
            class="input-field"
            name="comment"
            placeholder="Comment"
          ></textarea>
          <button type="submit" class="comment-button">
            Comment
          </button>
        </form>
      </div>

      <div class="name-container">
        <?php
        session_start();
        if (!isset($_SESSION['reviews'])) {
            $_SESSION['reviews'] = [];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = htmlspecialchars($_POST['name']);
            $comment = htmlspecialchars($_POST['comment']);

            if ($name && $comment) {
                $_SESSION['reviews'][] = [
                    'name' => $name,
                    'comment' => $comment
                ];
            }
        }

        if (isset($_GET['delete'])) {
            $index = intval($_GET['delete']);
            unset($_SESSION['reviews'][$index]);
            $_SESSION['reviews'] = array_values($_SESSION['reviews']);
        }

        foreach ($_SESSION['reviews'] as $index => $review) {
            echo "<div class='review-card'>";
            echo "<h3 class='name-header'>{$review['name']}</h3>";
            echo "<p class='name-comment'>{$review['comment']}</p>";
            echo "<a href='?delete={$index}' class='delete-btn'>Delete</a>";
            echo "</div>";
        }
        ?>
      </div>
    </section>
    <footer>
      <p>OpenStax - Empowering Learners Everywhere</p>
    </footer>
  </body>
</html>

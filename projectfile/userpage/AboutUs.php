<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OpenStax</title>
    <link rel="stylesheet" href="css/about.css" />
  </head>
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
    
  <body>
  <header>
        <nav>
            <a href="home.php">Home</a>
            <a href="AboutUs.php">About Us</a>
            <a href="serve/service.php">Services</a>
            <a href="reviews.php">Reviews</a>
        </nav>
    </header>
    
    <div id="about">
      <div class="about-container">
        <div class="about-container1">
          <div class="container1-text">
            <h1>About Us</h1>
            <h2>Your Learning Journey Begins Here</h2>
            <p>
              OpenStax provides an extensive collection of notes,tutorials and
              resources to help students,learners and educators to excel in BCA courses.
            </p>
             
      <div class="container2">
        <div class="container2-img"></div>
        <div class="container2-txt">
          <h1>Why Choose Us?</h1>
          <h2>Everything You Need to Succeed!</h2>
          <p>
            At OpenStax, we ensure that learners are equipped with the best
            resources which includes collection of notes and diversed tutorials related to BCA courses, having supportive community.
          </p>
          <div class="highlights">
            <div class="highlight Border">
              <img src="/assets/images/online.png" alt="Online Access Icon" />
              <h3>24/7 Online Access</h3>
            </div>
            <div class="highlight Border">
              <img src="/assets/images/resources.png" alt="Resource Icon" />
              <h3>Rich Resources</h3>
            </div>
            <div class="highlight Border">
              <img src="/assets/images/projects.png" alt="Projects Icon" />
              <h3>Project-Based Learning</h3>
            </div>
          </div>
        </div>
      </div>

       
    </div>
  </body>
</html>

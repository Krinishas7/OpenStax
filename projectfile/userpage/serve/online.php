<?php
// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['videoFile'])) {
    $file = $_FILES['videoFile'];
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($file['name']);

    // Check if file is a video
    if (strpos($file['type'], 'video') !== false) {
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            echo "File is uploaded successfully!";
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "Please upload a valid video file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Tutorials</title>
    <style>
      /* General Styles */
      body {
        background-color: #121212;
        color: #e0e0e0;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
      }
      header {
        background-color: #2c2c2c;
        padding: 20px;
        text-align: center;
      }
      h1 {
        color: #fff;
        font-size: 2rem;
      }

      /* Section Styles */
      .tutorials-section {
        padding: 20px;
      }
      h2 {
        color: #ff9800;
        margin-bottom: 20px;
      }

      /* Video Grid Styles */
      .video-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
      }
      .video-item {
        background-color: #333;
        border: 1px solid #444;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
      }
      .video-item h3 {
        color: #fff;
        margin-bottom: 10px;
        font-size: 1.2rem;
      }
      video, iframe {
        width: 100%;
        border-radius: 5px;
        background-color: #222;
      }

      /* Button Styles */
      .delete-btn, .update-btn, .upload-btn, .download-btn {
        margin-top: 10px;
        padding: 10px 15px;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }
      .delete-btn {
        background-color: #f44336;
      }
      .delete-btn:hover {
        background-color: #d32f2f;
      }
      .update-btn {
        background-color: #2196f3;
      }
      .update-btn:hover {
        background-color: #1976d2;
      }
      .upload-btn {
        background-color: #ff9800;
      }
      .upload-btn:hover {
        background-color: #fb8c00;
      }
      .download-btn {
        background-color: #4caf50;
      }
      .download-btn:hover {
        background-color: #388e3c;
      }

      /* File Input Styles */
      #fileInput {
        display: none;
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Online Tutorials</h1>
    </header>
    <main>
      <section class="tutorials-section">
        <h2>Watch Tutorials</h2>
        <div class="video-grid">
          <!-- Sample Video Item 1 -->
          <div class="video-item">
            <h3>HTML Basics</h3>
            <video controls>
              <source src="HTML.mp4" type="video/mp4" />
              Your browser does not support the video tag.
            </video>
            <button class="delete-btn">Delete</button>
            <button class="update-btn">Update</button>
            <button class="download-btn">Download</button>
          </div>
          <!-- Sample Video Item 2 -->
          <div class="video-item">
            <h3>HTML Basics</h3>
            <iframe
              src="https://www.youtube.com/embed/D-h8L5hgW-w"
              allowfullscreen
            ></iframe>
            <button class="delete-btn">Delete</button>
            <button class="update-btn">Update</button>
            <button class="download-btn">Download</button>
          </div>
          <!-- Sample Video Item 3 -->
          <div class="video-item">
            <h3>JavaScript Basics</h3>
            <iframe
              src="https://www.youtube.com/embed/W6NZfCO5SIk"
              allowfullscreen
            ></iframe>
            <button class="delete-btn">Delete</button>
            <button class="update-btn">Update</button>
            <button class="download-btn">Download</button>
          </div>
          <!-- Sample Video Item 4 -->
          <div class="video-item">
            <h3>Node.js Guide</h3>
            <video controls>
              <source src="NODEJS.mp4" type="video/mp4" />
              Your browser does not support the video tag.
            </video>
            <button class="delete-btn">Delete</button>
            <button class="update-btn">Update</button>
            <button class="download-btn">Download</button>
          </div>
        </div>
        
        <!-- Upload Form -->
        <h3>Upload a New Video</h3>
        <form action="" method="post" enctype="multipart/form-data">
          <input type="file" name="videoFile" id="fileInput" accept="video/*" required />
          <button type="submit" class="upload-btn">Upload Video</button>
        </form>
      </section>
    </main>

    <script>
      // Event listener for delete buttons
      document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
          const videoItem = this.closest('.video-item');
          if (videoItem) {
            videoItem.remove();
          }
        });
      });

      // Event listener for update buttons
      document.querySelectorAll('.update-btn').forEach(button => {
        button.addEventListener('click', function () {
          const videoItem = this.closest('.video-item');
          const newTitle = prompt("Enter new title:", videoItem.querySelector('h3').textContent);
          if (newTitle) {
            videoItem.querySelector('h3').textContent = newTitle;
          }
        });
      });

      // Event listener for download buttons
      document.querySelectorAll('.download-btn').forEach(button => {
        button.addEventListener('click', function () {
          const videoItem = this.closest('.video-item');
          const video = videoItem.querySelector('video source');
          if (video) {
            const link = document.createElement('a');
            link.href = video.src;
            link.download = video.src.split('/').pop();
            link.click();
          }
        });
      });
    </script>
  </body>
</html>
 

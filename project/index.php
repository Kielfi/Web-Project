<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Better Wikipedia</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('d733345e4f11231904e7634a04439e21.gif');
            background-size: cover;
            background-repeat: no-repeat;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #3498db;
            overflow: hidden;
        }

        .navbar ul {
            list-style-type: none;
        }

        .navbar ul li {
            float: left;
        }

        .navbar a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #2980b9;
        }

        .main-content {
            width: 80%;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 1);
            padding: 200px;
            border-radius: 10px;
        }

        .main-content h1 {
            font-size: 2.5em;
            text-align: center;
            margin-top: 0;
        }

        .main-content h2 {
            font-size: 2em;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-top: 40px;
        }

        .main-content p {
            font-size: 1em;
            margin: 20px 0;
        }

        .main-content img {
            max-width: 100%;
            margin: 20px 0;
        }

        .site-footer {
            background-color: #333;
            color: #fff;
            padding: 15px 0;
            text-align: center;
        }

        .site-footer p {
            margin: 0;
            font-size: 0.9em;
        }

        .faq-section {
            margin-top: 40px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }

        .faq-section h2 {
            font-size: 2.2em;
            text-align: center;
            margin-bottom: 30px;
        }

        .faq-item h3 {
            font-size: 1.6em;
            margin-top: 20px;
            color: #3498db;
        }

        .faq-item p {
            font-size: 1em;
            margin: 10px 0 20px;
        }
		/* Slideshow container */
.slideshow-container {
    max-width: 100%;
    height: 800px; /* Adjust the height as needed */
    position: relative;
    margin-top: 20px; /* Adjust as needed to position the slideshow */
}

/* Style for the images within the slideshow */
.mySlides img {
    width: 60%;
    height: 60%;
}
.main-content h1 {
        font-size: 2.5em;
        text-align: center;
        margin-top: 0;
    }

    .main-content h2 {
        font-size: 2em;
        border-bottom: 2px solid #3498db;
        padding-bottom: 10px;
        margin-top: 40px;
    }

    .main-content p {
        font-size: 1em; /* Your original font size */
        margin: 20px 0;
    }

    .main-content p.about-us {
        font-size: 1.2em; /* Adjust the font size as needed */
    }

    .main-content p.features {
        font-size: 1.2em; /* Adjust the font size as needed */
    }
    .slideshow-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    z-index: 2; /* Place it above the image */
}

.slideshow-text h2 {
    font-size: 2em;
    color: white; /* You can adjust the color as needed */
}
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="index.html" class="logo-container">
            <img src="990d3c6370b8a8c39bde7a501334599d.jpg" alt="Better Wikipedia Logo" width="80" height="53" class="logo">
        </a>
       <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
			<li><a href="contact.php">Contact Us</a></li>
			<li><a href="profile.php">Profile</a></li>
			<li><a href="submit.php">Submit ur own</a></li>
		   <?php
           if (isset($_SESSION['username']) && $_SESSION['role'] === 'Admin'){
            echo '<li><a href="admin_panel.php">Admin Panel</a></li>';
        }
        ?>
        </ul>
    </nav>
	<div class="mySlides fade">
    <img src="d733345e4f11231904e7634a04439e21.gif" style="width:100%">
    <div class="slideshow-text">
        <h2>WELCOME TO BETTER WIKIPEDIA</h2>
    </div>
</div>
    <!-- Add more slides as needed -->

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
		<a class="next" onclick="plusSlides(1)">&#10095; </a>
</div>
<script>
    var slideIndex = 0;

    showSlides();

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");

        if (slideIndex >= slides.length) {
            slideIndex = 0;
        }

        if (slideIndex < 0) {
            slideIndex = slides.length - 1;
        }

        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        slides[slideIndex].style.display = "block";
    }

    setInterval(function () {
        plusSlides(1);
    }, 3000); // Change image every 3 seconds (adjust the time as needed)
</script>
    <!-- Main Content -->
    <div class="main-content">
        <h1>Welcome to Better Wikipedia</h1>
        <form action="search.php" method="get" class="search-form">
            <input type="text" name="query" placeholder="Search for information">
            <button type="submit">Search</button>
        </form>
        <section>
            <h2>About Us</h2>
            <p>Better Wikipedia is a dynamic platform dedicated to providing you with accurate, reliable, and user-friendly information. Our mission is to empower individuals with the knowledge they seek while fostering a sense of community and collaboration. We take pride in our commitment to excellence and our passion for sharing information. With a diverse team of experts and enthusiasts, we offer a unique blend of resources, ensuring that you have access to a wealth of knowledge in a format that's easy to navigate. Welcome to Better Wikipedia, where learning and discovery are just a click away.</p>
            <img src="tumblr_mrclm8Pz4k1r3o85co1_400.gif" alt="A description of the image">
        </section>

        <section>
            <h2>Features</h2>
            <p>At Better Wikipedia, we've designed a platform with a wide array of features tailored to enhance your experience. Our intuitive search functionality allows you to quickly access the information you're looking for. Dive into a treasure trove of articles and resources covering a vast range of topics. Enjoy a rich multimedia experience with embedded images and videos. Save your favorite articles, create a personalized profile, and engage with a community of knowledge seekers. Our commitment to accuracy and reliability ensures that you can trust the information you find. Explore the future of online learning with Better Wikipedia and unlock a world of knowledge at your fingertips.Learn about the unique features that set Better Wikipedia apart from other platforms...</p>
        </section>

       <div class="faq-section">
    <h2>Frequently Asked Questions</h2>

    <div class="faq-item">
        <h3>Question 1: What is Better Wikipedia?</h3>
        <p>This is the answer to the first question. It provides detailed information about what Better Wikipedia is.</p>
    </div>

    <div class="faq-item">
        <h3>Question 2: How is it different from other platforms?</h3>
        <p>This answer explains the unique features and benefits of Better Wikipedia compared to other platforms.</p>
    </div>

    <div class="faq-item">
        <h3>Question 3: Is Better Wikipedia free to use?</h3>
        <p>Yes, Better Wikipedia is completely free to use. We believe in open access to knowledge for everyone.</p>
    </div>

    <div class="faq-item">
        <h3>Question 4: Can I contribute to Better Wikipedia?</h3>
        <p>Absolutely! We encourage users to contribute by adding and editing articles. Join our community of contributors and help us improve the platform.</p>
    </div>

    <div class="faq-item">
        <h3>Question 5: How do I create a user profile?</h3>
        <p>Creating a user profile is easy. Just click on the 'Register' link in the navigation menu and follow the instructions to set up your profile.</p>
    </div>

    <!-- Add more questions and answers as needed -->
</div>
</div>
    <footer class="site-footer">
        <p>&copy; 2023 Better Wikipedia. All rights reserved.</p>
    </footer>
</body>
</html>
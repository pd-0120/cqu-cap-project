<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cognitive Health - Streamline Your Care Management</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<header class="header">
    <div class="container">
        <nav class="navbar">
            <a href="#" class="nav-logo">Cognitive Health</a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="#features" class="nav-link">Features</a></li>
                <li class="nav-item"><a href="#how-it-works" class="nav-link">How It Works</a></li>
                <li class="nav-item"><a href="#about" class="nav-link">About</a></li>
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
            </ul>
            <a href="#contact" class="btn btn-primary nav-cta">Request Demo</a>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </div>
</header>

<main>
    <section class="hero">
        <div class="container hero-content">
            <div class="hero-text">
                <h1>Intelligent Care Management, Simplified</h1>
                <p>Cognitive Health provides a seamless SaaS platform to manage patient health information, automate workflows, and improve care outcomes.</p>
                <a href="#contact" class="btn btn-primary btn-lg">Get Started Today</a>
                <a href="#features" class="btn btn-secondary btn-lg">Learn More</a>
            </div>
            <div class="hero-image">
                <img src="{{ asset('assets/images/hero-image.jpeg') }}" alt="Cognitive Health Platform Dashboard">
            </div>
        </div>
    </section>

    <section id="features" class="features">
        <div class="container">
            <h2 class="section-title">Core Features</h2>
            <p class="section-subtitle">Everything you need for efficient care coordination.</p>
            <div class="features-grid">
                <div class="feature-item">
                    <img src="{{ asset('assets/images/feature1.jpeg') }}" alt="Patient Records Icon" class="feature-icon">
                    <h3>Patient Health Records</h3>
                    <p>Securely add, view, edit, and manage comprehensive patient health information.</p>
                </div>
                <div class="feature-item">
                    <img src="{{ asset('assets/images/feature2.jpg') }}" alt="Reminders Icon" class="feature-icon">
                    <h3>Daily Reminders</h3>
                    <p>Automated daily reminders for medications, appointments, and tasks for all patients.</p>
                </div>
                <div class="feature-item">
                    <img src="{{ asset('assets/images/feature3.png') }}" alt="Locations Icon" class="feature-icon">
                    <h3>Location Management</h3>
                    <p>Track patient locations and manage care houses or assigned areas.</p>
                </div>
                <div class="feature-item">
                    <img src="{{ asset('assets/images/feature4.jpg') }}" alt="Testing Icon" class="feature-icon">
                    <h3>Testing & Results</h3>
                    <p>Record tests taken, choose test types, and manage results efficiently.</p>
                </div>
                <div class="feature-item">
                    <img src="{{ asset('assets/images/feature5.png') }}" alt="Reporting Icon" class="feature-icon">
                    <h3>Insightful Reporting</h3>
                    <p>Generate comprehensive reports on patient progress, facility operations, and more.</p>
                </div>
                <div class="feature-item">
                    <img src="{{ asset('assets/images/feature6.png') }}" alt="User Management Icon" class="feature-icon">
                    <h3>User Roles & Permissions</h3>
                    <p>Assign roles (e.g., caretakers) and manage access levels securely.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="how-it-works" class="how-it-works">
        <div class="container">
            <h2 class="section-title">Streamline Your Workflow</h2>
            <div class="how-it-works-content">
                <div class="how-it-works-image">
                    <img src="{{ asset('assets/images/workflow.jpg') }}" alt="Workflow Illustration">
                </div>
                <div class="how-it-works-steps">
                    <div class="step">
                        <span>1</span>
                        <p><strong>Setup Your Facility:</strong> Easily add locations, staff, and patient profiles.</p>
                    </div>
                    <div class="step">
                        <span>2</span>
                        <p><strong>Manage Daily Care:</strong> Utilize reminders, track medications, and record observations.</p>
                    </div>
                    <div class="step">
                        <span>3</span>
                        <p><strong>Monitor & Report:</strong> Access real-time data and generate reports for better decision-making.</p>
                    </div>
                    <div class="step">
                        <span>4</span>
                        <p><strong>Improve Outcomes:</strong> Enhance efficiency, ensure compliance, and focus on quality patient care.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about">
        <div class="container">
            <h2 class="section-title">About Us</h2>
            <p>Cognitive Health is a forward-thinking platform dedicated to improving the quality of life for patients through intelligent care tools. Our mission is to provide healthcare providers with intuitive, secure, and effective digital solutions.</p>
        </div>
    </section>

    <section id="cta-banner" class="cta-banner">
        <div class="container">
            <h2>Ready to Elevate Your Care Management?</h2>
            <p>Discover how Cognitive Health can transform your operations.</p>
            <a href="#contact" class="btn btn-light btn-lg">Request a Personalized Demo</a>
        </div>
    </section>

    <section id="contact" class="contact-form-section">
        <div class="container">
            <h2 class="section-title">Get in Touch</h2>
            <p class="section-subtitle">Fill out the form below to request a demo or ask a question.</p>
            <form class="contact-form">
                <div class="form-group">
                    <input type="text" id="name" name="name" placeholder="Your Name" required>
                    <input type="email" id="email" name="email" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <input type="text" id="company" name="company" placeholder="Company Name">
                    <input type="tel" id="phone" name="phone" placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <textarea id="message" name="message" rows="4" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
            </form>
        </div>
    </section>
</main>

<footer class="footer">
    <div class="container footer-content">
        <div class="footer-left">
            <a href="#about">About</a>
        </div>
        <div class="footer-right">
            © <span id="current-year"></span> <strong>Cognitive Health</strong>
        </div>
    </div>
</footer>

<script src="{{ asset('assets/js/script.js') }}"></script>
<script>
    document.getElementById('current-year').textContent = new Date().getFullYear();
</script>

</body>
</html>


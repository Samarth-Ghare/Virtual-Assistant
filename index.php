<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('Location: login.php');
    exit();
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Samarth Suresh Ghare | Portfolio</title>
  <style>
    :root {
      --bg: #0a0a0a;
      --fg: #eee;
      --accent:rgb(0, 208, 255);
      --card: #1a1a1a;
      --shadow: rgba(0,255,255,0.1);
      --transition: 0.3s ease;
    }
    * { margin:0; padding:0; box-sizing:border-box; }
    body {
      font-family:"Segoe UI", sans-serif;
      background:var(--bg);
      color:var(--fg);
      scroll-behavior:smooth;
    }
    header { position:sticky; top:0; background:var(--bg); z-index:100; }
    nav {
      max-width:1000px; margin:auto;
      padding:1em; display:flex;
      justify-content:space-between;
      align-items:center;
    }
    .logo img { height:50px; border-radius:8px; }
    .nav-links { list-style:none; display:flex; gap:1.5em; }
    .nav-links a {
      color: var(--fg);
      text-decoration:none;
      transition: color var(--transition);
    }
    .nav-links a:hover, .logout-btn:hover { color: var(--accent); }
    .logout-btn {
      background: var(--accent);
      padding: .4em .8em;
      border-radius: 5px;
      text-decoration: none;
      color: var(--bg);
      font-weight: bold;
      transition: background var(--transition);
    }
    .logout-btn:hover { background: #00cccc; }
    .hero {
      height:80vh; display:flex;
      align-items:center; justify-content:center;
      background: linear-gradient(135deg, #0d0d0d, #1a1a1a);
      text-align:center; padding:0 2em;
    }
    .hero h1 { font-size:3em; }
    .highlight { color: var(--accent); }
    .btn {
      display:inline-block;
      margin-top:1em;
      padding:0.6em 1.8em;
      background: var(--accent);
      color: var(--bg);
      border-radius:10px;
      transition: background var(--transition), transform var(--transition);
    }
    .btn:hover { background:#00cccc; transform: translateY(-3px); }
    section {
      padding:4em 2em; max-width:1000px; margin:auto;
    }
    h2 { font-size:2em; margin-bottom:1em; color:var(--accent); }
    .about, .projects { display:grid; gap:2em; }
    .about { grid-template-columns:1fr 2fr; align-items:center; }
    .profile-pic {
      background:#333;
      border-radius:10px; box-shadow:0 0 10px var(--shadow);
      min-height:200px;
    }
    h3
    {
      color:var(--accent);
    }
    .profile-pic img {
      display: block;
      max-width: 130%;
      width: 100%;
      height: auto;
    }
    .projects { grid-template-columns: repeat(auto-fit,minmax(280px,1fr)); }
    .project-card {
      background: var(--card);
      padding:1.5em;
      border-radius:10px;
      box-shadow: 0 4px 15px var(--shadow);
      transition: transform var(--transition), box-shadow var(--transition);
    }
    .project-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px var(--shadow);
    }
    .skills {
      display:flex; flex-wrap:wrap; gap:0.75em;
      justify-content:center;
    }
    .skills span {
      background: var(--card);
      padding:0.5em 1em;
      border-radius:20px;
    }
    form {
      display:flex; flex-direction:column;
      gap:1em; max-width:500px; margin:auto;
    }
    form input, form textarea {
      background: var(--card);
      color:var(--fg);
      border:none; padding:0.8em; border-radius:5px;
    }
    form button {
      background: var(--accent);
      color:var(--bg);
      padding:0.8em; border:none;
      border-radius:5px;
      cursor:pointer;
      transition: background var(--transition);
    }
    form button:hover { background:#00cccc; }
    footer {
      text-align:center; padding:1em;
      background: #0f0f0f; color:#aaa;
    }
    @media (max-width:800px) {
      .about { grid-template-columns:1fr; }
    }
  </style>
</head>
<body>

<header>
  <nav>
    <div class="logo">
      <img src="Samarth Ghare.jpg" alt="Logo" />
    </div>
    <ul class="nav-links">
      <li><a href="#home">Home</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#skills">Skills</a></li>
      <li><a href="#projects">Projects</a></li>
      <li><a href="#contact">Contact</a></li>
      <li>
        <?php if (isset($_SESSION['username'])): ?>
        <a href="index.php?logout=1" class="logout-btn">Logout</a>
        <?php endif; ?>
      </li>
    </ul>
  </nav>
</header>

<section id="home" class="hero">
  <div>
    <h1>Hi, I'm <span class="highlight">Samarth Suresh Ghare</span></h1>
    <p><?php echo htmlspecialchars($_SESSION['username']); ?>, welcome!</p>
    <p>gharesamarth2@gmail.com</p>
    <p>Developer | Tech Enthusiast | Learner</p>
    <a href="#contact" class="btn">Contact Me</a>
  </div>
</section>

<section id="about">
  <h2>About Me</h2>
  <div class="about">
    <div class="profile-pic"><img src="samarth.jpg.png" alt="Samarth"></div>
    <div>
      <p>I’m Samarth Suresh Ghare, a passionate and driven B.Tech student specializing in Computer Science and Engineering with a focus on Artificial Intelligence.With strong foundations in C programming, Data Structures, and Algorithms, I continuously strive to deepen my knowledge and apply it to real-world problems.
      I have hands-on experience in object-oriented programming with Java, and have worked with Python and Machine Learning libraries like Pandas, which enables me to build intelligent solutions.I'm well-versed with operating systems like Windows and Ubuntu, and also proficient in HTML, CSS, and C++ for DSA.
      Motivated by a deep interest in AI and software development, I aim to push the boundaries of innovation and contribute meaningfully to this dynamic field.I enjoy coding with my own strategies, and my hobbies include playing Volleyball, Cricket, Chess, and listening to music.I believe in continuous learning, adapting to new challenges, and building technology that makes a difference.</p>
    </div>
  </div>
</section>

<section id="skills">
  <h2>Skills</h2>
  <div class="skills">
    <span>HTML</span><span>CSS</span><span>JavaScript</span><span>Python</span>
    <span>SQL</span><span>PHP</span><span>Java</span><span>AI/ML</span>
  </div>
</section>

<section id="projects">
  <h2>Projects</h2>
  <div class="projects">
    <div class="project-card">
      <h3>Virtual Assistant</h3>
      <p>I developed a responsive and interactive Virtual Assistant web application designed to enhance user experience by offering voice-based assistance directly in the browser.</p>
      <p>🗣️ Speech Recognition & Synthesis using the Web Speech API</p>
      <p>🎨 Responsive UI built with clean HTML and modern CSS</p>
      <p>⚡ Dynamic Interactions via JavaScript</p>
      <p>🌐 Voice command to open sites (Google, YouTube, etc.)</p>
      <p>🕓 Real-time date/time responses</p>
      <p>📱 Fully responsive for desktop/mobile</p>
    </div>
    <div class="project-card">
      <h3>AI Object Detection</h3>
      <p><strong>Technologies:</strong> HTML, CSS, JavaScript, TensorFlow.js</p>
      <p>I built an AI web app that uses the device camera to detect people/objects in real-time and interacts based on those objects.</p>
      <p>🤖 Real-time Object Detection using COCO-SSD (TensorFlow.js)</p>
      <p>📷 Live Camera Feed via browser</p>
      <p>🧠 Interactive AI responses</p>
      <p>💡 Youth-Centric UI</p>
      <p>⚙️ Entirely browser-based</p>
    </div>
  </div>
</section>

<section id="contact">
  <h2>Contact Me</h2>
  <form>
    <input type="text" placeholder="Your Name" required>
    <input type="email" placeholder="Your Email" required>
    <textarea placeholder="Your Message" rows="5" required></textarea>
    <button type="submit">Send</button>
  </form>
</section>

<footer>&copy; 2025 Samarth’s World. All rights reserved.</footer>

</body>
</html>

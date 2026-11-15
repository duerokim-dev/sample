 <?php
/**
 * index.php
 * Student Portfolio / Personal Profile Page
 * Single-file: PHP (data + logic), HTML5 (structure), CSS3 (styling)
 */

/* ==========================================================
   1. PROFILE DATA (edit these variables to personalize the page)
   ========================================================== */
$fullName   = "Juan Dela Cruz";
$title      = "BS Information Technology Student";
$course     = "Bachelor of Science in Information Technology";
$photo      = "https://api.dicebear.com/7.x/initials/svg?seed=Juan%20Dela%20Cruz&backgroundColor=4f46e5&textColor=ffffff"; // replace with "images/me.jpg"
$bio        = "I am a passionate and driven IT student who loves turning ideas into working software. "
            . "I enjoy learning new technologies, solving problems, and collaborating with others to build "
            . "useful, user-friendly web applications. I am currently looking for internship opportunities "
            . "where I can grow my skills and contribute to real projects.";

// Educational background: each entry is an associative array
$education = [
    [
        "school"  => "University of Bohol",
        "degree"  => "BS Information Technology",
        "years"   => "2023 - Present",
        "details" => "Dean's Lister; focus on web development and databases."
    ],
    [
        "school"  => "Tagbilaran City Science High School",
        "degree"  => "Senior High School - STEM Strand",
        "years"   => "2021 - 2023",
        "details" => "Graduated with honors."
    ],
    [
        "school"  => "Tagbilaran Central Elementary School",
        "degree"  => "Junior High School",
        "years"   => "2017 - 2021",
        "details" => "Active member of the school computer club."
    ],
];

// Skills: name => proficiency percentage
$skills = [
    "HTML5 & CSS3" => 90,
    "PHP"          => 80,
    "JavaScript"   => 70,
    "MySQL"        => 75,
    "Git & GitHub" => 65,
    "UI/UX Basics" => 60,
];

// Hobbies and interests (label + emoji icon)
$hobbies = [
    ["icon" => "💻", "label" => "Coding"],
    ["icon" => "🎮", "label" => "Gaming"],
    ["icon" => "📚", "label" => "Reading"],
    ["icon" => "🎵", "label" => "Music"],
    ["icon" => "📸", "label" => "Photography"],
    ["icon" => "🏊", "label" => "Swimming"],
];

// Contact information
$email    = "juan.delacruz@example.com";
$phone    = "+63 912 345 6789";
$location = "Tagbilaran City, Bohol, Philippines";
$github   = "https://github.com/juandelacruz";
$linkedin = "https://linkedin.com/in/juandelacruz";

// Footer year is generated dynamically
$year = date("Y");

/**
 * Helper: safely escape output to prevent XSS.
 */
function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Personal profile of <?= e($fullName) ?>">
    <title><?= e($fullName) ?> | Student Portfolio</title>

    <style>
        /* ======================================================
           CSS VARIABLES (color scheme & shared values)
           ====================================================== */
        :root {
            --primary:    #4f46e5;   /* indigo */
            --primary-dk: #3730a3;
            --accent:     #06b6d4;   /* cyan */
            --bg:         #f1f5f9;
            --card:       #ffffff;
            --text:       #1e293b;
            --muted:      #64748b;
            --radius:     16px;
            --shadow:     0 4px 14px rgba(15, 23, 42, 0.08);
            --shadow-hv:  0 14px 30px rgba(79, 70, 229, 0.22);
        }

        /* ======================================================
           RESET & BASE TYPOGRAPHY
           ====================================================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.65;
        }

        h1, h2, h3 { line-height: 1.25; }

        a { color: var(--primary); text-decoration: none; }

        /* ======================================================
           HEADER / NAVIGATION
           ====================================================== */
        .site-header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        }

        .nav {
            max-width: 1100px;
            margin: 0 auto;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .logo {
            font-weight: 800;
            font-size: 1.2rem;
            color: var(--primary);
        }

        .nav ul {
            list-style: none;
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
        }

        .nav ul a {
            color: var(--text);
            font-weight: 500;
            font-size: 0.95rem;
            padding-bottom: 3px;
            border-bottom: 2px solid transparent;
            transition: color .25s, border-color .25s;
        }

        .nav ul a:hover {
            color: var(--primary);
            border-color: var(--primary);
        }

        /* ======================================================
           HERO SECTION (photo, name, title)
           ====================================================== */
        .hero {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff;
            text-align: center;
            padding: 70px 20px 110px;
        }

        .hero .photo {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            border: 5px solid #fff;
            object-fit: cover;
            background: #fff;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            transition: transform .35s;
        }

        .hero .photo:hover { transform: scale(1.06) rotate(3deg); }

        .hero h1 {
            margin-top: 20px;
            font-size: 2.4rem;
            letter-spacing: .5px;
        }

        .hero p {
            margin-top: 6px;
            font-size: 1.1rem;
            opacity: .92;
        }

        /* ======================================================
           MAIN LAYOUT & CARDS
           ====================================================== */
        main {
            max-width: 1100px;
            margin: -70px auto 40px;   /* overlap the hero for a layered look */
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .card {
            background: var(--card);
            border-radius: var(--radius);
            padding: 28px;
            box-shadow: var(--shadow);
            transition: transform .3s, box-shadow .3s;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hv);
        }

        .card.full { grid-column: 1 / -1; }   /* span both columns */

        .card h2 {
            font-size: 1.35rem;
            color: var(--primary-dk);
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 3px solid var(--accent);
            display: inline-block;
        }

        /* ======================================================
           EDUCATION TIMELINE
           ====================================================== */
        .timeline { border-left: 3px solid var(--accent); padding-left: 20px; }

        .timeline-item { position: relative; margin-bottom: 20px; }
        .timeline-item:last-child { margin-bottom: 0; }

        .timeline-item::before {
            content: "";
            position: absolute;
            left: -29px;
            top: 6px;
            width: 14px;
            height: 14px;
            background: var(--primary);
            border: 3px solid #fff;
            border-radius: 50%;
            box-shadow: 0 0 0 2px var(--accent);
        }

        .timeline-item h3 { font-size: 1.05rem; }
        .timeline-item .degree { color: var(--primary); font-weight: 600; }
        .timeline-item .years,
        .timeline-item .details { color: var(--muted); font-size: .92rem; }

        /* ======================================================
           SKILLS (progress bars)
           ====================================================== */
        .skill { margin-bottom: 16px; }

        .skill-label {
            display: flex;
            justify-content: space-between;
            font-weight: 600;
            font-size: .95rem;
            margin-bottom: 6px;
        }

        .bar {
            background: #e2e8f0;
            border-radius: 20px;
            height: 10px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            border-radius: 20px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            transition: filter .3s;
        }

        .skill:hover .bar-fill { filter: brightness(1.15); }

        /* ======================================================
           HOBBIES (tag chips)
           ====================================================== */
        .hobbies {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .hobby {
            background: #eef2ff;
            color: var(--primary-dk);
            padding: 10px 18px;
            border-radius: 30px;
            font-weight: 600;
            transition: background .25s, color .25s, transform .25s;
        }

        .hobby:hover {
            background: var(--primary);
            color: #fff;
            transform: translateY(-3px);
        }

        /* ======================================================
           CONTACT LIST
           ====================================================== */
        .contact-list { list-style: none; }

        .contact-list li {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px dashed #e2e8f0;
            word-break: break-word;
        }

        .contact-list li:last-child { border-bottom: none; }

        .contact-list .icon { font-size: 1.2rem; }

        .contact-list a:hover { text-decoration: underline; }

        .btn {
            display: inline-block;
            margin-top: 18px;
            padding: 11px 26px;
            background: var(--primary);
            color: #fff;
            border-radius: 30px;
            font-weight: 600;
            transition: background .25s, transform .25s;
        }

        .btn:hover {
            background: var(--primary-dk);
            transform: translateY(-2px);
        }

        /* ======================================================
           FOOTER
           ====================================================== */
        .site-footer {
            background: #0f172a;
            color: #cbd5e1;
            text-align: center;
            padding: 28px 20px;
            font-size: .92rem;
        }

        .site-footer a { color: var(--accent); }
        .site-footer a:hover { text-decoration: underline; }

        /* ======================================================
           RESPONSIVE DESIGN
           ====================================================== */
        @media (max-width: 800px) {
            main { grid-template-columns: 1fr; }   /* stack cards */
            .hero h1 { font-size: 1.8rem; }
            .nav { justify-content: center; text-align: center; }
        }

        @media (max-width: 480px) {
            .hero { padding: 50px 16px 100px; }
            .hero .photo { width: 130px; height: 130px; }
            .card { padding: 22px; }
        }
    </style>
</head>
<body>

    <!-- ===================== HEADER ===================== -->
    <header class="site-header">
        <nav class="nav">
            <div class="logo"><?= e(explode(" ", $fullName)[0]) ?>.portfolio</div>
            <ul>
                <li><a href="#about">About</a></li>
                <li><a href="#education">Education</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#hobbies">Hobbies</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- ===================== HERO: PHOTO + NAME ===================== -->
    <section class="hero">
        <img class="photo" src="<?= e($photo) ?>" alt="Profile photo of <?= e($fullName) ?>">
        <h1><?= e($fullName) ?></h1>
        <p><?= e($title) ?></p>
    </section>

    <!-- ===================== MAIN CONTENT (CARDS) ===================== -->
    <main>

        <!-- About Me -->
        <section class="card full" id="about">
            <h2>About Me</h2>
            <p><?= e($bio) ?></p>
            <p style="margin-top:12px;"><strong>Course:</strong> <?= e($course) ?></p>
        </section>

        <!-- Educational Background -->
        <section class="card" id="education">
            <h2>Educational Background</h2>
            <div class="timeline">
                <?php foreach ($education as $edu): ?>
                    <div class="timeline-item">
                        <h3><?= e($edu["school"]) ?></h3>
                        <div class="degree"><?= e($edu["degree"]) ?></div>
                        <div class="years"><?= e($edu["years"]) ?></div>
                        <div class="details"><?= e($edu["details"]) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Skills -->
        <section class="card" id="skills">
            <h2>Skills</h2>
            <?php foreach ($skills as $skill => $level): ?>
                <div class="skill">
                    <div class="skill-label">
                        <span><?= e($skill) ?></span>
                        <span><?= (int)$level ?>%</span>
                    </div>
                    <div class="bar">
                        <div class="bar-fill" style="width: <?= (int)$level ?>%;"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>

        <!-- Hobbies and Interests -->
        <section class="card" id="hobbies">
            <h2>Hobbies &amp; Interests</h2>
            <div class="hobbies">
                <?php foreach ($hobbies as $hobby): ?>
                    <span class="hobby"><?= e($hobby["icon"]) ?> <?= e($hobby["label"]) ?></span>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Contact Information -->
        <section class="card" id="contact">
            <h2>Contact Information</h2>
            <ul class="contact-list">
                <li><span class="icon">📧</span> <a href="mailto:<?= e($email) ?>"><?= e($email) ?></a></li>
                <li><span class="icon">📞</span> <a href="tel:<?= e(str_replace(' ', '', $phone)) ?>"><?= e($phone) ?></a></li>
                <li><span class="icon">📍</span> <span><?= e($location) ?></span></li>
                <li><span class="icon">🐙</span> <a href="<?= e($github) ?>" target="_blank" rel="noopener">GitHub</a></li>
                <li><span class="icon">💼</span> <a href="<?= e($linkedin) ?>" target="_blank" rel="noopener">LinkedIn</a></li>
            </ul>
            <a class="btn" href="mailto:<?= e($email) ?>">Get in Touch</a>
        </section>

    </main>

    <!-- ===================== FOOTER ===================== -->
    <footer class="site-footer">
        <p>&copy; <?= $year ?> <?= e($fullName) ?>. All rights reserved.</p>
        <p>Built with PHP, HTML5 &amp; CSS3 &middot; <a href="#about">Back to top ↑</a></p>
    </footer>

</body>
</html>
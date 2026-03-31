<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($data['name']) ?> — Resume</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
 
        :root {
            --ink: #12100e;
            --paper: #faf8f4;
            --cream: #f0ece3;
            --accent: #c8562a;
            --muted: #8a8075;
            --border: #ddd8ce;
            --sidebar-bg: #1b2218;
        }
 
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--paper);
            color: var(--ink);
            min-height: 100vh;
            padding: 48px 20px;
            position: relative;
        }
 
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(var(--border) 1px, transparent 1px),
                linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0.35;
            pointer-events: none;
            z-index: 0;
        }
 
        .page {
            position: relative;
            z-index: 1;
            max-width: 860px;
            margin: 0 auto;
        }
 
        /* ── Top bar ── */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
 
        .eyebrow {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--accent);
            display: flex;
            align-items: center;
            gap: 8px;
        }
 
        .eyebrow::before {
            content: '';
            display: inline-block;
            width: 24px;
            height: 1.5px;
            background: var(--accent);
        }
 
        .back-link {
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--muted);
            text-decoration: none;
            border: 1px solid var(--border);
            padding: 8px 16px;
            border-radius: 2px;
            transition: border-color 0.15s, color 0.15s;
        }
 
        .back-link:hover { border-color: var(--accent); color: var(--accent); }
 
        /* ── Resume card ── */
        .resume {
            display: flex;
            background: white;
            border: 1px solid var(--border);
            border-radius: 3px;
            box-shadow: 6px 6px 0 var(--cream), 6px 6px 0 1px var(--border);
            overflow: hidden;
            min-height: 960px;
        }
 
        /* ── Left sidebar ── */
        .resume-left {
            width: 260px;
            flex-shrink: 0;
            background: var(--sidebar-bg);
            padding: 40px 28px;
            display: flex;
            flex-direction: column;
        }
 
        .profile-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.15);
            display: block;
            margin: 0 auto 20px;
            object-fit: cover;
            background: #2e3a2a;
        }
 
        .profile-initials {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.15);
            background: #2e3a2a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'DM Serif Display', serif;
            font-size: 28px;
            color: #e8e4dc;
            margin: 0 auto 20px;
        }
 
        .left-name {
            font-family: 'DM Serif Display', serif;
            font-size: 18px;
            font-weight: 400;
            text-align: center;
            color: #f0ece3;
            line-height: 1.2;
            margin-bottom: 4px;
        }
 
        .left-role {
            font-size: 9px;
            font-weight: 500;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--accent);
            text-align: center;
            margin-bottom: 28px;
        }
 
        .left-section {
            font-size: 8px;
            font-weight: 500;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #8a8075;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            padding-bottom: 6px;
            margin: 20px 0 10px;
        }
 
        .left-item {
            font-size: 11px;
            color: #b8b2a8;
            margin-bottom: 5px;
            line-height: 1.5;
        }
 
        .left-item strong {
            color: #e8e4dc;
            font-weight: 500;
            display: block;
        }
 
        /* ── Right content ── */
        .resume-right {
            flex: 1;
            min-width: 0;
            padding: 44px 48px;
        }
 
        .right-name {
            font-family: 'DM Serif Display', serif;
            font-size: 36px;
            font-weight: 400;
            color: var(--ink);
            line-height: 1.05;
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }
 
        .right-name span { color: var(--accent); }
 
        .right-sub {
            font-size: 13px;
            color: var(--muted);
            font-weight: 300;
            margin-bottom: 32px;
            letter-spacing: 0.02em;
        }
 
        .right-section {
            font-size: 9px;
            font-weight: 500;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--muted);
            border-bottom: 1px solid var(--border);
            padding-bottom: 6px;
            margin: 28px 0 16px;
        }
 
        .right-section:first-of-type { margin-top: 0; }
 
        /* Experience */
        .exp-block {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--cream);
        }
 
        .exp-block:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
 
        .exp-header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin-bottom: 2px;
            gap: 12px;
        }
 
        .exp-title   { font-size: 14px; font-weight: 500; color: var(--ink); }
        .exp-date    { font-size: 11px; color: var(--muted); white-space: nowrap; }
        .exp-company { font-size: 12px; color: var(--accent); margin-bottom: 6px; }
        .exp-desc    { font-size: 12px; color: #5a5650; line-height: 1.7; }
 
        /* Skills */
        .skills-wrap { display: flex; flex-wrap: wrap; gap: 6px; }
 
        .skill-pill {
            font-size: 11px;
            font-weight: 500;
            background: var(--cream);
            color: var(--ink);
            border: 1px solid var(--border);
            border-radius: 2px;
            padding: 4px 12px;
        }
 
        /* Print */
        @media print {
            body { padding: 0; background: white; }
            body::before { display: none; }
            .topbar { display: none; }
            .resume { box-shadow: none; border: none; }
        }
    </style>
</head>
<body>
 
<div class="page">
 
    <div class="topbar">
        <div class="eyebrow">Resume</div>
        <a href="../index.php" class="back-link">← Edit</a>
    </div>
 
    <div class="resume">
 
        <!-- ── Sidebar ── -->
        <div class="resume-left">
 
            <?php if (!empty($data['photo']) && file_exists($data['photo'])): ?>
                <img class="profile-photo"
                     src="<?= htmlspecialchars($data['photo']) ?>"
                     alt="<?= htmlspecialchars($data['name']) ?>">
            <?php else:
                $initials = implode('', array_map(fn($w) => strtoupper($w[0]),
                    array_filter(explode(' ', trim($data['name'])))));
                $initials = substr($initials, 0, 2);
            ?>
                <div class="profile-initials"><?= htmlspecialchars($initials) ?></div>
            <?php endif; ?>
 
            <div class="left-name"><?= htmlspecialchars($data['name']) ?></div>
            <?php if (!empty($data['jobtitle'])): ?>
                <div class="left-role"><?= htmlspecialchars($data['jobtitle']) ?></div>
            <?php endif; ?>
 
            <div class="left-section">Contact</div>
            <?php if (!empty($data['email'])): ?>
                <div class="left-item"><?= htmlspecialchars($data['email']) ?></div>
            <?php endif; ?>
            <?php if (!empty($data['phone'])): ?>
                <div class="left-item"><?= htmlspecialchars($data['phone']) ?></div>
            <?php endif; ?>
            <?php if (!empty($data['location'])): ?>
                <div class="left-item"><?= htmlspecialchars($data['location']) ?></div>
            <?php endif; ?>
 
            <?php if (!empty($data['education'])): ?>
                <div class="left-section">Education</div>
                <div class="left-item" style="white-space:pre-line"><?= htmlspecialchars($data['education']) ?></div>
            <?php endif; ?>
 
        </div>
 
        <!-- ── Main content ── -->
        <div class="resume-right">
 
            <?php
                $nameParts = explode(' ', trim($data['name']));
                $lastName  = count($nameParts) > 1 ? array_pop($nameParts) : '';
                $firstName = implode(' ', $nameParts) ?: $data['name'];
            ?>
            <div class="right-name">
                <?= htmlspecialchars($firstName) ?>
                <?php if ($lastName): ?>
                    <span><?= htmlspecialchars($lastName) ?></span>
                <?php endif; ?>
            </div>
 
            <?php
                $subParts = array_filter([$data['jobtitle'], $data['location']]);
                if ($subParts):
            ?>
                <div class="right-sub"><?= htmlspecialchars(implode(' · ', $subParts)) ?></div>
            <?php endif; ?>
 
            <?php if (!empty($data['experiences'])): ?>
                <div class="right-section">Experience</div>
                <?php foreach ($data['experiences'] as $exp): ?>
                    <div class="exp-block">
                        <div class="exp-header">
                            <div class="exp-title"><?= htmlspecialchars($exp['title']) ?></div>
                            <?php if (!empty($exp['date'])): ?>
                                <div class="exp-date"><?= htmlspecialchars($exp['date']) ?></div>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($exp['company'])): ?>
                            <div class="exp-company"><?= htmlspecialchars($exp['company']) ?></div>
                        <?php endif; ?>
                        <?php if (!empty($exp['desc'])): ?>
                            <div class="exp-desc"><?= nl2br(htmlspecialchars($exp['desc'])) ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
 
            <?php if (!empty($data['skills'])): ?>
                <div class="right-section">Skills</div>
                <div class="skills-wrap">
                    <?php foreach (array_filter(array_map('trim', explode(',', $data['skills']))) as $skill): ?>
                        <span class="skill-pill"><?= htmlspecialchars($skill) ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
 
        </div>
    </div>
</div>
 
</body>
</html>
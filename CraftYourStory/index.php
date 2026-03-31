<!DOCTYPE html>
<html data-theme="light">
<head>
    <title>Resume Builder</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink: #12100e;
            --paper: #faf8f4;
            --cream: #f0ece3;
            --accent: #c8562a;
            --accent-light: #f5e8e2;
            --muted: #8a8075;
            --border: #ddd8ce;
            --card-bg: #ffffff;
            --grid-color: #ddd8ce;
            --toggle-bg: #e8e4dc;
            --toggle-knob: #ffffff;
            --input-bg: #faf8f4;
            --exp-head-bg: #f0ece3;
            --get-in-touch-bg: #1b2218;
            --git-muted: #8a9e82;
            --git-input-bg: rgba(255,255,255,0.05);
            --git-input-border: rgba(255,255,255,0.12);
            --git-input-focus: rgba(200, 86, 42, 0.5);
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--paper);
            color: var(--ink);
            min-height: 100vh;
            padding: 40px 20px 0;
            position: relative;
            transition: background 0.3s, color 0.3s;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(var(--grid-color) 1px, transparent 1px),
                linear-gradient(90deg, var(--grid-color) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0.35;
            pointer-events: none;
            z-index: 0;
            transition: opacity 0.3s;
        }

       .page-wrap {
            position: relative;
            z-index: 1;
            max-width: 600px;
            margin: 0 auto;
            padding-bottom: 60px;
        }

        .page-header { margin-bottom: 24px; }

        .eyebrow {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 8px;
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

        .page-title {
            font-family: 'DM Serif Display', serif;
            font-size: 36px;
            font-weight: 400;
            line-height: 1.1;
            letter-spacing: -0.3px;
            color: var(--ink);
            transition: color 0.3s;
        }

        .page-title span { color: var(--accent); }

        .form-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 3px;
            padding: 36px 40px;
            box-shadow: 5px 5px 0 var(--cream), 5px 5px 0 1px var(--border);
            transition: background 0.3s, border-color 0.3s, box-shadow 0.3s;
        }

        .section-label {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--muted);
            border-bottom: 1px solid var(--border);
            padding-bottom: 8px;
            margin-bottom: 16px;
            margin-top: 28px;
            transition: color 0.3s, border-color 0.3s;
        }

        .section-label:first-child { margin-top: 0; }

        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 14px;
        }

        .field { display: flex; flex-direction: column; gap: 6px; margin-bottom: 14px; }

        label {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--muted);
            transition: color 0.3s;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--ink);
            background: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: 2px;
            padding: 10px 14px;
            outline: none;
            transition: border-color 0.15s, background 0.3s, color 0.3s;
            resize: vertical;
        }

        input::placeholder, textarea::placeholder { color: #c5bfb5; }
        [data-theme="dark"] input::placeholder,
        [data-theme="dark"] textarea::placeholder { color: #3a3630; }
        input:focus, textarea:focus { border-color: var(--accent); background: var(--card-bg); }
        textarea { min-height: 72px; line-height: 1.6; }

        .file-upload {
            border: 1.5px dashed var(--border);
            border-radius: 2px;
            padding: 18px;
            text-align: center;
            cursor: pointer;
            background: var(--input-bg);
            transition: border-color 0.15s, background 0.15s;
            position: relative;
        }

        .file-upload:hover { border-color: var(--accent); background: var(--accent-light); }

        .file-upload input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .file-text { font-size: 13px; color: var(--muted); margin-top: 4px; }
        .file-text strong { color: var(--accent); font-weight: 500; }

        .exp-entries { display: flex; flex-direction: column; gap: 12px; }

        .exp-entry {
            border: 1px solid var(--border);
            border-radius: 2px;
            background: var(--input-bg);
            overflow: hidden;
            transition: border-color 0.3s, background 0.3s;
        }

        .exp-entry-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            background: var(--exp-head-bg);
            border-bottom: 1px solid var(--border);
            cursor: pointer;
            user-select: none;
            transition: background 0.3s;
        }

        .exp-entry-num {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            white-space: nowrap;
        }

        .exp-entry-title-preview {
            font-size: 12px;
            color: var(--ink);
            font-weight: 400;
            flex: 1;
            margin: 0 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .exp-remove {
            font-size: 18px;
            line-height: 1;
            color: var(--muted);
            background: none;
            border: none;
            cursor: pointer;
            padding: 0 2px;
            transition: color 0.15s;
        }

        .exp-remove:hover { color: var(--accent); }
        .exp-entry-body { padding: 16px 14px 14px; }

        .add-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--accent);
            background: none;
            border: 1.5px dashed var(--border);
            border-radius: 2px;
            width: 100%;
            padding: 11px 14px;
            cursor: pointer;
            transition: border-color 0.15s, background 0.15s;
            margin-top: 4px;
        }

        .add-btn:hover { border-color: var(--accent); background: var(--accent-light); }

        .submit-wrap {
            margin-top: 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .hint { font-size: 12px; color: var(--muted); }

        button[type="submit"] {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #fff;
            background: var(--ink);
            border: none;
            border-radius: 2px;
            padding: 13px 24px;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        button[type="submit"]:hover { background: var(--accent); }
        button[type="submit"]:active { transform: scale(0.98); }

        .git-section {
            background: var(--get-in-touch-bg);
            margin-top: 80px;
            margin-left: -20px;
            margin-right: -20px;
            padding: 64px 20px 72px;
            position: relative;
            overflow: hidden;
            transition: background 0.3s;
        }

        .git-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
        }

        .git-section::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
            opacity: 0.7;
        }

        .git-inner {
            position: relative;
            z-index: 1;
            max-width: 560px;
            margin: 0 auto;
        }

        .git-eyebrow {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--git-muted);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .git-eyebrow::before {
            content: '';
            display: inline-block;
            width: 20px;
            height: 1px;
            background: var(--accent);
            opacity: 0.7;
        }

        .git-title {
            font-family: 'DM Serif Display', serif;
            font-size: 30px;
            font-weight: 400;
            color: #ede9e2;
            line-height: 1.15;
            margin-bottom: 10px;
            letter-spacing: -0.2px;
        }

        .git-title span { color: var(--accent); }

        .git-sub {
            font-size: 13px;
            color: var(--git-muted);
            font-weight: 300;
            line-height: 1.65;
            margin-bottom: 36px;
            max-width: 420px;
        }

        .git-form { display: flex; flex-direction: column; gap: 14px; }

        .git-field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .git-field { display: flex; flex-direction: column; gap: 6px; }

        .git-label {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--git-muted);
        }

        .git-input,
        .git-textarea {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: #ede9e2;
            background: var(--git-input-bg);
            border: 1px solid var(--git-input-border);
            border-radius: 2px;
            padding: 10px 14px;
            outline: none;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
            width: 100%;
        }

        .git-input::placeholder,
        .git-textarea::placeholder { color: rgba(255,255,255,0.18); }

        .git-input:focus,
        .git-textarea:focus {
            border-color: var(--accent);
            background: rgba(255,255,255,0.07);
            box-shadow: 0 0 0 3px var(--git-input-focus);
        }

        .git-textarea { resize: vertical; min-height: 110px; line-height: 1.6; }

        .git-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 4px;
            flex-wrap: wrap;
            gap: 14px;
        }

        .git-contact-alts {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .git-contact-alt {
            font-size: 11px;
            color: var(--git-muted);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: color 0.15s;
        }

        .git-contact-alt:hover { color: var(--accent); }

        .git-sep {
            width: 3px;
            height: 3px;
            border-radius: 50%;
            background: var(--git-muted);
            opacity: 0.5;
        }

        .git-submit {
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #fff;
            background: var(--accent);
            border: none;
            border-radius: 2px;
            padding: 12px 22px;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s, opacity 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .git-submit:hover { background: #b8491e; }
        .git-submit:active { transform: scale(0.98); }
        .git-submit:disabled { opacity: 0.4; cursor: default; }

        .git-sent {
            display: none;
            font-size: 12px;
            color: #6db87a;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            align-items: center;
            gap: 6px;
        }

        .git-sent.visible { display: flex; }
    </style>
</head>
<body>


<div class="page-wrap">

    <div class="page-header">
        <div class="eyebrow">Resume Builder</div>
        <h1 class="page-title">Craft your <span>story.</span></h1>
    </div>

    <div class="form-card">
        <form action="controller/CVController.php" method="POST" enctype="multipart/form-data">

            <div class="section-label">Personal Info</div>

            <div class="field">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="e.g. Maria Santos" required>
            </div>

            <div class="field">
                <label for="jobtitle">Job Title</label>
                <input type="text" id="jobtitle" name="jobtitle" placeholder="e.g. Product Designer">
            </div>

            <div class="field-row">
                <div class="field" style="margin-bottom:0">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="you@email.com" required>
                </div>
                <div class="field" style="margin-bottom:0">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" placeholder="+63 912 345 6789" required>
                </div>
            </div>

            <div class="field" style="margin-top:14px">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" placeholder="e.g. Manila, Philippines">
            </div>

            <div class="section-label">Experience</div>
            <div class="exp-entries" id="exp-entries"></div>
            <button type="button" class="add-btn" id="add-exp">+ Add Experience</button>

            <div class="section-label">Education</div>
            <div class="field">
                <label for="education">Education</label>
                <textarea id="education" name="education" placeholder="e.g. BS Computer Science&#10;University of the Philippines, 2020–2024"></textarea>
            </div>

            <div class="section-label">Skills</div>
            <div class="field">
                <label for="skills">Skills <span style="font-weight:300;text-transform:none;letter-spacing:0;font-size:10px">(comma separated)</span></label>
                <textarea id="skills" name="skills" placeholder="e.g. PHP, MySQL, UI/UX Design, Figma"></textarea>
            </div>

            <div class="section-label">Photo</div>
            <div class="file-upload">
                <input type="file" name="photo" id="photo" accept="image/*">
                <div style="font-size:20px">📎</div>
                <div class="file-text"><strong>Click to upload</strong> or drag your photo here</div>
            </div>

            <div class="submit-wrap">
                <span class="hint">* required fields</span>
                <button type="submit">Generate Resume →</button>
            </div>

        </form>
    </div>

</div>

<div class="git-section">
    <div class="git-inner">
        <div class="git-eyebrow">Get in Touch</div>
        <h2 class="git-title">Let's build something <span>together.</span></h2>
        <p class="git-sub">Have questions about the resume builder, need help with your CV, or just want to say hello? Drop us a message and we'll get back to you.</p>

        <div class="git-form">
            <div class="git-field-row">
                <div class="git-field">
                    <label class="git-label" for="git-name">Name</label>
                    <input class="git-input" type="text" id="git-name" placeholder="Your name">
                </div>
                <div class="git-field">
                    <label class="git-label" for="git-email">Email</label>
                    <input class="git-input" type="email" id="git-email" placeholder="you@email.com">
                </div>
            </div>

            <div class="git-field">
                <label class="git-label" for="git-subject">Subject</label>
                <input class="git-input" type="text" id="git-subject" placeholder="What's this about?">
            </div>

            <div class="git-field">
                <label class="git-label" for="git-message">Message</label>
                <textarea class="git-textarea" id="git-message" placeholder="Tell us what's on your mind…"></textarea>
            </div>

            <div class="git-footer">
                <div class="git-contact-alts">
                    <a href="mailto:gendoyjamaicha@gmail.com" class="git-contact-alt">✉ gendoyjamaicha@gmail.com</a>
                    <span class="git-sep"></span>
                    <a href="https://www.linkedin.com/in/jamaicha-jane-gendoy-1239a5366?utm_source=share_via&utm_content=profile&utm_medium=member_android" class="git-contact-alt">↗ LinkedIn</a>
                </div>
                <div style="display:flex;align-items:center;gap:14px">
                    <span class="git-sent" id="git-sent">✓ Message sent!</span>
                    <button type="button" class="git-submit" id="git-submit-btn">Send Message →</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    let expCount = 0;

    const addBtn = document.getElementById('add-exp');
    const container = document.getElementById('exp-entries');

    addBtn.addEventListener('click', addExperience);

    function addExperience() {
        expCount++;
        const idx = expCount;

        const entry = document.createElement('div');
        entry.className = 'exp-entry';
        entry.dataset.idx = idx;

        entry.innerHTML = `
            <div class="exp-entry-head">
                <span class="exp-entry-num">Experience ${idx}</span>
                <span class="exp-entry-title-preview" id="exp-preview-${idx}">—</span>
                <button type="button" class="exp-remove">×</button>
            </div>
            <div class="exp-entry-body">
                <div class="field-row">
                    <div class="field">
                        <label>Job Title</label>
                        <input type="text" name="exp_title[]" placeholder="e.g. Senior Designer">
                    </div>
                    <div class="field">
                        <label>Company</label>
                        <input type="text" name="exp_company[]" placeholder="e.g. Acme Corp">
                    </div>
                </div>
                <div class="field-row">
                    <div class="field">
                        <label>Start Date</label>
                        <input type="text" name="exp_start[]" placeholder="e.g. 2022">
                    </div>
                    <div class="field">
                        <label>End Date</label>
                        <input type="text" name="exp_end[]" placeholder="e.g. Present">
                    </div>
                </div>
                <div class="field">
                    <label>Description</label>
                    <textarea name="exp_desc[]" placeholder="Briefly describe your responsibilities..."></textarea>
                </div>
            </div>
        `;

        container.appendChild(entry);

        const head = entry.querySelector('.exp-entry-head');
        const removeBtn = entry.querySelector('.exp-remove');
        const body = entry.querySelector('.exp-entry-body');
        const titleInput = entry.querySelector("input[name='exp_title[]']");
        const companyInput = entry.querySelector("input[name='exp_company[]']");
        const preview = entry.querySelector(`#exp-preview-${idx}`);

        head.addEventListener('click', () => {
            body.classList.toggle('hidden');
        });

        removeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            entry.remove();
        });

        function updatePreview() {
            const title = titleInput.value.trim();
            const company = companyInput.value.trim();

            preview.textContent = (title || company)
                ? `${title}${title && company ? ' @ ' : ''}${company}`
                : '—';
        }

        titleInput.addEventListener('input', updatePreview);
        companyInput.addEventListener('input', updatePreview);
    }

    addExperience();


    document.getElementById('git-submit-btn').addEventListener('click', () => {
        const name    = document.getElementById('git-name').value.trim();
        const email   = document.getElementById('git-email').value.trim();
        const message = document.getElementById('git-message').value.trim();

        if (!name || !email || !message) {
            const missing = [];
            if (!name) missing.push('name');
            if (!email) missing.push('email');
            if (!message) missing.push('message');
            alert('Please fill in: ' + missing.join(', ') + '.');
            return;
        }

        const btn = document.getElementById('git-submit-btn');
        btn.disabled = true;

        setTimeout(() => {
            btn.style.display = 'none';
            document.getElementById('git-sent').classList.add('visible');

            ['git-name','git-email','git-subject','git-message'].forEach(id => {
                const el = document.getElementById(id);
                el.value = '';
                el.disabled = true;
            });
        }, 500);
    });

});
</script>
</body>
</html>
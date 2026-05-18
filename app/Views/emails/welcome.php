<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body    { font-family: Arial, sans-serif; background:#f4f7f9; margin:0; padding:0; }
        .wrap   { max-width:580px; margin:30px auto; background:#fff;
                  border-radius:8px; overflow:hidden;
                  box-shadow:0 2px 12px rgba(0,0,0,.1); }
        .header { background:#0d7377; color:#fff; padding:30px 40px; }
        .header h1 { margin:0; font-size:1.5rem; }
        .body   { padding:30px 40px; color:#333; line-height:1.6; }
        .btn    { display:inline-block; background:#0d7377; color:#fff;
                  padding:12px 28px; border-radius:5px;
                  text-decoration:none; font-weight:bold; margin:20px 0; }
        .footer { background:#f4f7f9; text-align:center; padding:15px;
                  font-size:.8rem; color:#999; }
    </style>
</head>
<body>
<div class="wrap">

    <div class="header">
        <h1>🎓 Welcome to CI4 Student Portal!</h1>
    </div>

    <div class="body">
        <p>Hi <strong><?= esc($name) ?></strong>,</p>

        <p>
            Your registration was successful! You are now part of the
            <strong>CI4 Student Portal</strong> — a CodeIgniter 4 application
            built for Advanced Web Development, Spring 2025.
        </p>

        <p>Here is what you can do on the portal:</p>
        <ul>
            <li>Browse the student directory with search &amp; pagination</li>
            <li>Upload a profile photo</li>
            <li>View your student profile</li>
        </ul>

        <a href="<?= esc($siteUrl) ?>students" class="btn">
            Visit Student Directory →
        </a>

        <p style="margin-top:24px; color:#666; font-size:.9rem;">
            This email was sent because you registered at
            <a href="<?= esc($siteUrl) ?>"><?= esc($siteUrl) ?></a>.
            If this was not you, please disregard this message.
        </p>
    </div>

    <div class="footer">
        Advanced Web Development · CodeIgniter 4
    </div>

</div>
</body>
</html>

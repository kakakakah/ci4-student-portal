<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'CI4 Student Portal') ?> — CI4 Portal</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    <style>
        :root {
            --ci-teal:   #0d7377;
            --ci-navy:   #132b3d;
            --ci-accent: #14a085;
        }
        body        { background: #f4f7f9; font-family: 'Segoe UI', sans-serif; }
        .navbar     { background: var(--ci-navy) !important; }
        .navbar-brand, .nav-link { color: #fff !important; }
        .nav-link:hover { color: var(--ci-accent) !important; }
        .btn-ci     { background: var(--ci-teal); color: #fff; border: none; }
        .btn-ci:hover { background: var(--ci-accent); color: #fff; }
        footer      { background: var(--ci-navy); color: #aaa; font-size: .85rem; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<!-- ── Navigation ─────────────────────────────────────────── -->
<nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">
            <i class="bi bi-shield-lock-fill me-2" style="color:var(--ci-accent)"></i>
            CI4 Student Portal
        </a>
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/"><i class="bi bi-house me-1"></i>Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/students">
                        <i class="bi bi-people me-1"></i>Students
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">
                        <i class="bi bi-person-plus me-1"></i>Register
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/upload">
                        <i class="bi bi-cloud-upload me-1"></i>Upload
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ── Flash messages ─────────────────────────────────────── -->
<div class="container">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i>
            <?= esc(session()->getFlashdata('success')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <?= esc(session()->getFlashdata('error')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
</div>

<!-- ── Page content ───────────────────────────────────────── -->
<main class="container flex-grow-1 pb-5">
    <?= $this->renderSection('content') ?>
</main>

<!-- ── Footer ─────────────────────────────────────────────── -->
<footer class="py-3 mt-auto">
    <div class="container text-center">
        Advanced Web Development · CodeIgniter 4
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

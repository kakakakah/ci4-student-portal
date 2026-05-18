<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- ── Hero ──────────────────────────────────────────────── -->
<div class="p-5 mb-4 rounded-3 text-white"
     style="background: linear-gradient(135deg, #132b3d 0%, #0d7377 100%);">
    <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold">
            <i class="bi bi-shield-lock-fill me-3"></i>CI4 Student Portal
        </h1>
        <p class="col-md-8 fs-5">
            A full-featured CodeIgniter 4 application demonstrating
            <strong>security</strong>, <strong>advanced features</strong>,
            <strong>unit testing</strong>, and <strong>cloud deployment</strong>.
        </p>
        <a href="/students" class="btn btn-light btn-lg me-2">
            <i class="bi bi-people me-1"></i>Browse Students
        </a>
        <a href="/register" class="btn btn-outline-light btn-lg">
            <i class="bi bi-person-plus me-1"></i>Register Now
        </a>
    </div>
</div>

<!-- ── Feature Cards ─────────────────────────────────────── -->
<div class="row g-4 mb-5">
    
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header text-white fw-semibold"
                 style="background:#0d7377">
                
            </div>
            <div class="card-body">
                <ul class="small mb-0">
                    <li>CSRF token on every POST form</li>
                    <li>403 Forbidden on missing token</li>
                    <li><code>esc($var, 'html')</code> on all output</li>
                    <li>XSS filter enabled globally</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header text-white fw-semibold"
                 style="background:#1e5ea8">
                
            </div>
            <div class="card-body">
                <ul class="small mb-0">
                    <li>File upload with MIME validation</li>
                    <li>SMTP HTML email + plain-text fallback</li>
                    <li>Paginated listing with search</li>
                    <li>Page caching + Debug Toolbar</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header text-white fw-semibold"
                 style="background:#6a3dc8">
                
            </div>
            <div class="card-body">
                <ul class="small mb-0">
                    <li>PHPUnit suite (3+ tests)</li>
                    <li><code>assertTrue</code>, <code>assertEquals</code></li>
                    <li><code>dd()</code> debugging demo</li>
                    <li>Stack trace documented</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header text-white fw-semibold"
                 style="background:#a04000">
                
            </div>
            <div class="card-body">
                <ul class="small mb-0">
                    <li>Production <code>.env</code> config</li>
                    <li>SSL + HTTPS enforced</li>
                    <li><code>.env</code> in <code>.gitignore</code></li>
                    <li>Deployment log submitted</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- ── Quick links ────────────────────────────────────────── -->
<div class="row g-3">
    <div class="col-sm-4">
        <a href="/register"
           class="btn btn-ci w-100 py-3">
            <i class="bi bi-person-plus-fill fs-4 d-block mb-1"></i>
            Register Student
        </a>
    </div>
    <div class="col-sm-4">
        <a href="/students"
           class="btn btn-outline-dark w-100 py-3">
            <i class="bi bi-search fs-4 d-block mb-1"></i>
            Browse &amp; Search
        </a>
    </div>
    <div class="col-sm-4">
        <a href="/upload"
           class="btn btn-outline-dark w-100 py-3">
            <i class="bi bi-cloud-upload-fill fs-4 d-block mb-1"></i>
            Upload File
        </a>
    </div>
</div>

<?= $this->endSection() ?>

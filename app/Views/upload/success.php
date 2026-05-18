<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 text-center mt-3">

        <div class="card shadow-sm border-0">
            <div class="card-header text-white fw-semibold"
                 style="background:#14a085">
                <i class="bi bi-check-circle-fill me-2"></i>
                Upload Successful!
            </div>
            <div class="card-body p-4">
                <img src="<?= esc($fileUrl) ?>"
                     alt="Uploaded image"
                     class="img-thumbnail mb-3"
                     style="max-height:280px; max-width:100%;">

                <p class="mb-1">
                    <i class="bi bi-file-earmark-image me-1"></i>
                    <strong><?= esc($filename) ?></strong>
                </p>
                <p class="text-muted small mb-4">
                    Size: <?= esc($fileSize) ?>
                    · Stored in <code>writable/uploads/</code>
                </p>

                <div class="d-flex gap-2 justify-content-center">
                    <a href="/upload" class="btn btn-ci">
                        <i class="bi bi-arrow-repeat me-1"></i>Upload Another
                    </a>
                    <a href="/register" class="btn btn-outline-secondary">
                        <i class="bi bi-person-plus me-1"></i>Register Student
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>

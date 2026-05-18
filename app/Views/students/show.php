<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="row justify-content-center">
    <div class="col-lg-7">
        <a href="/students" class="btn btn-sm btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left me-1"></i>Back to Directory
        </a>

        <div class="card shadow-sm border-0">
            <div class="card-header text-white fw-semibold"
                 style="background:#132b3d">
                <i class="bi bi-person-badge me-2"></i>
                Student Profile
            </div>
            <div class="card-body p-4">
                <?php if (! empty($student['photo'])): ?>
                    <img src="<?= esc(base_url('uploads/' . $student['photo'])) ?>"
                         alt="Profile photo of <?= esc($student['name']) ?>"
                         class="rounded-circle mb-3"
                         style="width:90px;height:90px;object-fit:cover;">
                <?php else: ?>
                    <div class="rounded-circle d-inline-flex align-items-center
                                justify-content-center bg-secondary text-white mb-3"
                         style="width:90px;height:90px;font-size:2.5rem;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                <?php endif; ?>

                <h3 class="mb-1"><?= esc($student['name']) ?></h3>
                <p class="text-muted mb-3">
                    <i class="bi bi-envelope me-1"></i>
                    <?= esc($student['email']) ?>
                </p>

                <?php if (! empty($student['bio'])): ?>
                    <p class="mb-0"><?= esc($student['bio']) ?></p>
                <?php else: ?>
                    <p class="text-muted fst-italic mb-0">No bio provided.</p>
                <?php endif; ?>

                <hr>
                <small class="text-muted">
                    Registered: <?= esc(date('F j, Y', strtotime($student['created_at']))) ?>
                </small>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

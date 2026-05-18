<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

        <div class="card shadow-sm border-0 mt-3">
            <div class="card-header text-white fw-semibold"
                 style="background:#0d7377">
                <i class="bi bi-person-plus-fill me-2"></i>
                Student Registration
            </div>

            <div class="card-body p-4">

                <!-- ── CSRF demo callout ───────────────────── -->
                <div class="alert alert-info small py-2">
                    <i class="bi bi-shield-check me-1"></i>
                    <strong> – CSRF:</strong>
                    A hidden <code>csrf_token</code> field is embedded below.
                    Remove it in DevTools and submit to see the
                    <strong>403 Forbidden</strong> response.
                </div>

                <!-- ── Registration form ──────────────────── -->
                <form action="/register" method="post" novalidate>
                    <!--
                        "Add <?= csrf_field() ?> to every POST form"
                        This outputs:
                        <input type="hidden" name="csrf_test_name" value="RANDOM_TOKEN">
                    -->
                    <?= csrf_field() ?>

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">
                            Full Name <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               id="name" name="name"
                               class="form-control <?= isset($validation) && $validation->hasError('name') ? 'is-invalid' : '' ?>"
                               value="<?= esc(old('name')) ?>"
                               placeholder="e.g. Ana Reyes"
                               required>
                        <?php if (isset($validation) && $validation->hasError('name')): ?>
                            <div class="invalid-feedback">
                                <!-- XSS: esc() applied to validation error text -->
                                <?= esc($validation->getError('name')) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            Email Address <span class="text-danger">*</span>
                        </label>
                        <input type="email"
                               id="email" name="email"
                               class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>"
                               value="<?= esc(old('email')) ?>"
                               placeholder="student@example.com"
                               required>
                        <?php if (isset($validation) && $validation->hasError('email')): ?>
                            <div class="invalid-feedback">
                                <?= esc($validation->getError('email')) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Bio -->
                    <div class="mb-4">
                        <label for="bio" class="form-label fw-semibold">Short Bio</label>
                        <textarea id="bio" name="bio" rows="3"
                                  class="form-control <?= isset($validation) && $validation->hasError('bio') ? 'is-invalid' : '' ?>"
                                  placeholder="Tell us about yourself (max 500 chars)"
                                  maxlength="500"><?= esc(old('bio')) ?></textarea>
                        <div class="form-text">
                            Try entering
                            <code>&lt;script&gt;alert(1)&lt;/script&gt;</code>
                            — the XSS filter will neutralise it.
                        </div>
                        <?php if (isset($validation) && $validation->hasError('bio')): ?>
                            <div class="invalid-feedback">
                                <?= esc($validation->getError('bio')) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-ci w-100 py-2 fw-semibold">
                        <i class="bi bi-send me-2"></i>Register &amp; Send Welcome Email
                    </button>
                </form>

            </div><!-- /.card-body -->
        </div><!-- /.card -->

        <!-- XSS demo note -->
        <div class="alert alert-warning small mt-3">
            <i class="bi bi-exclamation-triangle me-1"></i>
            <strong> – XSS:</strong>
            All output is wrapped in <code>esc($variable, 'html')</code>.
            A stored payload like <code>&lt;script&gt;alert(1)&lt;/script&gt;</code>
            renders as harmless text — never executed.
        </div>

    </div>
</div>

<?= $this->endSection() ?>

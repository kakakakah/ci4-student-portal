<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

        <div class="card shadow-sm border-0 mt-3">
            <div class="card-header text-white fw-semibold"
                 style="background:#1e5ea8">
                <i class="bi bi-cloud-upload-fill me-2"></i>
                Upload Profile Image
            </div>

            <div class="card-body p-4">

                <div class="alert alert-info small py-2">
                    <i class="bi bi-info-circle me-1"></i>
                    <strong> – UploadedFile validation:</strong>
                    MIME type, file size (&le; 2 MB), and image type are all
                    checked server-side before saving to
                    <code>writable/uploads/</code>.
                </div>

                
                <form action="/upload" method="post"
                      enctype="multipart/form-data" novalidate>

                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label for="userfile" class="form-label fw-semibold">
                            Choose Image <span class="text-danger">*</span>
                        </label>
                        <input type="file"
                               id="userfile" name="userfile"
                               accept="image/*"
                               class="form-control <?= isset($validation) && $validation->hasError('userfile') ? 'is-invalid' : '' ?>">

                        <div class="form-text">
                            Accepted: JPG, PNG, GIF, WebP · Max size: 2 MB
                        </div>

                        <?php if (isset($validation) && $validation->hasError('userfile')): ?>
                            <div class="invalid-feedback d-block">
                                <?= esc($validation->getError('userfile')) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Live preview before upload -->
                    <div id="preview-wrap" class="mb-3 d-none text-center">
                        <img id="preview-img"
                             src="#" alt="Preview"
                             class="img-thumbnail"
                             style="max-height:180px;">
                    </div>

                    <button type="submit" class="btn btn-ci w-100 py-2 fw-semibold">
                        <i class="bi bi-upload me-2"></i>Upload Image
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

<script>
// Live image preview (no server round-trip needed)
document.getElementById('userfile').addEventListener('change', function () {
    const wrap = document.getElementById('preview-wrap');
    const img  = document.getElementById('preview-img');
    if (this.files && this.files[0]) {
        img.src = URL.createObjectURL(this.files[0]);
        wrap.classList.remove('d-none');
    }
});
</script>

<?= $this->endSection() ?>

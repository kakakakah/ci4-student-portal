<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* Pagination Container */
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin: 0; /* The parent div already handles the margin */
        gap: 8px; 
    }

    /* Individual Numbers/Links */
    .pagination li a,
    .pagination li span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 12px;
        color: #0c6b6b; 
        text-decoration: none;
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 6px; 
        font-weight: 500;
        font-size: 14px;
        transition: all 0.2s ease-in-out;
    }

    /* Hover Effect */
    .pagination li a:hover {
        background-color: #f1f5f9;
        border-color: #cbd5e1;
        color: #0a5252;
    }

    /* Active Page (Current Page) */
    .pagination li.active a,
    .pagination li.active span {
        background-color: #118181; 
        color: #ffffff;
        border-color: #118181;
        pointer-events: none; 
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">
        <i class="bi bi-people-fill me-2" style="color:#0d7377"></i>
        <?= esc($title) ?>
    </h2>
    <a href="/register" class="btn btn-ci">
        <i class="bi bi-person-plus me-1"></i>Register New Student
    </a>
</div>

<form action="/students" method="get" class="mb-4">
    <div class="input-group">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Search by name or email…"
               value="<?= esc($search) ?>">
        <button class="btn btn-ci" type="submit">
            <i class="bi bi-search me-1"></i>Search
        </button>
        <?php if ($search !== ''): ?>
            <a href="/students" class="btn btn-outline-secondary">
                <i class="bi bi-x-circle me-1"></i>Clear
            </a>
        <?php endif; ?>
    </div>
</form>

<p class="text-muted small mb-3">
    Showing page <strong><?= esc($currentPage) ?></strong>
    · <strong><?= esc($totalRows) ?></strong> student(s) found
    <?= $search !== '' ? 'for <em>"' . esc($search) . '"</em>' : '' ?>
</p>

<?php if (empty($students)): ?>
    <div class="alert alert-secondary">
        <i class="bi bi-info-circle me-2"></i>
        No students found<?= $search !== '' ? ' matching "' . esc($search) . '"' : '' ?>.
    </div>
<?php else: ?>
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle mb-0 bg-white">
            <thead style="background:#132b3d; color:#fff;">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Bio</th>
                    <th>Joined</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($students as $s): ?>
                <tr>
                    <td class="text-muted small"><?= esc($s['id']) ?></td>

                    <td class="fw-semibold"><?= esc($s['name']) ?></td>
                    <td><?= esc($s['email']) ?></td>
                    <td class="text-muted small">
                        <?= esc(mb_strimwidth($s['bio'] ?? '', 0, 60, '…')) ?>
                    </td>
                    <td class="text-muted small">
                        <?= esc(date('M j, Y', strtotime($s['created_at']))) ?>
                    </td>
                    <td>
                        <a href="/students/<?= esc($s['id']) ?>"
                           class="btn btn-sm btn-outline-secondary">
                            View
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        <?php
            // Maintain search query across page links
            $pager->setPath('/students');
            echo $pager->only(['search'])->links();
        ?>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>
<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h1>Academic Years</h1>
<p style="color:#64748b;">Manage school years and activate the current one</p>

<!-- ADD YEAR -->
<div class="card">
    <h3>Add Academic Year</h3>

    <form method="post" action="<?= site_url('admin/academic-years/store') ?>">
        <input class="form-input" name="name" placeholder="2026–2027" required>
        <input class="form-input" type="date" name="start_date">
        <input class="form-input" type="date" name="end_date">
        <button class="btn">Add Year</button>
    </form>
</div>

<!-- LIST YEARS -->
<div class="card">
    <h3>All Academic Years</h3>

    <table class="modern-table">
        <thead>
            <tr>
                <th>Academic Year</th>
                <th>Status</th>
                <th style="width:160px;">Action</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($years as $y): ?>
            <tr style="<?= $y['is_active'] ? 'background:#f0fdf4;' : '' ?>">
                <td style="font-weight:600;">
                    <?= esc($y['name']) ?>
                </td>

                <td>
                    <?php if ($y['is_active']): ?>
                        <span class="badge-present">🟢 Active</span>
                    <?php else: ?>
                        <span class="badge-absent">⚪ Archived</span>
                    <?php endif; ?>
                </td>

                <td>
                    <?php if (!$y['is_active']): ?>
                       <a href="<?= site_url('admin/academic-years/activate/'.$y['id']) ?>"
   class="btn"
   style="
       background:#22c55e;
       padding:8px 18px;
       border-radius:10px;
       font-weight:600;
       display:inline-block;
       color:white;
       text-decoration:none;
   ">
    Activate
</a>
                    <?php else: ?>
                        <span style="color:#16a34a; font-weight:600;">
                            Current Year
                        </span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>

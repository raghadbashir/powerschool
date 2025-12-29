<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
.promotion-controls{
    display:flex; gap:12px; align-items:center; flex-wrap:wrap;
    margin: 10px 0 18px;
}
.promotion-controls select, .promotion-controls button{
    padding:10px 14px; border-radius:10px;
    border:1px solid #cbd5e1; font-size:14px;
}

.btn-primary{ background:#2563eb; color:#fff; font-weight:700; border:none; cursor:pointer; }
.btn-success{ background:#16a34a; color:#fff; font-weight:700; border:none; cursor:pointer; }

.btn-outline{
    background:#fff;
    color:#334155;
    border:1px solid #cbd5e1;
    font-weight:700;
    cursor:pointer;
}
.btn-outline.active{
    background:#2563eb;
    color:#fff;
    border-color:#2563eb;
}

.btn-disabled{ opacity:.6; cursor:not-allowed; }

.preview-table{
    width:100%;
    border-collapse:collapse;
    margin-top:14px;
    background:#fff;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.06);
}
.preview-table th{
    background:#f1f5f9;
    padding:12px;
    text-align:left;
    font-weight:800;
}
.preview-table td{
    padding:10px 12px;
    border-top:1px solid #e5e7eb;
}

.notice{
    margin-top:14px;
    padding:12px 14px;
    border-radius:12px;
    background:#fff7ed;
    border:1px solid #fed7aa;
    color:#9a3412;
    font-weight:700;
}
.summary{
    margin-top:14px;
    padding:14px;
    border-radius:12px;
    background:#f8fafc;
    border:1px solid #e2e8f0;
}
.small{ font-size:13px; color:#475569; }

.decision-buttons{
    display:flex;
    gap:8px;
    flex-wrap:wrap;
}
</style>

<h2>Student Promotion</h2>

<p class="small">
    Current Academic Year ID: <strong><?= esc($currentYearId) ?></strong>
</p>

<div class="promotion-controls">
    <label>Select Grade:</label>
    <select id="gradeFilter">
        <?php foreach ($grades as $g): ?>
            <option value="<?= (int)$g['grade'] ?>">Grade <?= (int)$g['grade'] ?></option>
        <?php endforeach; ?>
    </select>

    <button class="btn-primary" id="previewBtn">Preview</button>
    <button class="btn-success btn-disabled" id="confirmBtn" disabled>
        Confirm Promotion
    </button>
</div>

<div id="previewArea"></div>
<div id="summaryArea"></div>

<script>
let lastPreview = null;

const previewBtn  = document.getElementById('previewBtn');
const confirmBtn  = document.getElementById('confirmBtn');
const previewArea = document.getElementById('previewArea');
const summaryArea = document.getElementById('summaryArea');

previewBtn.addEventListener('click', loadPreview);
confirmBtn.addEventListener('click', confirmPromotion);

async function loadPreview(){
    const grade = document.getElementById('gradeFilter').value;

    lastPreview = null;
    confirmBtn.disabled = true;
    confirmBtn.classList.add('btn-disabled');
    previewArea.innerHTML = 'Loading...';
    summaryArea.innerHTML = '';

    const res = await fetch(`/admin/promotions/preview?grade=${grade}`);
    const data = await res.json();

    if(!data.students || data.students.length === 0){
        previewArea.innerHTML =
            `<div class="notice">No students in this grade.</div>`;
        return;
    }

    lastPreview = data;
    renderTable();
    confirmBtn.disabled = false;
    confirmBtn.classList.remove('btn-disabled');
}

function renderTable(){
    const students = lastPreview.students;

    let html = `
    <table class="preview-table">
        <thead>
            <tr>
                <th>Include</th>
                <th>Student</th>
                <th>From</th>
                <th>Decision</th>
                <th>Target</th>
            </tr>
        </thead>
        <tbody>
    `;

    students.forEach((s,i)=>{
        const isGrade12 = Number(s.current_grade) === 12;

        html += `
        <tr>
            <td>
                <input type="checkbox" class="includeChk" checked>
            </td>
            <td>${escapeHtml(s.student_name)}</td>
            <td>${escapeHtml(s.from_class)}</td>
            <td>
                <div class="decision-buttons">
                    ${
                        isGrade12
                        ? `
                            <button class="btn-outline ${s.action==='graduate'?'active':''}"
                                onclick="setAction(${i},'graduate')">
                                Graduate
                            </button>
                        `
                        : `
                            <button class="btn-outline ${s.action==='promote'?'active':''}"
                                onclick="setAction(${i},'promote')">
                                Promote
                            </button>
                        `
                    }
                    <button class="btn-outline ${s.action==='repeat'?'active':''}"
                        onclick="setAction(${i},'repeat')">
                        Hold Back
                    </button>
                </div>
            </td>
            <td id="target-${i}">
                ${escapeHtml(s.target_class ?? '-')}
            </td>
        </tr>
        `;
    });

    html += `</tbody></table>`;
    previewArea.innerHTML = html;
}

function setAction(index, action){
    const s = lastPreview.students[index];
    s.action = action;

    if(action === 'graduate'){
        s.target_class = '-';
        s.target_class_id = null;
    }

    if(action === 'repeat'){
        s.target_class = 'Repeat: ' + s.from_class;
        s.target_class_id = null;
    }

    renderTable();
}

async function confirmPromotion(){
    document.querySelectorAll('.includeChk').forEach((chk,i)=>{
        lastPreview.students[i].include = chk.checked;
    });

    confirmBtn.disabled = true;
    confirmBtn.textContent = 'Processing...';

    const res = await fetch('/admin/promotions/process',{
        method:'POST',
        headers:{ 'Content-Type':'application/json' },
body: JSON.stringify({
    students: lastPreview.students
})    });

    const data = await res.json();
    renderSummary(data.summary);
    await loadPreview();

    confirmBtn.disabled = false;
    confirmBtn.textContent = 'Confirm Promotion';
}

function renderSummary(s){
    summaryArea.innerHTML = `
    <div class="summary">
        <b>Promotion Summary</b><br><br>
        ✅ Promoted: <b>${s.promoted}</b><br>
        🔁 Repeated: <b>${s.repeated}</b><br>
        🎓 Graduated: <b>${s.graduated}</b>
    </div>`;
}

function escapeHtml(str){
    return String(str ?? '').replace(/[&<>"']/g,m=>({
        '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'
    }[m]));
}
</script>

<?= $this->endSection() ?>
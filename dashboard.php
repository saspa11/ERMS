<?php
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/helpers.php';

$pageTitle = 'Dashboard';
$currentPage = 'dashboard';
$basePath = '';
$totalEmployees = (int) $pdo->query('SELECT COUNT(*) FROM employees')->fetchColumn();
$activeEmployees = (int) $pdo->query("SELECT COUNT(*) FROM employees INNER JOIN employee_statuses ON employees.status_id = employee_statuses.id WHERE employee_statuses.name = 'Active'")->fetchColumn();
$inactiveEmployees = (int) $pdo->query("SELECT COUNT(*) FROM employees INNER JOIN employee_statuses ON employees.status_id = employee_statuses.id WHERE employee_statuses.name = 'Inactive'")->fetchColumn();
$onLeaveEmployees = (int) $pdo->query("SELECT COUNT(*) FROM employees INNER JOIN employee_statuses ON employees.status_id = employee_statuses.id WHERE employee_statuses.name = 'On Leave'")->fetchColumn();
$departmentCount = (int) $pdo->query('SELECT COUNT(*) FROM departments')->fetchColumn();
$recentStmt = $pdo->query(employee_join_sql() . ' ORDER BY employees.created_at DESC LIMIT 5');
$recentEmployees = $recentStmt->fetchAll();
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/sidebar.php';
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4"><li class="breadcrumb-item active">ERMS Dashboard</li></ol>
        <div class="row">
            <div class="col-xl-3 col-md-6"><div class="card bg-primary text-white mb-4"><div class="card-body">Total Employees <h2><?= $totalEmployees ?></h2></div></div></div>
            <div class="col-xl-3 col-md-6"><div class="card bg-success text-white mb-4"><div class="card-body">Active <h2><?= $activeEmployees ?></h2></div></div></div>
            <div class="col-xl-3 col-md-6"><div class="card bg-warning text-white mb-4"><div class="card-body">On Leave <h2><?= $onLeaveEmployees ?></h2></div></div></div>
            <div class="col-xl-3 col-md-6"><div class="card bg-danger text-white mb-4"><div class="card-body">Inactive <h2><?= $inactiveEmployees ?></h2></div></div></div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-6"><div class="card mb-4"><div class="card-header"><i class="fas fa-building me-1"></i> Departments</div><div class="card-body"><h2><?= $departmentCount ?></h2><p class="mb-0 text-muted">Departments in the database</p></div></div></div>
            <div class="col-xl-8"><div class="card mb-4"><div class="card-header d-flex justify-content-between align-items-center"><span><i class="fas fa-code me-1"></i> API Integration Preview</span><button class="btn btn-sm btn-outline-primary" type="button" id="copyApiDataBtn"><i class="fas fa-copy me-1"></i>Copy API Data</button></div><div class="card-body"><div id="apiDepartmentSummary">Loading API data...</div><small class="text-success d-none" id="copyApiDataMessage">API data copied.</small></div></div></div>
        </div>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-users me-1"></i> Recent Employee Records</div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead><tr><th>Employee No.</th><th>Name</th><th>Department</th><th>Position</th><th>Status</th></tr></thead>
                    <tbody>
                        <?php foreach ($recentEmployees as $employee): ?>
                            <tr>
                                <td><?= e($employee['employee_no']) ?></td>
                                <td><?= e($employee['first_name'] . ' ' . $employee['last_name']) ?></td>
                                <td><?= e($employee['department_name']) ?></td>
                                <td><?= e($employee['position_title']) ?></td>
                                <td><?= e($employee['status_name']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<script>
let departmentApiData = [];
const copyApiDataBtn = document.getElementById('copyApiDataBtn');
const copyApiDataMessage = document.getElementById('copyApiDataMessage');

fetch('api/departments.php')
    .then(response => response.json())
    .then(data => {
        departmentApiData = data;
        const container = document.getElementById('apiDepartmentSummary');
        if (!data.length) {
            container.textContent = 'No department API data available.';
            return;
        }
        container.innerHTML = data.map(item => `
            <div class="d-flex justify-content-between border-bottom py-2">
                <span>${item.department}</span>
                <strong>${item.employee_count} employee(s)</strong>
            </div>
        `).join('');
    })
    .catch(() => document.getElementById('apiDepartmentSummary').textContent = 'Unable to load API data.');

copyApiDataBtn.addEventListener('click', () => {
    if (!departmentApiData.length) {
        copyApiDataMessage.classList.remove('d-none', 'text-success');
        copyApiDataMessage.classList.add('text-danger');
        copyApiDataMessage.textContent = 'No API data available to copy.';
        return;
    }

    navigator.clipboard.writeText(JSON.stringify(departmentApiData, null, 2))
        .then(() => {
            copyApiDataMessage.classList.remove('d-none', 'text-danger');
            copyApiDataMessage.classList.add('text-success');
            copyApiDataMessage.textContent = 'API data copied.';
        })
        .catch(() => {
            copyApiDataMessage.classList.remove('d-none', 'text-success');
            copyApiDataMessage.classList.add('text-danger');
            copyApiDataMessage.textContent = 'Unable to copy API data.';
        });
});
</script>
<?php require __DIR__ . '/includes/footer.php'; ?>

<?php
require_once __DIR__ . '/../includes/auth.php';
require_login_from_subdir();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/helpers.php';
$pageTitle = 'Departments';
$currentPage = 'departments';
$basePath = '../';
$stmt = $pdo->query('SELECT departments.id, departments.name, COUNT(employees.id) AS employee_count FROM departments LEFT JOIN employees ON departments.id = employees.department_id GROUP BY departments.id, departments.name ORDER BY departments.name');
$departments = $stmt->fetchAll();
require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/sidebar.php';
?>
<main><div class="container-fluid px-4"><h1 class="mt-4">Departments</h1><div class="card mb-4"><div class="card-header"><i class="fas fa-building me-1"></i>Department Summary</div><div class="card-body table-responsive"><table class="table table-bordered"><thead><tr><th>Department</th><th>Employee Count</th></tr></thead><tbody><?php foreach ($departments as $department): ?><tr><td><?= e($department['name']) ?></td><td><?= e($department['employee_count']) ?></td></tr><?php endforeach; ?></tbody></table></div></div></div></main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

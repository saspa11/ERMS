<?php
require_once __DIR__ . '/../includes/auth.php';
require_login_from_subdir();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/helpers.php';
$pageTitle = 'View Employee';
$currentPage = 'employees';
$basePath = '../';
$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare(employee_join_sql() . ' WHERE employees.id = ?');
$stmt->execute([$id]);
$employee = $stmt->fetch();
if (!$employee) redirect_to('index.php?message=Employee not found');
require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/sidebar.php';
?>
<main><div class="container-fluid px-4"><h1 class="mt-4">Employee Profile</h1><div class="card mb-4"><div class="card-header"><?= e($employee['first_name'] . ' ' . $employee['last_name']) ?></div><div class="card-body"><dl class="row"><dt class="col-sm-3">Employee No.</dt><dd class="col-sm-9"><?= e($employee['employee_no']) ?></dd><dt class="col-sm-3">Email</dt><dd class="col-sm-9"><?= e($employee['email']) ?></dd><dt class="col-sm-3">Phone</dt><dd class="col-sm-9"><?= e($employee['phone']) ?></dd><dt class="col-sm-3">Department</dt><dd class="col-sm-9"><?= e($employee['department_name']) ?></dd><dt class="col-sm-3">Position</dt><dd class="col-sm-9"><?= e($employee['position_title']) ?></dd><dt class="col-sm-3">Status</dt><dd class="col-sm-9"><?= e($employee['status_name']) ?></dd><dt class="col-sm-3">Hire Date</dt><dd class="col-sm-9"><?= e($employee['hire_date']) ?></dd><dt class="col-sm-3">Address</dt><dd class="col-sm-9"><?= e($employee['address']) ?></dd></dl><a class="btn btn-secondary" href="index.php">Back</a> <a class="btn btn-warning" href="edit.php?id=<?= $employee['id'] ?>">Edit</a></div></div></div></main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

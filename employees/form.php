<?php
$employee = $employee ?? ['employee_no'=>'','first_name'=>'','last_name'=>'','email'=>'','phone'=>'','hire_date'=>'','department_id'=>'','position_id'=>'','status_id'=>'','address'=>''];
$errors = $errors ?? [];
?>
<?php if ($errors): ?><div class="alert alert-danger"><strong>Please fix the following:</strong><ul class="mb-0"><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
<form method="post" class="card mb-4">
    <div class="card-body row g-3">
        <div class="col-md-4"><label class="form-label">Employee No.</label><input class="form-control" name="employee_no" required value="<?= e($employee['employee_no']) ?>"></div>
        <div class="col-md-4"><label class="form-label">First Name</label><input class="form-control" name="first_name" required value="<?= e($employee['first_name']) ?>"></div>
        <div class="col-md-4"><label class="form-label">Last Name</label><input class="form-control" name="last_name" required value="<?= e($employee['last_name']) ?>"></div>
        <div class="col-md-4"><label class="form-label">Email</label><input class="form-control" type="email" name="email" required value="<?= e($employee['email']) ?>"></div>
        <div class="col-md-4"><label class="form-label">Phone</label><input class="form-control" name="phone" value="<?= e($employee['phone']) ?>"></div>
        <div class="col-md-4"><label class="form-label">Hire Date</label><input class="form-control" type="date" name="hire_date" required value="<?= e($employee['hire_date']) ?>"></div>
        <div class="col-md-4"><label class="form-label">Department</label><select class="form-select" name="department_id" required><option value="">Select department</option><?php foreach ($departments as $department): ?><option value="<?= $department['id'] ?>" <?= (string)$employee['department_id'] === (string)$department['id'] ? 'selected' : '' ?>><?= e($department['name']) ?></option><?php endforeach; ?></select></div>
        <div class="col-md-4"><label class="form-label">Position</label><select class="form-select" name="position_id" required><option value="">Select position</option><?php foreach ($positions as $position): ?><option value="<?= $position['id'] ?>" <?= (string)$employee['position_id'] === (string)$position['id'] ? 'selected' : '' ?>><?= e($position['title']) ?></option><?php endforeach; ?></select></div>
        <div class="col-md-4"><label class="form-label">Status</label><select class="form-select" name="status_id" required><option value="">Select status</option><?php foreach ($statuses as $status): ?><option value="<?= $status['id'] ?>" <?= (string)$employee['status_id'] === (string)$status['id'] ? 'selected' : '' ?>><?= e($status['name']) ?></option><?php endforeach; ?></select></div>
        <div class="col-12"><label class="form-label">Address</label><textarea class="form-control" name="address" rows="3"><?= e($employee['address']) ?></textarea></div>
    </div>
    <div class="card-footer d-flex gap-2 justify-content-end"><a class="btn btn-secondary" href="index.php">Cancel</a><button class="btn btn-primary" type="submit">Save Employee</button></div>
</form>

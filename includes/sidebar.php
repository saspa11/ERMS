<?php $basePath = $basePath ?? ''; $currentPage = $currentPage ?? ''; ?>
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link <?= active_class('dashboard', $currentPage) ?>" href="<?= $basePath ?>dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Management</div>
                            <a class="nav-link <?= active_class('employees', $currentPage) ?>" href="<?= $basePath ?>employees/index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Employees
                            </a>
                            <a class="nav-link <?= active_class('departments', $currentPage) ?>" href="<?= $basePath ?>departments/index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                                Departments
                            </a>
                            <a class="nav-link <?= active_class('reports', $currentPage) ?>" href="<?= $basePath ?>reports/index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-column"></i></div>
                                Reports
                            </a>
                            <div class="sb-sidenav-menu-heading">Integration</div>
                            <a class="nav-link <?= active_class('api', $currentPage) ?>" href="<?= $basePath ?>api/employees.php" target="_blank">
                                <div class="sb-nav-link-icon"><i class="fas fa-code"></i></div>
                                API Data
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?= e(current_user_name()) ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">

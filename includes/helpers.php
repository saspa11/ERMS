<?php
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function active_class(string $page, string $current): string
{
    return $page === $current ? 'active' : '';
}

function redirect_to(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function employee_join_sql(): string
{
    return "
        SELECT employees.*, departments.name AS department_name, positions.title AS position_title,
               employee_statuses.name AS status_name
        FROM employees
        INNER JOIN departments ON employees.department_id = departments.id
        INNER JOIN positions ON employees.position_id = positions.id
        INNER JOIN employee_statuses ON employees.status_id = employee_statuses.id
    ";
}
?>

CREATE DATABASE IF NOT EXISTS erms_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE erms_db;

DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS positions;
DROP TABLE IF EXISTS departments;
DROP TABLE IF EXISTS employee_statuses;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE positions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_positions_department FOREIGN KEY (department_id) REFERENCES departments(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE employee_statuses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_no VARCHAR(30) NOT NULL UNIQUE,
    first_name VARCHAR(80) NOT NULL,
    last_name VARCHAR(80) NOT NULL,
    email VARCHAR(120) NOT NULL,
    phone VARCHAR(40),
    hire_date DATE NOT NULL,
    department_id INT NOT NULL,
    position_id INT NOT NULL,
    status_id INT NOT NULL,
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_employees_department FOREIGN KEY (department_id) REFERENCES departments(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_employees_position FOREIGN KEY (position_id) REFERENCES positions(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_employees_status FOREIGN KEY (status_id) REFERENCES employee_statuses(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

INSERT INTO users (full_name, username, password_hash) VALUES
('System Administrator', 'admin', '$2y$10$WFCcxakFZuDrqrekwsT6dOlxz25pFT34jz5j1zmN8hTNsMdqBhonG');

INSERT INTO departments (name) VALUES
('Human Resources'),
('Information Technology'),
('Finance'),
('Operations');

INSERT INTO positions (department_id, title) VALUES
(1, 'HR Officer'),
(1, 'Recruitment Assistant'),
(2, 'System Administrator'),
(2, 'Web Developer'),
(3, 'Payroll Specialist'),
(3, 'Accounting Staff'),
(4, 'Operations Supervisor'),
(4, 'Logistics Coordinator');

INSERT INTO employee_statuses (name) VALUES
('Active'),
('Inactive'),
('On Leave');

INSERT INTO employees (employee_no, first_name, last_name, email, phone, hire_date, department_id, position_id, status_id, address) VALUES
('EMP-001', 'Maria', 'Santos', 'maria.santos@company.com', '+63 917 111 2233', '2024-01-15', 1, 1, 1, 'Makati City, Metro Manila'),
('EMP-002', 'John', 'Reyes', 'john.reyes@company.com', '+63 918 222 3344', '2023-08-21', 2, 3, 1, 'Quezon City, Metro Manila'),
('EMP-003', 'Ana', 'Cruz', 'ana.cruz@company.com', '+63 919 333 4455', '2022-05-09', 3, 5, 3, 'Pasig City, Metro Manila'),
('EMP-004', 'Carlo', 'Garcia', 'carlo.garcia@company.com', '+63 920 444 5566', '2021-11-03', 4, 7, 2, 'Cavite');


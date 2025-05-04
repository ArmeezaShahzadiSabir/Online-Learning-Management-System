# Student Management System (SMS)

A web-based Student Management System developed using PHP and MySQL. It allows Admins, Employees, and Students to interact with a centralized student database based on their role. The system supports CRUD operations, authentication, and role-based data handling.

## Features

### 🔐 Authentication
- Secure login for Admins, Employees, and Students
- Role-based access to functionalities

### 👥 User Roles
- **Admin**: Can register, update, and delete students; sees all records.
- **Employee**: Can register and manage students; sees students they registered.
- **Student**: Can register themselves; sees only their own record.

### 📋 Student Management
- Add, view, update, and delete student records
- Automatically tracks who registered the student (admin, employee, or self)
- Display student data in a styled Bootstrap table

### 🛠 Technologies Used
- PHP (Core logic)
- MySQL (Database)
- HTML5, CSS3, Bootstrap 4.5 (Frontend UI)
- FontAwesome (Icons)
- jQuery (for some UI interactions)

## Database Schema

### `users` Table
Stores Admins and Employees:
- `id` (int, primary key)
- `username`
- `email`
- `password`
- `role` (admin/employee)

### `student_info` Table
Stores student records:
- `id` (int, primary key)
- `student_name`
- `roll_no`
- `department`
- `marks`
- `email`
- `reg_by` (name of admin/employee or '0' if student self-registered)

## Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-username/student-management-system.git
   cd student-management-system

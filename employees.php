<?php

require "config.php";

use App\Department;
use App\Employee;

$depts = Department::list();

echo "</table>";

if (isset($_GET['dept_no'])) {
    $dept_no = $_GET['dept_no'];
    $emps = Employee::listByDepartment($dept_no);

    echo "<h1>List of Employees</h1>";
    echo "<table>";
    echo "<tr><th>Employee Title</th><th>Employee Name</th><th>Birthday</th><th>Age</th><th>Gender</th><th>Hire Date</th><th>Latest Salary</th><th>Link</th></tr>";

    foreach ($emps as $emp) {
        echo "<tr>";
        echo "<td>{$emp['employee_title']}</td>";
        echo "<td>{$emp['employee_name']}</td>";
        echo "<td>{$emp['birth_date']}</td>";
        echo "<td>{$emp['employee_age']}</td>";
        echo "<td>{$emp['gender']}</td>";
        echo "<td>{$emp['hire_date']}</td>";
        echo "<td>\${$emp['latest_salary']}</td>";
        echo "<td><a href=\"employee_salary.php?emp_no={$emp['emp_no']}\">Salary History</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo '<a href="index.php">Departments</a>';
}
?>

<?php

require "config.php";

use App\Department;
use App\Employee;

$depts = Department::list();
$emps = Employee::listByDepartment('dept_no');

echo "<h1>List of Departments</h1>";
echo "<table>";
echo "<tr><th>Department Number</th><th>Department Name</th><th>Manager Name</th><th>From Date</th><th>To Date</th><th>Number of Years</th><th>Link</th></tr>";

foreach ($depts as $dept) {
    echo "<tr>";
    echo "<td>{$dept['dept_no']}</td>";
    echo "<td>{$dept['dept_name']}</td>";
    echo "<td>{$dept['manager_name']}</td>";
    echo "<td>{$dept['from_date']}</td>";
    echo "<td>{$dept['to_date']}</td>";
    echo "<td>{$dept['num_years']}</td>";
    echo "<td><a href=\"employees.php?dept_no={$dept['dept_no']}\">View Employee</a></td>";
    echo "</tr>";
}

echo "</table>";
?>
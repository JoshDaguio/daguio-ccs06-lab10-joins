<?php

require "config.php";

use App\Department;
use App\Employee;

$depts = Department::list();
$emps = Employee::list();

echo '<h1>List of Employees</h1>';
echo '<h2>Departments:</h2>';
echo '<ul>';
foreach ($depts as $dept) {
    echo '<li>';
    echo "Department Number: {$dept['dept_no']}<br>";
    echo "Department Name: {$dept['dept_name']}<br>";
    echo "Manager Name: {$dept['manager_name']}<br>";
    echo "From Date: {$dept['from_date']}<br>";
    echo "To Date: {$dept['to_date']}<br>";
    echo "Number of Years: {$dept['years']}<br>";
    echo "<a href=\"employees.php?dept_no={$dept['dept_no']}\">View Employees</a>";
    echo '</li>';
}
echo '</ul>';

if (isset($_GET['dept_no'])) {
    $dept_no = $_GET['dept_no'];

    echo "<h2>Employees in Department: $dept_no</h2>";
    echo "<table>";
    echo "<tr><th>Employee Title</th><th>Employee Name</th><th>Birthday</th><th>Age</th><th>Gender</th><th>Hire Date</th><th>Latest Salary</th><th>Link</th></tr>";

    foreach ($emps as $emp) {
        if ($emp['dept_no'] === $dept_no) {
            echo "<tr>";
            echo "<td>{$emp['title']}</td>";
            echo "<td>{$emp['first_name']} {$emp['last_name']}</td>";
            echo "<td>{$emp['birth_date']}</td>";
            echo "<td>{$emp['age']}</td>";
            echo "<td>{$emp['gender']}</td>";
            echo "<td>{$emp['hire_date']}</td>";
            echo "<td>\${$emp['latest_salary']}</td>";
            echo "<td><a href=\"/employee_salary.php?emp_no={$emp['emp_no']}\">View Salary History</a></td>";
            echo "</tr>";
        }
    }

    echo "</table>";
}

?>

</body>
</html>

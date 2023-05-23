<?php

namespace App;

use Exception;

class Employee
{
    public static function listByDepartment($dept_no)
    {
        global $conn;

        try {
            $sql = "SELECT
            t.title AS employee_title,
            CONCAT(e.first_name, ' ', e.last_name) AS employee_name,
            e.birth_date,
            TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) AS employee_age,
            e.gender,
            e.hire_date,
            s.salary AS latest_salary,
            e.emp_no
        FROM
            employees AS e
            JOIN (
                SELECT
                    emp_no,
                    MAX(to_date) AS max_to_date
                FROM
                    titles
                GROUP BY
                    emp_no
            ) AS mt ON e.emp_no = mt.emp_no
            JOIN titles AS t ON e.emp_no = t.emp_no AND mt.max_to_date = t.to_date
            JOIN (
                SELECT
                    emp_no,
                    MAX(to_date) AS max_to_date
                FROM
                    salaries
                GROUP BY
                    emp_no
            ) AS ms ON e.emp_no = ms.emp_no
            JOIN salaries AS s ON e.emp_no = s.emp_no AND ms.max_to_date = s.to_date
            JOIN dept_emp AS de ON e.emp_no = de.emp_no
        WHERE
            de.dept_no = :dept_no
        LIMIT 10";

            $statement = $conn->prepare($sql);
            $statement->bindValue(':dept_no', $dept_no);
            $statement->execute();
            $records = [];

            while ($row = $statement->fetch()) {
                array_push($records, $row);
            }

            return $records;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        return null;
    }
}

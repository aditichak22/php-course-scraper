<!-- 
    Aditi Chakravarthi 
    AXC200021
    CS 6314 Project
 -->
<?php
require_once('config.php'); 

// code called with ajax request in task5.php
// when the select statement returns more than 10 results, only 5 are displayed
// when the select statement returns 10 or fewer results, all are displayed 

if (isset($_POST['term'])) {

    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);

    $sql = "SELECT * FROM courses WHERE courseId LIKE '%{$_POST['term']}%'";
    $statement = $pdo->query($sql);
    $courses = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (count($courses) <= 10) {
        foreach ($courses as $row) {
            echo $row['CourseId'] ." ". $row['CourseTitle'] . '<br>';
        }
    }
    else {
        for ($x = 0; $x < 5; $x++) {
            $row = $courses[$x];
            echo $row['CourseId'] ." ". $row['CourseTitle'] . '<br>';
        }
    }  
}
?>
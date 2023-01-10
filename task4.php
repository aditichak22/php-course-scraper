<!-- 
    Aditi Chakravarthi 
    AXC200021
    CS 6314 Project
 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>#remove {padding: 30px;}
    #add{padding: 30px;}
  </style>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <title>Add/Remove Course</title>
</head>
<body style="background-color: #ebebeb">
<?php
require_once('config.php');
$courseId = $title = $website = $hours = $descr = $preReqAddr = $preReqTitle = "";
// SQL to add course information to the course table through a form 
if (isset($_POST['add'])) {
      $courseId = test_input($_POST["courseId"]);
      $title = test_input($_POST["title"]);
      $website = test_input($_POST["website"]);
      $hours = test_input($_POST["hours"]);
      $descr = test_input($_POST["descr"]);
      $preReqAddr = test_input($_POST["preReqAddr"]);
      $preReqTitle = test_input($_POST["preReqTitle"]);

      $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $sql = "INSERT INTO courses
      (CourseId, CourseAddress, CourseTitle, CourseHours, CourseDescription, 
      CoursePrereqAddress, CoursePrereqTitle) VALUES(:id, :addr, :title, :courseHours, :descr, 
      :prereqAddr, :prereqTitle)";
      $statement = $pdo->prepare($sql); 
      $statement->bindValue(':id', $courseId); 
      $statement->bindValue(':addr', $website); 
      $statement->bindValue(':title', $title); 
      $statement->bindValue(':courseHours', $hours); 
      $statement->bindValue(':descr', $descr); 
      $statement->bindValue(':prereqAddr', $preReqAddr); 
      $statement->bindValue(':prereqTitle', $preReqTitle); 
      $statement->execute();
  }
  function test_input($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // SQL to remove course information given a course id 
  if (isset($_POST['remove'])) {
    $courseId = test_input($_POST["courseId"]);
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $sql = "DELETE FROM courses WHERE courseId = :id";
    $statement = $pdo->prepare($sql); 
    $statement->bindValue(':id', $courseId); 
    $statement->execute();

  }

?>
<div class="col-md-3">
<div id="add">
    <h2>Add a course</h2>

</div>
<form method="post">
Course Id: <input type="text" name="courseId" value="<?php echo $courseId;?>">
  <br><br>
  Course Title: <input type="text" name="title" value="<?php echo $title;?>">
  <br><br>
  Course Website: <input type="text" name="website" value="<?php echo $website;?>">
  <br><br>
  Course Hours: <input type="text" name="hours" value="<?php echo $hours;?>">
  <br><br>
  Course Description: <input type="text" name="descr" value="<?php echo $descr;?>">
  <br><br>
  Prerequisite Website: <input type="text" name="preReqAddr" value="<?php echo $preReqAddr;?>">
  <br><br>
Prerequisite Title: <input type="text" name="preReqTitle" value="<?php echo $preReqTitle;?>">
  <br><br>
  <input type="submit" name="add" value="ADD" class="btn btn-success">  
</form>
</div>

<div class="col-md-3">
<div id="remove">
    <h2>Remove a course</h2>

</div>
<form method="post">
    CourseId: <input type="text" name="courseId" value="<?php echo $courseId;?>">
  <br><br>
  <input type="submit" name="remove" value="REMOVE" class="btn btn-danger"> 
</form>
</div>

</body>
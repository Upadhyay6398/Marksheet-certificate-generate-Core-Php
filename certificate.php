<?php
include("config.php");
include("lib/grading-functions.php");

$id = isset($_GET['id']) ? base64_decode($_GET['id']) : 0;

$id = isset($_GET['id']) ? base64_decode($_GET['id']) : 0;

// Get Cetificate data with course name
$sql = "SELECT 
            m.*, 
            c.course_name, 
            c.course_duration AS course_table_duration
        FROM marksheet m 
        LEFT JOIN course c ON m.course_id = c.id 
        WHERE m.id = :id";

$stmt = $DB->DB->prepare($sql);
$stmt->execute(['id' => $id]);
$certificate= $stmt->fetch();

if (!$certificate) {
    die("Certificate not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Certificate</title>

<style>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* ===== PRINT FIX ONLY ===== */
@page{
  size: A4 landscape;
  margin: 0;
}

@media print{
  body{
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
  }

  main{
    width: 297mm !important;
    height: 210mm !important;
    overflow: hidden !important;
  }
}
</style>
</head>

<body>

<main style="
  background: url('img/bg.jpg') no-repeat center center/cover;
  width: 297mm;
  height: 210mm;
  margin: auto;
">

  <div style="display:flex;flex-direction:column;align-items:center;">

    <div style="text-align:center;margin-top:100px;">
      <img src="img/01.png" style="width:60%;">
    </div>

    <div style="text-align:center;font-family:sans-serif;font-size:46px;font-weight:600;line-height:1;">
      <?= htmlspecialchars($certificate['student_name']) ?>
    </div>

    <div style="text-align:center;font-family:sans-serif;font-size:30px;margin-top:10px;font-weight:600;">
     (Roll No :- <?= htmlspecialchars($certificate['enrolment_number']) ?>)
    </div>

    <div style="text-align:center;font-family:sans-serif;font-size:20px;margin-top:8px;font-weight:400;line-height:1;">
      has successfully completed all the requirements and has earned the credentials of
    </div>

    <div style="
      display:flex;
      align-items:center;
      justify-content:center;
      flex-direction:column;
      margin-top:10px;
      color:#981614;
      font-size:40px;
      line-height:1;
      font-weight:600;
      font-family:sans-serif;
    ">
    <?php if ($certificate['course_table_duration'] == '3 Months'): ?>
      <span style="font-family:'Times New Roman',serif;">Advanced Certificate</span>
      in
    <?php endif; ?>
     <?php if ($certificate['course_table_duration'] == '1 Year'): ?>
         <span style="font-family:'Times New Roman',serif;">Advanced Diploma</span>
         in
     <?php endif; ?>
      <span><?= htmlspecialchars($certificate['course_name']) ?></span>

      <span style="font-size:32px;font-weight:600;font-family:'Times New Roman',serif;margin-top:5px;">
       <?= htmlspecialchars($certificate['term_duration']) ?>
      </span>
<span style="font-size:32px;font-weight:600;font-family:'Times New Roman',serif;margin-top:5px;">
  (<?= htmlspecialchars($certificate['course_table_duration']) ?>)
</span>
    </div>

    <div style="text-align:center;">
      <img src="img/04.png" style="width:50%;">
    </div>

    <div style="text-align:center;padding-bottom:80px;">
      <img src="img/03.png" style="width:58%;">
    </div>

  </div>
</main>
 <script>
    
        window.addEventListener('load', function() {
            setTimeout(function() {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>

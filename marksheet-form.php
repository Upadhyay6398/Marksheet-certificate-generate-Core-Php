<?php
include("config.php");
include("lib/grading-functions.php");

$id = isset($_GET['id']) ? base64_decode($_GET['id']) : 0;

// Get marksheet data with course name
$sql = "SELECT 
            m.*, 
            c.course_name, 
            c.course_duration AS course_table_duration
        FROM marksheet m 
        LEFT JOIN course c ON m.course_id = c.id 
        WHERE m.id = :id";
        
$stmt = $DB->DB->prepare($sql);
$stmt->execute(['id' => $id]);
$marksheet = $stmt->fetch();

if (!$marksheet) {
    die("Marksheet not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statement of Marks - <?= htmlspecialchars($marksheet['student_name']) ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        
        .certificate-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border: 3px solid #052A7F;
            padding: 25px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .header img{
         margin-bottom: 24px;
        }
        
        .logo {
            width: 150px;
            height: auto;
            margin-bottom: 10px;
        }
        
        .institute-name {
            font-size:25px;
            font-weight: bold;
            color: #000;
            margin-bottom: 5px;
        }
        
        .location {
            font-size: 18px;
            color: #000;
            margin-bottom: 20px; 
            font-weight: bold;
        }
        
        .title {
            font-size: 22px;
            font-weight: bold; 
            color: #052A7F;  
            margin: 20px 0;
        }
        
        .student-info {
           margin: 15px 0 30px;
            display: flex;
            justify-content: space-between;
        }
        
        .student-info div {
            font-size: 13px;
        }
        
        .student-name {
            font-weight: bold; 
            font-size: 16px;
            display:block;
            margin-bottom: 12px;
        }
        
        .course-info {
            font-size: 15px;
            margin-bottom: 5px;
        }
        
        .red-text {
            color: red;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 12px 0;
            font-size: 13px;
        }
        
        table th, table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        
        table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        
        .total-row {
            font-weight: bold;
        }
        
        .grading-table {
            width: 50%;
            margin: 10px 0;
            font-size: 13px;
        }
        .footer {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        
        .signature {
            text-align: center;
        }
        
        .signature-line {
            width: 150px;
            border-bottom: 2px solid #000;
            margin-bottom: 5px;
        }
    
        .stamp {
            width: 100px;
            height: 100px;
            border: 2px solid #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            text-align: center;
        }
        
        .no-print {
            text-align: center;
            margin: 20px 0;
        }
        
        @media print {
            @page {
                size: A4;
                margin: 10mm;
            }
            
            body {
                background: white;
                padding: 0;
                margin: 0;
            }
            
            .certificate-container {
                border: 2px solid #000;
                max-width: 100%;
                padding: 15px;
                margin: 0;
                page-break-inside: avoid;
                page-break-after: avoid;
            }
            
            .header {
                margin-bottom: 8px;
            }
            
            .logo {
                width: 110px;
            }
            
            .institute-name {
                font-size: 21px;
                margin-bottom: 2px;
            }
            
            .location {
                font-size: 15px;
                margin-bottom: 10px;
            }
            
            .title {
                margin: 8px 0;
                font-size: 19px;
            }
            
            .student-info {
                margin: 8px 0;
            }
            
            .course-info {
                margin-bottom: 2px;
            }
            
            table {
                margin: 8px 0;
                page-break-inside: avoid;
                font-size: 12px;
            }
            
            table th, table td {
                padding: 5px;
            }
            
            .grading-table {
                margin: 6px 0;
                font-size: 12px;
            }
            
            .footer {
                margin-top: 10px;
            }
            
            .footer img {
                max-width: 150px;
            }
            
            .no-print {
                display: none;
            }
        }
    </style>
    
    <style>
        
@media print {
  .sign-img {
    width: 650px !important;
    height: auto !important;
    object-fit: cover;
    max-width: none !important;
    height: auto !important;
    display: block !important;
  }
}

    </style>
    
</head>
<body>
    <div class="certificate-container">
        <!-- Header Section -->
        <div class="header">
             <img src="https://www.astron.international/images/Logo.png">
            
            <div class="institute-name">ASTRON INSTITUTE OF INTERNATIONAL STUDIES</div>
            <div class="location">Gurgaon, Haryana</div>
        </div>
        
        <div class="title" style="text-align: center;">STATEMENT OF MARKS</div>
        
        <!-- Student Information -->
        <div class="student-info">
            <div>
                <span class="student-name">Name of the student:  <span style="font-size: 19px;"><?= htmlspecialchars($marksheet['student_name']) ?></span>  </span>
                  <div class="course-info">
                      
                      
          <strong>Course: <span style="color:red"><?= htmlspecialchars($marksheet['course_name']) ?></span></strong> 
        </div>
        <div class="course-info red-text">
            <span>(Certificate <?= htmlspecialchars($marksheet['course_table_duration']) ?> Online)</span>
        </div>

                
            </div>
            <div>
                <span style="font-size: 15px; font-weight: 600">Enrolment no.: <?= htmlspecialchars($marksheet['enrolment_number']) ?></span><br>
        <div style="margin: 15px 0 0;">Batch No.: 26</div>
            </div>
           
        </div>
        
       
        
        <!-- Marks Table -->
        <table>
            <thead>
                <tr>
                    <th>ACTIVITIES</th>
                    <th>MAXIMUM<br>MARKS</th>
                    <th>MARKS OBTAINED</th>
                    <th>PERCENTAGE (%)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Term-1</td>
                    <td><?= number_format($marksheet['term_one_max_marks'], 0) ?></td>
                    <td><?= $marksheet['term_one_obtained_marks'] > 0 ? number_format($marksheet['term_one_obtained_marks'], 2) : '-' ?></td>
                    <td><?= $marksheet['term_one_obtained_marks'] > 0 ? number_format($marksheet['term_one_percentage'], 2) . '%' : '-' ?></td>
                </tr>
                <tr>
                    <td>Term-2</td>
                    <td><?= number_format($marksheet['term_two_max_marks'], 0) ?></td>
                    <td><?= $marksheet['term_two_obtained_marks'] > 0 ? number_format($marksheet['term_two_obtained_marks'], 2) : '-' ?></td>
                    <td><?= $marksheet['term_two_obtained_marks'] > 0 ? number_format($marksheet['term_two_percentage'], 2) . '%' : '-' ?></td>
                </tr>
                <tr>
                    <td>Term-3</td>
                    <td><?= number_format($marksheet['term_three_max_marks'], 0) ?></td>
                    <td><?= $marksheet['term_three_obtained_marks'] > 0 ? number_format($marksheet['term_three_obtained_marks'], 2) : '-' ?></td>
                    <td><?= $marksheet['term_three_obtained_marks'] > 0 ? number_format($marksheet['term_three_percentage'], 2) . '%' : '-' ?></td>
                </tr>
                <tr>
                    <td>Project Work</td>
                    <td><?= number_format($marksheet['project_work_max_marks'], 0) ?></td>
                    <td><?= $marksheet['project_work_obtained_marks'] > 0 ? number_format($marksheet['project_work_obtained_marks'], 2) : '-' ?></td>
                    <td><?= $marksheet['project_work_obtained_marks'] > 0 ? number_format($marksheet['project_work_percentage'], 2) . '%' : '-' ?></td>
                </tr>
                <tr>
                    <td>Assignment</td>
                    <td><?= number_format($marksheet['assignment_max_marks'], 0) ?></td>
                    <td><?= $marksheet['assignment_obtained_marks'] > 0 ? number_format($marksheet['assignment_obtained_marks'], 2) : '-' ?></td>
                    <td><?= $marksheet['assignment_obtained_marks'] > 0 ? number_format($marksheet['assignment_percentage'], 2) . '%' : '-' ?></td>
                </tr>
                <tr>
                    <td>Case Study</td>
                    <td><?= number_format($marksheet['case_study_max_marks'], 0) ?></td>
                    <td><?= $marksheet['case_study_obtained_marks'] > 0 ? number_format($marksheet['case_study_obtained_marks'], 2) : '-' ?></td>
                    <td><?= $marksheet['case_study_obtained_marks'] > 0 ? number_format($marksheet['case_study_percentage'], 2) . '%' : '-' ?></td>
                </tr>
                <tr class="total-row">
                    <td>GRAND TOTAL</td>
                    <td><?= number_format($marksheet['total_max_marks'], 0) ?></td>
                    <td><?= number_format($marksheet['total_obtained_marks'], 2) ?></td>
                    <td><?= number_format($marksheet['overall_percentage'], 2) ?>%</td>
                </tr>
            </tbody>
        </table>
        
        <div style="margin: 15px 0; font-size: 13px;">
            <strong>Total Marks: <?= number_format($marksheet['total_obtained_marks'], 2) ?>/<?= number_format($marksheet['total_max_marks'], 0) ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <strong>Grade: <?= $marksheet['grade'] ?></strong>
        </div>  
        
        <!-- Grading Table -->
        <div style="font-weight: bold; font-size: 13px; margin: 10px 0;">GRADING</div>
        <table class="grading-table">
            <tbody>
               <tr>
                   <td colspan="2"><strong>GRADING</strong></td>
                   <td>&nbsp;</td>
               </tr>
                <tr>
                   <td>A</td>
                    <td>>80%- 100%</td>
                    <td>Excellent</td>
                </tr>
                <tr>
                    <td>B</td>
                    <td>>70%–79%</td>
                    <td>Very Good</td>
                </tr>
                <tr>
                    <td>C</td>
                    <td>>60%–69%</td>
                    <td>Good</td>
                </tr>
                <tr>
                    <td>D</td>
                    <td>>50%–59%</td>
                    <td>Satisfactory</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>49 or below</td>
                    <td>Needs Improvement</td>
                </tr>
            </tbody>
        </table>
        
        <!-- Footer with Signatures -->
        <div class="footer">
           <center>   <img src="signature.jpg" class="sign-img"> </center>
             
        </div>
    </div>
    
    <script>
    
        window.addEventListener('load', function() {
            setTimeout(function() {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>


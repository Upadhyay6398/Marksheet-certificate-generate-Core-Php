<?php
ob_start(); 
include("config.php");
include("lock.php");
include("lib/grading-functions.php");

$id = isset($_GET['id']) ? base64_decode($_GET['id']) : 0;

// Get existing marksheet data
$marksheet = $DB->getRowById('marksheet', $id);

// Fetch active courses for dropdown
$sql = "SELECT * FROM course WHERE status = 1 ORDER BY course_name ASC";
$stmt = $DB->DB->prepare($sql);
$stmt->execute();
$courses = $stmt->fetchAll();

if (!$marksheet) {
    $_SESSION['msg'] = "Marksheet not found.";
    $_SESSION['msg_type'] = "error";
    header("Location: manage-marksheet.php");
    exit();
}

if (isset($_POST['Submit'])) {
    $studentName = trim($_POST['studentname']);
    $courseId = trim($_POST['courseName']);
   
    $enrolmentNumber = trim($_POST['enrolment_number']);
 

    $termDuration = trim($_POST['term_duration']);
    
    // Obtained marks
    $termOneObtainedMarks = trim($_POST['term_one_obtained_marks']);
    $termTwoObtainedMarks = trim($_POST['term_two_obtained_marks']);
    $termThreeObtainedMarks = trim($_POST['term_three_obtained_marks']);
    $projectWorkObtainedMarks = trim($_POST['project_work_obtained_marks']);
    $assignmentObtainedMarks = trim($_POST['assignment_obtained_marks']);
    $caseStudyObtainedMarks = trim($_POST['case_study_obtained_marks']);
    
    // Maximum marks (fixed values)
    $termOneMaxMarks = 5;
    $termTwoMaxMarks = 5;
    $termThreeMaxMarks = 5;
    $projectWorkMaxMarks = 15;
    $assignmentMaxMarks = 10;
    $caseStudyMaxMarks = 10;

    // Validation (same as add-marksheet.php)
    if (empty($studentName)) {
        $error = "Please enter student name.";
    } elseif (empty($courseId)) {
        $error = "Please select course name.";
    } elseif (empty($enrolmentNumber)) {
        $error = "Please enter enrolment number.";
    }  elseif (empty($termDuration)) {
        $error = "Please enter term duration.";
    } elseif (!is_numeric($termOneObtainedMarks) || $termOneObtainedMarks < 0 || $termOneObtainedMarks > 5) {
        $error = "Term One marks should be between 0 and 5.";
    } elseif (!is_numeric($termTwoObtainedMarks) || $termTwoObtainedMarks < 0 || $termTwoObtainedMarks > 5) {
        $error = "Term Two marks should be between 0 and 5.";
    } elseif (!is_numeric($termThreeObtainedMarks) || $termThreeObtainedMarks < 0 || $termThreeObtainedMarks > 5) {
        $error = "Term Three marks should be between 0 and 5.";
    } elseif (!is_numeric($projectWorkObtainedMarks) || $projectWorkObtainedMarks < 0 || $projectWorkObtainedMarks > 15) {
        $error = "Project Work marks should be between 0 and 15.";
    } elseif (!is_numeric($assignmentObtainedMarks) || $assignmentObtainedMarks < 0 || $assignmentObtainedMarks > 10) {
        $error = "Assignment marks should be between 0 and 10.";
    } elseif (!is_numeric($caseStudyObtainedMarks) || $caseStudyObtainedMarks < 0 || $caseStudyObtainedMarks > 10) {
        $error = "Case Study marks should be between 0 and 10.";
    }

    if (!empty($error)) {
        $_SESSION['msg'] = $error;
        $_SESSION['msg_type'] = "error";
        header("Location: edit-marksheet.php?id=" . base64_encode($id));
        exit();
    }

    try {
        // Prepare data for calculation with fixed maximum marks
        $marksData = [
            'term_one_obtained_marks' => $termOneObtainedMarks,
            'term_one_max_marks' => 5,
            'term_two_obtained_marks' => $termTwoObtainedMarks,
            'term_two_max_marks' => 5,
            'term_three_obtained_marks' => $termThreeObtainedMarks,
            'term_three_max_marks' => 5,
            'project_work_obtained_marks' => $projectWorkObtainedMarks,
            'project_work_max_marks' => 15,
            'assignment_obtained_marks' => $assignmentObtainedMarks,
            'assignment_max_marks' => 10,
            'case_study_obtained_marks' => $caseStudyObtainedMarks,
            'case_study_max_marks' => 10
        ];
        
        // Calculate percentages and grades
        $calculatedData = calculateMarksheetData($marksData);
        
        // Prepare complete data for update with fixed maximum marks
        $data = [
            'student_name' => $studentName,
            'course_id' => $courseId,
            
            'enrolment_number' => $enrolmentNumber,
            
           
            'term_duration' => $termDuration,
            'term_one_obtained_marks' => $termOneObtainedMarks,
            'term_one_max_marks' => 5,
            'term_one_percentage' => $calculatedData['term_one_percentage'],
            'term_two_obtained_marks' => $termTwoObtainedMarks,
            'term_two_max_marks' => 5,
            'term_two_percentage' => $calculatedData['term_two_percentage'],
            'term_three_obtained_marks' => $termThreeObtainedMarks,
            'term_three_max_marks' => 5,
            'term_three_percentage' => $calculatedData['term_three_percentage'],
            'project_work_obtained_marks' => $projectWorkObtainedMarks,
            'project_work_max_marks' => 15,
            'project_work_percentage' => $calculatedData['project_work_percentage'],
            'assignment_obtained_marks' => $assignmentObtainedMarks,
            'assignment_max_marks' => 10,
            'assignment_percentage' => $calculatedData['assignment_percentage'],
            'case_study_obtained_marks' => $caseStudyObtainedMarks,
            'case_study_max_marks' => 10,
            'case_study_percentage' => $calculatedData['case_study_percentage'],
            'total_obtained_marks' => $calculatedData['total_obtained_marks'],
            'total_max_marks' => 50,
            'overall_percentage' => $calculatedData['overall_percentage'],
            'grade' => $calculatedData['grade'],
            'grade_description' => $calculatedData['grade_description'],
            'updated_date' => date("d-m-Y h:i A")
        ];

        $res = $DB->update('marksheet', $data, $id);

        if ($res) {
            $_SESSION['msg'] = "Marksheet updated successfully!";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['msg'] = "Failed to update marksheet.";
            $_SESSION['msg_type'] = "error";
        }
    } catch (Exception $e) {
        $_SESSION['msg'] = "Error: " . $e->getMessage();
        $_SESSION['msg_type'] = "error";
    }

    header("Location: manage-marksheet.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= DEFAULT_TITLE ?> | Edit Marksheet</title>
    <?php
    include("include/head.php");
    ?>
    <script type="text/javascript" src="assets/widgets/parsley/parsley.js"></script>
</head>

<body>
    <?php
    include("include/header.php");
    include("include/sidebar.php");
    ?>

    <div id="page-content-wrapper">
        <div id="page-content">
            <div id="page-title">
                <h2>Edit Marksheet </h2>
            </div>

            <?php include("include/message.php"); ?>

            <div class="col-md-7">
                <div class="panel">

                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Marksheet</h4>
                    </div>

                    <div class="panel-body">

                        <div class="example-box-wrapper">
                            <form class="form-horizontal bordered-row" id="marksheet-form" method="post" data-parsley-validate="">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Student Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="studentname" required class="form-control" name="studentname" value="<?= htmlspecialchars($marksheet['student_name']) ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Course Name</label>
                                    <div class="col-sm-6">
                                        <select id="courseName" required class="form-control" name="courseName">
                                            <option value="">-- Select Course --</option>
                                            <?php foreach ($courses as $course) { ?>
                                                <option value="<?= $course['id'] ?>" <?= ($course['id'] == $marksheet['course_id']) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($course['course_name']) ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Enrolment Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="enrolment_number" required class="form-control" name="enrolment_number" value="<?= htmlspecialchars($marksheet['enrolment_number']) ?>" />
                                    </div>
                                </div>
                               
                               
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Term Duration</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="term_duration" required class="form-control" name="term_duration" placeholder="e.g., June 2025 - August 2025" value="<?= htmlspecialchars($marksheet['term_duration']) ?>" />
                                        <small class="text-muted">Enter the term period (e.g., June 2025 - August 2025)</small>
                                    </div>
                                </div>
                                <!-- Term One (Fixed: 5 marks) -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Term One (Max: 5)</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="term_one_obtained_marks" required class="form-control" name="term_one_obtained_marks" placeholder="e.g., 2.25, 3.50, 4" pattern="^\d+(\.\d{1,2})?$" value="<?= $marksheet['term_one_obtained_marks'] ?>" />
                                        <small class="text-muted">You can enter decimal values like 2.25, 3.50, 4.75</small>
                                    </div>
                                </div>
                                
                                <!-- Term Two (Fixed: 5 marks) -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Term Two (Max: 5)</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="term_two_obtained_marks" required class="form-control" name="term_two_obtained_marks" placeholder="e.g., 2.25, 3.50, 4" pattern="^\d+(\.\d{1,2})?$" value="<?= $marksheet['term_two_obtained_marks'] ?>" />
                                        <small class="text-muted">You can enter decimal values like 2.25, 3.50, 4.75</small>
                                    </div>
                                </div>
                                
                                <!-- Term Three (Fixed: 5 marks) -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Term Three (Max: 5)</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="term_three_obtained_marks" required class="form-control" name="term_three_obtained_marks" placeholder="e.g., 2.25, 3.50, 4" pattern="^\d+(\.\d{1,2})?$" value="<?= $marksheet['term_three_obtained_marks'] ?>" />
                                        <small class="text-muted">You can enter decimal values like 2.25, 3.50, 4.75</small>
                                    </div>
                                </div>
                                
                                <!-- Project Work (Fixed: 15 marks) -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Project Work (Max: 15)</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="project_work_obtained_marks" required class="form-control" name="project_work_obtained_marks" placeholder="e.g., 10.50, 12.75, 14" pattern="^\d+(\.\d{1,2})?$" value="<?= $marksheet['project_work_obtained_marks'] ?>" />
                                        <small class="text-muted">You can enter decimal values like 10.50, 12.75, 14.25</small>
                                    </div>
                                </div>
                                
                                <!-- Assignment (Fixed: 10 marks) -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Assignment (Max: 10)</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="assignment_obtained_marks" required class="form-control" name="assignment_obtained_marks" placeholder="e.g., 6.50, 7.25, 8" pattern="^\d+(\.\d{1,2})?$" value="<?= $marksheet['assignment_obtained_marks'] ?>" />
                                        <small class="text-muted">You can enter decimal values like 6.50, 7.25, 8.75</small>
                                    </div>
                                </div>
                                
                                <!-- Case Study (Fixed: 10 marks) -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Case Study (Max: 10)</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="case_study_obtained_marks" required class="form-control" name="case_study_obtained_marks" placeholder="e.g., 6.50, 7.25, 8" pattern="^\d+(\.\d{1,2})?$" value="<?= $marksheet['case_study_obtained_marks'] ?>" />
                                        <small class="text-muted">You can enter decimal values like 6.50, 7.25, 8.75</small>
                                    </div>
                                </div>

                                <div class=" text-center pad20A ">
                                    <input type="submit" class="btn btn-success" name="Submit" value="Update Marksheet" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <?php
    include("include/footer-js.php");
    ?>
    <script>
    // Auto-calculate percentages and total marks
    document.addEventListener('DOMContentLoaded', function() {
        const markInputs = document.querySelectorAll('input[type="number"]');
        markInputs.forEach(input => {
            input.addEventListener('input', calculatePercentages);
        });
        
        function calculatePercentages() {
            // Fixed maximum marks as per your requirement
            const maxMarks = {
                'term_one': 5,
                'term_two': 5,
                'term_three': 5,
                'project_work': 15,
                'assignment': 10,
                'case_study': 10
            };
            
            const subjects = Object.keys(maxMarks);
            
            let totalObtained = 0;
            let totalMax = 50; // Total: 5+5+5+15+10+10 = 50
            
            subjects.forEach(subject => {
                const obtained = parseFloat(document.getElementById(subject + '_obtained_marks').value) || 0;
                const max = maxMarks[subject];
                
                if (max > 0) {
                    const percentage = (obtained / max) * 100;
                    console.log(`${subject}: ${obtained}/${max} = ${percentage.toFixed(2)}%`);
                }
                
                totalObtained += obtained;
            });
            
            const overallPercentage = (totalObtained / totalMax) * 100;
            
            console.log(`Total: ${totalObtained}/${totalMax} = ${overallPercentage.toFixed(2)}%`);
            
            // Determine grade
            let grade = 'F';
            let gradeDesc = 'Needs Improvement';
            if (overallPercentage >= 80) {
                grade = 'A';
                gradeDesc = 'Excellent';
            } else if (overallPercentage >= 70) {
                grade = 'B';
                gradeDesc = 'Very Good';
            } else if (overallPercentage >= 60) {
                grade = 'C';
                gradeDesc = 'Good';
            } else if (overallPercentage >= 50) {
                grade = 'D';
                gradeDesc = 'Satisfactory';
            }
            
            console.log(`Grade: ${grade} - ${gradeDesc}`);
        }
    });
    </script>
</body>

</html>

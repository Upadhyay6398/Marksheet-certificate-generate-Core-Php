<?php
include("config.php");
include("lock.php");

if (isset($_POST['Submit'])) {
    $courseName = trim($_POST['course_name']);
    $short_name = trim($_POST['short_name']);
    $course_duration = trim($_POST['course_duration']);
    $status = isset($_POST['status']) ? $_POST['status'] : 1;

    // Validation
    if (empty($courseName)) {
        $error = "Please enter course name.";
    } else {
        // Check if course name already exists
        $existingCourse = $DB->getRow('course', ['course_name' => $courseName]);
        if ($existingCourse) {
            $error = "Course name already exists.";
        }
    }

    if (!empty($error)) {
        $_SESSION['msg'] = $error;
        $_SESSION['msg_type'] = "error";
        header("Location: add-course.php");
        exit();
    }

    $tstp = date("d-m-Y h:i A");

    try {
        $data = [
            'course_name' => $courseName,
            'short_name' => $short_name,
            'course_duration' => $course_duration,
            'status' => $status,
            'created_date' => $tstp
        ];

        $res = $DB->insert('course', $data);

        if ($res) {
            $_SESSION['msg'] = "Course added successfully!";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['msg'] = "Failed to add course.";
            $_SESSION['msg_type'] = "error";
        }
    } catch (Exception $e) {
        $_SESSION['msg'] = "Error: " . $e->getMessage();
        $_SESSION['msg_type'] = "error";
    }

    header("Location: manage-course.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= DEFAULT_TITLE ?> | Add Course</title>
    <?php include("include/head.php"); ?>
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
                <h2>Add Course</h2>
            </div>

            <?php include("include/message.php"); ?>

            <div class="col-md-7">
                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">Add New Course</h4>
                    </div>

                    <div class="panel-body">
                        <div class="example-box-wrapper">
                            <form class="form-horizontal bordered-row" id="course-form" method="post" data-parsley-validate="">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Course Full Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="course_name" required class="form-control" name="course_name" placeholder="e.g., Computer Science, Information Technology" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Course Short Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="short_name" required class="form-control" name="short_name" placeholder="e.g., C S,IT" />
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Course Duration</label>
                                    <div class="col-sm-6">
                                       <select class="form-control" required id="course_duration" name="course_duration">
                                        <option value="3 Months">3 Months</option>
                                        <option value="1 Year">1 Year</option>
                                       </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" required id="status" name="status">
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class=" text-center pad20A ">
                                    <input type="submit" class="btn btn-success" name="Submit" value="Add Course" />
                                    <a href="manage-course.php" class="btn btn-default">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("include/footer-js.php"); ?>
</body>

</html>
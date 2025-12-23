<?php
include("config.php");
include("lock.php");

$id = isset($_GET['id']) ? base64_decode($_GET['id']) : 0;

// Get existing course data
$course = $DB->getRowById('course', $id);

if (!$course) {
    $_SESSION['msg'] = "Course not found.";
    $_SESSION['msg_type'] = "error";
    header("Location: manage-course.php");
    exit();
}

if (isset($_POST['Submit'])) {
    $courseName = trim($_POST['course_name']);
    $short_name=trim($_POST['short_name']);
    $course_duration =trim($_POST['course_duration']);
    $status = isset($_POST['status']) ? $_POST['status'] : 1;

    // Validation
    if (empty($courseName)) {
        $error = "Please enter course name.";
    } else {
        // Check if course name already exists (excluding current course)
        $sql = "SELECT * FROM course WHERE course_name = :course_name AND id != :id";
        $stmt = $DB->DB->prepare($sql);
        $stmt->execute(['course_name' => $courseName, 'id' => $id]);
        $existingCourse = $stmt->fetch();

        if ($existingCourse) {
            $error = "Course name already exists.";
        }
    }

    if (!empty($error)) {
        $_SESSION['msg'] = $error;
        $_SESSION['msg_type'] = "error";
        header("Location: edit-course.php?id=" . base64_encode($id));
        exit();
    }

    try {
        $data = [
            'course_name' => $courseName,
            'status' => $status,
            'short_name'=>$short_name,
            'course_duration'=>$course_duration,
            'updated_date' => date("d-m-Y h:i A")
        ];

        $res = $DB->update('course', $data, $id);

        if ($res) {
            $_SESSION['msg'] = "Course updated successfully!";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['msg'] = "Failed to update course.";
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
    <title><?= DEFAULT_TITLE ?> | Edit Course</title>
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
                <h2>Edit Course</h2>
            </div>

            <?php include("include/message.php"); ?>

            <div class="col-md-7">
                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Course</h4>
                    </div>

                    <div class="panel-body">
                        <div class="example-box-wrapper">
                            <form class="form-horizontal bordered-row" id="course-form" method="post" data-parsley-validate="">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Course Full Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="course_name" required class="form-control" name="course_name" value="<?= htmlspecialchars($course['course_name']) ?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Course Short Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="short_name" required class="form-control" name="short_name" value="<?= htmlspecialchars($course['short_name']) ?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Course Duration</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" required id="course_duration" name="course_duration">
                                            <option value="3 Months" <?= ($course['course_duration'] == '3 Months') ? 'selected' : '' ?>>
                                                3 Months
                                            </option>
                                            <option value="1 Year" <?= ($course['course_duration'] == '1 Year') ? 'selected' : '' ?>>
                                                1 Year
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" required id="status" name="status">
                                            <option value="1" <?= $course['status'] == 1 ? 'selected' : '' ?>>Active</option>
                                            <option value="0" <?= $course['status'] == 0 ? 'selected' : '' ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class=" text-center pad20A ">
                                    <input type="submit" class="btn btn-success" name="Submit" value="Update Course" />
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
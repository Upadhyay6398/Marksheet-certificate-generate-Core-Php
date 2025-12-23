<?php
require("config.php");
require("lib/Pager.php");
include("lib/grading-functions.php");

$where = [];
$sql_count = "SELECT count(*) as total FROM `marksheet` WHERE 1=1 ";
$stmt      = $DB->DB->prepare($sql_count);
$stmt->execute($where);
$total     = $stmt->fetchColumn();


$page  = isset($_GET['page']) ? intval($_GET['page']) : 1;

$page  = ($page > 0 ? $page : 1);

$pager = new Pager();
$pager->setTotalPage($total);
$pager->setLimit(50);
$pager->setPage($page);

$where['start'] = $pager->getStart();
$where['limit'] = $pager->getLimit();

$sql   = "SELECT m.*, c.course_name FROM `marksheet` m 
          LEFT JOIN `course` c ON m.course_id = c.id 
          WHERE 1=1 ORDER BY m.id DESC LIMIT :start,:limit";
$stmt  = $DB->DB->prepare($sql);
$stmt->execute($where);
$rows = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include("include/head.php"); ?>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <script type="text/javascript" src="<?= BASE_URL ?>assets/widgets/parsley/parsley.js"></script>
   <style>
      .big_btn {
         width: 150px;
      }
   </style>
   <?php include("form/add-btn-hover-css.php"); ?>
</head>

<body>
   <?php include("include/header-include.php"); ?>
   <?php include("include/header.php"); ?>
   <?php include("include/sidebar.php"); ?>

   <div id="page-content-wrapper">
      <div id="page-content">
         <div class="container">
            <!--=========== Data table js ======-->
            <?php include("form/datatable-js-simple.php"); ?>

            <!--======*********======= page title div==***********==-->
            <div id="page-title">
               <h2>Manage Marksheet</h2>
            </div>
            <!--=========*************= End====**********===========-->
                        <?php
            if (isset($_SESSION['msg'])) {
                $alertType = ($_SESSION['msg_type'] == "success") ? "alert-success" : "alert-danger";
                echo "<div class='alert $alertType'>" . $_SESSION['msg'] . "</div>";
                unset($_SESSION['msg']);
                unset($_SESSION['msg_type']);
            }
            ?>

            <div class="row">
               <div class="col-md-12">
                  <div class="panel">
                     <div class="panel-heading">
                        <h4 class="panel-title">Manage Marksheet</h4>
                     </div>
                     <div class="panel-body">
                        <div class="example-box-wrapper">
        
                  
                           <table id="datatable-tabletoolsw" class="table table-striped table-bordered" cellspacing="0" width="100%">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Student Name</th>
                                    <th>Course Name</th>
                                    <th>Enrolment Number</th>
                                    
                                    <th>Total Marks</th>
                                    <th>Percentage</th>
                                    <th>Grade</th>
                                    <th>Download Marksheet</th>
                                     <th>Download Certificate</th>
                                    <th>Created Date</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                 </tr>
                              </thead>

                              <tbody>
                                 <?php
                                 $i = $pager->getStart() + 1;
                                 foreach ($rows as $row) {
                                 ?>
                                    <tr>
                                       <td><?= $i; $i++ ?></td>
                                       <td><?= htmlspecialchars($row['student_name']) ?></td>
                                       <td><?= htmlspecialchars($row['course_name']) ?></td>
                                       <td><?= htmlspecialchars($row['enrolment_number']) ?></td>
                                       <td><?= number_format($row['total_obtained_marks'], 2) ?>/<?= number_format($row['total_max_marks'], 2) ?></td>
                                       <td><?= formatPercentage($row['overall_percentage']) ?></td>
                                       <td>
                                          <span class="<?= getGradeColorClass($row['grade']) ?>">
                                             <strong><?= $row['grade'] ?></strong> - <?= $row['grade_description'] ?>
                                          </span>
                                       </td>
                                       <td> <a href="<?= BASE_URL ?>marksheet-form.php?id=<?=base64_encode($row['id'])?>" class="btn btn-danger "style="background:#5F5F5F">Download</a></td>

                                        <td> <a href="<?= BASE_URL ?>certificate.php?id=<?=base64_encode($row['id'])?>" class="btn btn-danger "style="background:#5F5F5F">Download</a></td>

                                       <td><?= $row['created_date'] ?></td>
                                       <td>
                                       <a href="edit-marksheet.php?id=<?=base64_encode($row['id'])?>" 
                                       onclick="return confirm('Are you sure you want to update this marksheet?');">
                                        Update
                                     </a>
                                       </td>
                                       <td>
                                       <a href="delete-marksheet.php?id=<?=base64_encode($row['id'])?>" 
                                       onclick="return confirm('Are you sure you want to delete this marksheet?');">
                                        Delete
                                     </a>
                                       </td>

                                    </tr>
                                 <?php
                                 }
                                 ?>
                              </tbody>
                              
                           </table>
                           <a href="add-student-marksheet.php">
                            <button class="btn btn-primary mb-3 panel-title" style="float: right;">
                         <i class="fa fa-plus" aria-hidden="true"></i> Add Marksheet
                             </button>
                             </a>
                           <?php echo $pager->getPagination() ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php include("include/footer-js.php"); ?>
</body>

</html>
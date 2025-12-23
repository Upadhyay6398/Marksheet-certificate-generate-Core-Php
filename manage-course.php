<?php
require("config.php");
require("lib/Pager.php");

$where = [];
$sql_count = "SELECT count(*) as total FROM `course` WHERE 1=1 ";
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

$sql   = "SELECT * FROM `course` WHERE 1=1 ORDER BY id DESC LIMIT :start,:limit";
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
   <?php include("form/add-btn-hover-css.php"); ?>
</head>

<body>
   <?php include("include/header-include.php"); ?>
   <?php include("include/header.php"); ?>
   <?php include("include/sidebar.php"); ?>

   <div id="page-content-wrapper">
      <div id="page-content">
         <div class="container">
            <?php include("form/datatable-js-simple.php"); ?>

            <div id="page-title">
               <h2>Manage Courses</h2>
            </div>

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
                        <h4 class="panel-title">Manage Courses</h4>
                     </div>
                     <div class="panel-body">
                        <div class="example-box-wrapper">
                           <table id="datatable-tabletoolsw" class="table table-striped table-bordered" cellspacing="0" width="100%">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Course Full Name</th>
                                    <th>Course Short Name</th>
                                    <th>Course Duration</th>
                                    <th>Status</th>
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
                                       <td><?= htmlspecialchars($row['course_name']) ?></td>
                                        <td><?= htmlspecialchars($row['short_name']) ?></td>
                                         <td><?= htmlspecialchars($row['course_duration']) ?></td>
                                       <td><?= ($row['status'] == 1 ? '<span class="text-success">Active</span>' : '<span class="text-danger">Inactive</span>') ?></td>
                                       <td><?= $row['created_date'] ?></td>
                                       <td>
                                       <a href="edit-course.php?id=<?=base64_encode($row['id'])?>" 
                                       onclick="return confirm('Are you sure you want to update this course?');">
                                        Update
                                     </a>
                                       </td>
                                       <td>
                                       <a href="delete-course.php?id=<?=base64_encode($row['id'])?>" 
                                       onclick="return confirm('Are you sure you want to delete this course?');">
                                        Delete
                                     </a>
                                       </td>
                                    </tr>
                                 <?php
                                 }
                                 ?>
                              </tbody>
                              
                           </table>
                           <a href="add-course.php">
                            <button class="btn btn-primary mb-3 panel-title" style="float: right;">
                         <i class="fa fa-plus" aria-hidden="true"></i> Add Course
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

<?php 
include("config.php"); 
include("lock.php");  

$category_id  = cleanId($_GET['id']); 
$category     = $DB->getRowById('category', $category_id); 

if (empty($category['id'])) { 
    $_SESSION['msg'] = "Category not found."; 
    header("Location: manage-category.php"); 
    exit();
}  
function generateSlug($string) {
    $string = strtolower(trim($string));
    $string = preg_replace('/[^a-z0-9-]/', '-', $string);
    $string = preg_replace('/-+/', '-', $string);
    return rtrim($string, '-');
}

if (isset($_POST['Submit'])) { 
    $name             = ($_POST['name']); 
    $description       = ($_POST['description']); 
    $meta_title       = ($_POST['meta_title']); 
    $meta_description = ($_POST['meta_description']); 
    $meta_keyword     = ($_POST['meta_keyword']); 
    $status           = ($_POST['status']); 
    $image            = $category['image'];   
    $show_home_page = isset($_POST['show_home_page']) ? 1 : 0;
    $middleimage            = $category['middleimage'];  
    $slug             = generateSlug($name);  
    $error            = "";  

    // Validations  
    if (empty($name)) { 
        $error = "Please enter a name."; 
    } elseif (empty($meta_title)) { 
        $error = "Please enter a Meta title."; 
    } elseif (empty($meta_description)) { 
        $error = "Please enter a Meta Description."; 
    } elseif (empty($meta_keyword)) { 
        $error = "Please enter a Meta Keyword."; 
    }
    elseif (empty($description)) { 
        $error = "Please enter Description."; 
    }
     elseif (!empty($_FILES['image']['name'])) { 
        
        $ext_image = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));  

        if (!in_array($ext_image, ['png', 'jpg', 'jpeg'])) { 
            $error = "Only PNG, JPG, and JPEG images are allowed."; 
        } elseif ($_FILES['image']['size'] > 3000000) { 
            $error = "Maximum image size allowed is 3MB."; 
        } else { 
            $upload_dir = "uploads/";  
            if (!is_dir($upload_dir)) { 
                mkdir($upload_dir, 0777, true);  
            } 

            $image = $upload_dir . time() . "_" . basename($_FILES['image']['name']);  

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $image)) { 
                $error = "Failed to upload image."; 
            } 
        } 
    }  
       // Middle  Image
       if (!empty($_FILES['middleimage']['name'])) {
        $ext_image = strtolower(pathinfo($_FILES['middleimage']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext_image, ['png', 'jpg', 'jpeg'])) {
            $error = "Only PNG, JPG, JPEG images are allowed.";
        } elseif ($_FILES['middleimage']['size'] > 300000) {
            $error = "Maximum middleimage size allowed is 300KB.";
        } else {
            $middleimage = "uploads/" . time() . "_" . basename($_FILES['middleimage']['name']);
            if (!move_uploaded_file($_FILES['middleimage']['tmp_name'], $middleimage)) {
                $error = "Failed to upload middleimage.";
            }
        }
    }

    if (!empty($error)) { 
        $_SESSION['msg'] = $error; 
        $_SESSION['msg_type'] = "error"; 
        header("Location: edit-category.php?id=$category_id"); 
        exit(); 
    }  

    $tstp = date("d-m-y h:i:s A"); 

    try { 
        $data = [ 
            'name'             => $name, 
            'slug'             => $slug, 
            'meta_title'       => $meta_title, 
            'meta_description' => $meta_description, 
            'meta_keyword'     => $meta_keyword, 
            'image'            => $image, 
            'description'      => $description,
        'show_home_page'            => $show_home_page,
            'middleimage'      => $middleimage, 
            'status'           => $status
           
        ]; 
        
        $res = $DB->update('category', $data, $category_id); 

        if ($res) { 
            $_SESSION['msg'] = "Category updated successfully!"; 
            $_SESSION['msg_type'] = "success"; 
        } else { 
            $_SESSION['msg'] = "Failed to update category."; 
            $_SESSION['msg_type'] = "error"; 
        } 
    } catch (Exception $e) { 
        $_SESSION['msg'] = "Error: " . $e->getMessage(); 
        $_SESSION['msg_type'] = "error"; 
    }  

    header("Location: edit-category.php?id=$category_id");
    exit();
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= DEFAULT_TITLE ?> | Add Category</title>
    <?php
    include("include/head.php");
    ?>


</head>

<body>
    <?php
    include("include/header.php");
    include("include/sidebar.php");
    ?>
    <div id="page-content-wrapper">
        <div id="page-content">
            <div id="page-title">
                <h2>Update Category </h2>
            </div>

            <?php include("include/message.php"); ?>

            <div class="col-md-7">
                <div class="panel">

                    <div class="panel-heading">
                        <h4 class="panel-title">Update category</h4>
                    </div>

                    <div class="panel-body">

                        <div class="example-box-wrapper">
                            <form class="form-horizontal bordered-row" enctype="multipart/form-data" id="change-laverage-form" method="post" data-parsley-validate="">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Category name</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="name" required class="form-control" name="name" value="<?= $category['name'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Category Image</label>
                                    <div class="col-sm-6">
                                        <input type="file" id="image" class="form-control" name="image" />
                                        <?php if (!empty($category['image'])): ?>
                                       <img src="<?= BASE_URL . $category['image']; ?>" alt="Category Image" width="100" height="100"><br>
                                       <a href="<?= BASE_URL . $category['image']; ?>" target="_blank">View </a>
                                       <?php else: ?>
                                        <br>
                                                <strong><p>No Image available</p></strong>
                                                 <?php endif; ?>
                                       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Middle Image</label>
                                    <div class="col-sm-6">
                                        <input type="file" id="middleimage" class="form-control" name="middleimage" />
                                        <?php if (!empty($category['middleimage'])): ?>
                                       <img src="<?= BASE_URL . $category['middleimage']; ?>" alt="Middle Image" width="100" height="100"><br>
                                       <a href="<?= BASE_URL . $category['middleimage']; ?>" target="_blank">View </a>
                                       <?php else: ?>
                                        <br>
                                                <strong><p>No Image available</p></strong>
                                                 <?php endif; ?>
                                       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Description</label>
                                    <div class="col-sm-6">
                                        <textarea type="text" id="editor1" class="form-control" name="description"><?=$category['description'];?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Meta title</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="metatitle" class="form-control" name="meta_title" value="<?= $category['meta_title'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Meta Description</label>
                                    <div class="col-sm-6">
                                        <textarea type="text" id="editor2" class="form-control" name="meta_description"><?=$category['meta_description'];?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Meta Keyword</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="metakeyword" class="form-control" name="meta_keyword" value="<?=$category['meta_keyword'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" required id="status" name="status">
                                        <option value="1" <?= ($category['status'] == 1 ? $selected : '') ?>>Enable</option>
                                        <option value="2" <?= ($category['status'] == 2 ? $selected : '') ?>>Disable</option>
                                        </select>
                                    </div>
                                </div>
                          
<div class="form-group">
                                    <label class="col-sm-3 control-label">Show on Home Page</label>
 <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="show_home_page"
<?= ($category['show_home_page'] == 1 ? 'checked' : '') ?>>

  
</div>
                                <div class=" text-center pad20A ">
                                    <input type="submit" class="btn btn-success" name="Submit" value="Confirm" />
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
<script src="tinymce/js/tinymce/tinymce.min.js"></script>
    <script>
  tinymce.init({
    selector: '#editor',
    plugins: 'code',
    toolbar: 'code',
    valid_elements: '*[*]',
    extended_valid_elements: 'div[*],script[*],iframe[*]'
  });
  
    tinymce.init({
    selector: '#editor1',
    plugins: 'code',
    toolbar: 'code',
    valid_elements: '*[*]',
    extended_valid_elements: 'div[*],script[*],iframe[*]'
  });
  
   tinymce.init({
    selector: '#editor2',
    plugins: 'code',
    toolbar: 'code',
    valid_elements: '*[*]',
    extended_valid_elements: 'div[*],script[*],iframe[*]'
  });
  
  tinymce.init({
    selector: '#editor3',
    plugins: 'code',
    toolbar: 'code',
    valid_elements: '*[*]',
    extended_valid_elements: 'div[*],script[*],iframe[*]'
  });
  
  tinymce.init({
    selector: '#editor4',
    plugins: 'code',
    toolbar: 'code',
    valid_elements: '*[*]',
    extended_valid_elements: 'div[*],script[*],iframe[*]'
  });
</script>



</body>

</html>
<!-- Blog create form -->
 <?php
 
    // Category get
    $stmt= $db->prepare("SELECT * FROM categories");
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Create category
 $titleErr = '';
 $contentErr = '';
 $imageErr = '';
 $categoryErr = '';

   if(isset($_POST['blogCreateBtn'])){
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user']->id;
    $created_at = date('Y-m-d H:m:s');

    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageType = $_FILES['image']['type'];
    
    if($title === ''){
        $titleErr = "The title field is required";
    } elseif($category_id === ''){
        $categoryErr = 'The category id field is required';
    } elseif($content === ''){
        $contentErr  = "The content field is required";
    } elseif($imageName === '') {
        $imageErr = "The image field is required";
    } else{
            $imageName=uniqid().'_'.$imageName;
            
        if(in_array($imageType,['image/png','image/jpg','image/jpeg'])){
        move_uploaded_file($imageTmpName, "../assets/blog-images/$imageName");
    }

    $stmt = $db->prepare("INSERT INTO blogs(title, category_id, content, image, user_id, created_at) VALUES ('$title','$category_id','$content','$imageName','$user_id','$created_at')");
    $result = $stmt->execute();
    if($result){
        echo "<script>sweetAlert('successfully created a blog','blogs')</script>";
    }
    }

    
   }
?>

<!-- Category Create Form -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Blog Create Form</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">Form</h1> -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex align-items-center justify-content-between ">
                            <h6 class="m-0 font-weight-bold text-primary">Blog Creation Form</h6>
                            <a href="index.php?page=blogs" class="btn btn-primary btn-sm"> <i class="fas fa-angle-double-left"></i> Back </a></a>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="mb-2">
                                    <label for="">Title</label>
                                    <input type="text" name="title" class="form-control">
                                    <span class="text-danger"><?php echo $titleErr; ?></span>
                                </div>
                                <div class="mb-2">
                                    <label for="">Category</label>
                                    <select name="category_id" class="form-control" id="">
                                        <option value="">Select Category</option>
                                        <?php foreach($categories as $category): ?>
                                        <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="text-danger"><?php echo $categoryErr ?></span>
                                </div>
                                <div class="mb-2">
                                    <label for="">Content</label>
                                    <textarea name="content" id="" rows="10" class="form-control"></textarea>
                                    <span class="text-danger"><?php echo $contentErr; ?></span>
                                </div>
                                <div class="mb-2">
                                    <label for="">Image</label>
                                    <input type="file" name="image" value="" class="form-control">
                                    <span class="text-danger"><?php echo $imageErr; ?></span>
                                </div>
                                
                                
                                <button name = "blogCreateBtn" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>

                </div>
    </div>
</div>
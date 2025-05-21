<?php

    // Get old category
    $categoryID = $_GET['category_id'];
    $stmt = $db->prepare("SELECT * FROM categories WHERE id='$categoryID'");
    $stmt->execute();
    $category = $stmt->fetchObject();

    // Update category
    $nameErr = '';
    if(isset($_POST['categoryUpdateBtn'])){
        $name = $_POST['name'];
        if($name === ''){
            $nameErr = "The name field is required";
        }
        else{
            $stmt = $db->prepare("UPDATE categories SET name = '$name' WHERE id='$categoryID'");
            $stmt->execute();
            echo "<script>sweetAlert('successfully created a category','categories')</script>";
        }
        
    }
?>

<!-- Category Edit Form -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Category Edit Form</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">Form</h1> -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex align-items-center justify-content-between ">
                            <h6 class="m-0 font-weight-bold text-primary">Category Edit Form</h6>
                            <a href="index.php?page=categories" class="btn btn-primary btn-sm"><i class="fas fa-angle-double-left"></i>Back </a></a>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="mb-2">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $category->name ?>">
                                    <span class="text-danger"><?php echo $nameErr ?></span>
                                </div>
                                
                                <button name = "categoryUpdateBtn" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>

                </div>
    </div>
</div>
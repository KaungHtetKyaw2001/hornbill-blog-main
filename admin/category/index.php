<?php
    // Select categories

    $stmt = $db->prepare("SELECT * FROM categories");
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Delete category
    if(isset($_POST['categoryDeleteBtn'])){
        
        $categoryId = $_POST['category_id'];
        
        $stmt = $db->prepare("DELETE FROM categories WHERE id=$categoryId");
        $stmt->execute();
        echo "<script>sweetAlert('successfully created a category','categories')</script>";
    }
?>

<!-- Category List -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex align-items-center justify-content-between ">
                            <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                            <a href="index.php?page=categories-create" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Actions</th>                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                            foreach($categories as $category):
                                        ?>
                                            <tr>
                                            <td><?php echo $category->id?></td>
                                            <td><?php echo $category->name?></td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="category_id" value="<?php echo $category->id ?>">
                                                <a href="index.php?page=categories-edit&category_id=<?php echo $category->id; ?>" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a>
                                                <button name="categoryDeleteBtn" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                                
                                            </td>
                                            </tr>
                                        <?php
                                            endforeach;
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
</div>
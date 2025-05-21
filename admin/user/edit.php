<!-- User edit -->
 <?php
    // Get old User
    $userId = $_GET['user_id'];
    $stmt = $db->prepare("SELECT * FROM users WHERE id='$userId'");
    $stmt->execute();
    $user = $stmt->fetchObject();
    
    // Update User
    $nameErr = '';
    $emailErr = '';
    $passwordErr = '';
    if(isset($_POST['userUpdateBtn'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $password = $_POST['password'];
        if($name === ''){
            $nameErr = 'This field is required';
        }
        elseif($email === ''){
            $emailErr = 'This field is required';
        }
        else{
            if($password === ''){
                $stmt = $db->prepare("UPDATE users SET name='$name', email='$email', role='$role' WHERE id='$userId'");
            }
            else{
                $password = md5($password);
                $stmt = $db->prepare("UPDATE users SET name='$name', email='$email', password='$password', role='$role' WHERE id='$userId'");
            }
            $result = $stmt->execute();
            if($result){
                echo "<script>sweetAlert('successfully updated a user','users')</script>";
            }

        }
        
        
    }
?>

<!-- Category Create Form -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Edit Form</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">Form</h1> -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex align-items-center justify-content-between ">
                            <h6 class="m-0 font-weight-bold text-primary">User Edit Form</h6>
                            <a href="index.php?page=users" class="btn btn-primary btn-sm"> <i class="fas fa-angle-double-left"></i> Back </a></a>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="mb-2">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="<?php echo $user->name ?>" class="form-control">
                                    <span class="text-danger"><?php echo $nameErr; ?></span>
                                </div>
                                <div class="mb-2">
                                    <label for="">Email</label>
                                    <input type="text" name="email" class="form-control" value="<?php echo $user->email ?>">
                                    <span class="text-danger"><?php echo $emailErr; ?></span>
                                </div>
                                <div class="mb-2">
                                    <label for="">Role</label>
                                    <select name="role" id="" class="form-control">
                                        <option value="Admin"
                                        <?php if($user->role === 'Admin'):?>
                                            selected
                                        <?php endif; ?>
                                        >Admin</option>
                                        <option value="User"
                                        <?php if($user->role === 'User'):?>
                                            selected
                                        <?php endif; ?>
                                        >User</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="">Password</label>
                                    <input type="checkbox" onclick="showPasswordInput()" id="checkbox">
                                    <input type="password" name="password" id="password-input" class="form-control"  style="display:none;">
                                    <span class="text-danger"><?php echo $passwordErr; ?></span>
                                </div>
                                
                                <button name = "userUpdateBtn" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>

                </div>
    </div>
</div>

<script>
    function showPasswordInput(){
        let checkbox = document.getElementById('checkbox');
        let passwordInput = document.getElementById('password-input');
        if(checkbox.checked){
            passwordInput.style.display = 'block';
        }
        else{
            passwordInput.style.display = 'none';
        }
        
    }
</script>
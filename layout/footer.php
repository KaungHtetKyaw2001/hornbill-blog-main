<?php
    // Register
    if(isset($_POST['userSignUpBtn'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if($name !== '' and $email !== '' and $password !== ''){
                $password = md5($password);
                $stmt = $db->prepare("INSERT INTO users(name, email, password, role) VALUES ('$name','$email','$password','User')");
                $result = $stmt->execute();
            if($result){
                echo "<script>sweetAlert('signed up','index.php')</script>";
            }
        }    
    }

    // Login
    if(isset($_POST['signInBtn']))
    {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        
        $stmt = $db->prepare("SELECT * FROM users WHERE email='$email' AND password='$password' ");
        $stmt->execute();
        $user = $stmt->fetchObject();
        
        if($user){
            $_SESSION['user'] = $user;
            if($user->role === 'Admin'){
                echo "<script>sweetAlert('signed in. Welcome!','admin/index.php')</script>";
            }
            else{
                echo "<script>sweetAlert('signed in. Welcome!','index.php')</script>";
            }
        }else{
?>
        <script>
        
            Swal.fire({
                title: 'Sorry!',
                text: 'Invalid email or password. Please try again! ',
                icon: 'error',
                confirmButtonText: 'Ok'
            }).then(function(){
                location.href = 'index.php'
            })
        
    </script>
<?php
        }
    }
?>


<!-- footer -->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" id="footer-wave"><path fill="#6366f1" fill-opacity="1" d="M0,32L48,37.3C96,43,192,53,288,90.7C384,128,480,192,576,192C672,192,768,128,864,117.3C960,107,1056,149,1152,149.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
    <footer id="footer" class="d-flex justify-content-center align-items-center">
        <div class="container" >
            <div>&copy; 2023 Hornbill Technology, Inc. All rights reserved.</div>
        </div>
    </footer>

    <!-- sign up  -->
    <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="signUp" aria-labelledby="signUpLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="signUpLabel">Sign Up</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div class="">
            <form action="" method="post">
                <div class="mb-2">
                    <input type="text" name="name" class="form-control" placeholder="name" required>
                </div>
                <div class="mb-2">
                    <input type="email" name="email" class="form-control" placeholder="email" required>
                </div>
                <div class="mb-2">
                    <input type="password" name="password" class="form-control" placeholder="password" required>
                </div>
                <button type="submit" name="userSignUpBtn" class="btn">Sign Up</button>
            </form>
          </div>
        </div>
    </div>

    <!-- sign in  -->
    <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="signIn" aria-labelledby="signInLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="signInLabel">Sign In</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div class="">
            <form action="" method="post">
                <div class="mb-2">
                    <input type="email" name="email" class="form-control" placeholder="email" required>
                </div>
                <div class="mb-2">
                    <input type="password" name="password" class="form-control" placeholder="password" required>
                </div>
                <button type="submit" name="signInBtn" class="btn">Sign In</button>
            </form>
            <a href="#signUp" data-bs-toggle="offcanvas" aria-controls="staticBackdrop" class="d-block my-5">No account yet? Sign Up here!</a>
          </div>
        </div>
    </div>
    
    <!-- bootstrap cdn  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- aos  -->
    <script src="assets/aos/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
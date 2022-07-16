<?php include 'process/db.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <title>Login | Attendance Management System</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <div class="login">
        <?php
        if (isset($_POST['login'])) {
            $login_email = $_POST['login_email'];
            $login_password = md5($_POST['login_password']);

            $search_query = "SELECT * FROM users WHERE email = '$login_email' AND password ='$login_password'";
            $search_result = mysqli_query($conn, $search_query);
            $search_count = mysqli_num_rows($search_result);
            if ($search_count == 1) {
                echo header("Location: dashboard.php");
            } else {
        ?>
                <form class="form" action="#" method="POST" enctype="multipart/form-data">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Incorrect Credentials</strong>
                    </div>

                    <script>
                        $(".alert").alert();
                    </script>
            <?php
            }
        }
            ?>
            <div class="form">
            <form action="#" method="POST" enctype="multipart/form-data">
            <input class="field list_items text-center text-success" name="login_email" type="email" placeholder="Enter your email">
            <input class="field list_items text-center text-success" name="login_password" type="password" placeholder="Enter your password">
            <div class="submit">
                <button type="submit" name="login" class="btn btn-primary mx-1">Login</button>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-success" data-toggle="modal" data-target="#modelId">
                    Signup
                </button>
            </div>
                </form>
    </div>

                <!-- Modal -->
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Signup</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <?php
                                    if (isset($_POST['signup'])) {
                                        $name = $_POST['name'];
                                        $email = $_POST['email'];
                                        $password = md5($_POST['password']);
                                        $confirm_password = md5($_POST['confirm_password']);
                                        if($password==$confirm_password){
                                        $select_query = "SELECT * FROM users WHERE email = '$email'";
                                        $select_result = mysqli_query($conn, $select_query);
                                        $count = mysqli_num_rows($select_result);
                                        if ($count <= 0) {
                                            $insert_query = "INSERT INTO users(name,email,password) VALUES('$name','$email','$password')";
                                            $insert_result = mysqli_query($conn , $insert_query);
                                            if($insert_result){
                                                ?>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                  <strong>Record added Successfully</strong> 
                                                </div>
                                                
                                                <script>
                                                  $(".alert").alert();
                                                </script>
                                                <?php
                                            }

                                        } else {
                                    ?>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <strong>Record already exists</strong>
                                            </div>

                                            <script>
                                                $(".alert").alert();
                                            </script>
                                    <?php
                                        }
                                    }
                                    else{
                                        ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                          <strong>Password don't match</strong> 
                                        </div>
                                        
                                        <script>
                                          $(".alert").alert();
                                        </script>
                                        <?php
                                    }
                                }
                                    ?>
                                    <form action="#" method="POST" enctype="multipart/form-data">
                                        <label for="name">Enter your name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="" aria-describedby="emailHelpId" placeholder="" required>
                                        <label for="email">Enter your email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="" aria-describedby="emailHelpId" placeholder="" required>
                                        <label for="password">Enter your password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" id="" aria-describedby="emailHelpId" placeholder="" required>
                                        <label for="confirm_password">Confirm your password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="confirm_password" id="" aria-describedby="emailHelpId" placeholder="" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="signup" class="btn btn-primary">Signup</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                </form>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
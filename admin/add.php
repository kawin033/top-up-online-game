<?php 
    require_once('connection.php');

    if (isset($_REQUEST['btn_insert'])) {
        $username = $_REQUEST['txt_username'];
        $email = $_REQUEST['txt_email'];
        $password = $_REQUEST['txt_password'];
        $role = $_REQUEST['txt_role'];

        if (empty($username)) {
            $errorMsg = "Please enter username";
        }  else if (empty($email)) {
            $errorMsg = "Please Enter email";
        } else if (empty($password)) {
            $errorMsg = "Please Enter password";
        } else if (empty($role)) {
            $errorMsg = "Please Enter role";     

        } else {
            try {
                if (!isset($errorMsg)) {
                    $insert_stmt = $db->prepare("INSERT INTO masterlogin(username, email, password, role) VALUES (:uname, :em, :pas, :ro)");
                   
                    $insert_stmt->bindParam(':uname', $username);
                    $insert_stmt->bindParam(':em', $email);
                    $insert_stmt->bindParam(':pas', $password);
                    $insert_stmt->bindParam(':ro', $role);
                    

                    if ($insert_stmt->execute()) {
                        $insertMsg = "Insert Successfully...";
                        header("refresh:2;admin_home.php");
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>

    <div class="container">
    <div class="display-3 text-center">Add+</div>

    <?php 
         if (isset($errorMsg)) {
    ?>
        <div class="alert alert-danger">
            <strong>Wrong! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>
    

    <?php 
         if (isset($insertMsg)) {
    ?>
        <div class="alert alert-success">
            <strong>Success! <?php echo $insertMsg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            
            <div class="form-group text-center">
                <div class="row">
                    <label for="username" class="col-sm-3 control-label">username</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_username" class="form-control" placeholder="Enter username...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="email" class="col-sm-3 control-label">email</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_email" class="form-control" placeholder="Enter email...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="password" class="col-sm-3 control-label">password</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_password" class="form-control" placeholder="Enter password...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="role" class="col-sm-3 control-label">role</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_role" class="form-control" placeholder="Enter role...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
                    <a href="admin_home.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>


    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>
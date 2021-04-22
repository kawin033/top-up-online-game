<?php 
    require_once('connection.php');

    if (isset($_REQUEST['update_id'])) {
        try {
            $id = $_REQUEST['update_id'];
            $select_stmt = $db->prepare("SELECT * FROM masterlogin WHERE id = :id");
            $select_stmt->bindParam(':id', $id);
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }

    if (isset($_REQUEST['btn_update'])) {
        $username_up = $_REQUEST['txt_username'];
        $email_up = $_REQUEST['txt_email'];
        $password_up = $_REQUEST['txt_password'];
        $role_up = $_REQUEST['txt_role'];
        

        if (empty($username_up)) {
            $errorMsg = "Please Enter username";
        } else if (empty($email_up)) {
            $errorMsg = "Please Enter email";
        } else if (empty($password_up)) {
            $errorMsg = "Please Enter password";
        } else if (empty($role_up)) {
            $errorMsg = "Please Enter role";    
        } else {
            try {
                if (!isset($errorMsg)) {
                    $update_stmt = $db->prepare("UPDATE masterlogin SET username = :uname_up, email = :em_up ,password = :pas_up ,role = :ro_up WHERE id = :id");
                    $update_stmt->bindParam(':uname_up', $username_up);
                    $update_stmt->bindParam(':em_up', $email_up);
                    $update_stmt->bindParam(':pas_up', $password_up);
                    $update_stmt->bindParam(':ro_up', $role_up);
                    $update_stmt->bindParam(':id', $id);

                    if ($update_stmt->execute()) {
                        $updateMsg = "Record update successfully...";
                        header("refresh:2;admin_home.php");
                    }
                }
            } catch(PDOException $e) {
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
<body>

    <div class="container">
    <div class="display-3 text-center">Edit Page</div>

    <?php 
         if (isset($errorMsg)) {
    ?>
        <div class="alert alert-danger">
            <strong>Wrong! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>
    

    <?php 
         if (isset($updateMsg)) {
    ?>
        <div class="alert alert-success">
            <strong>Success! <?php echo $updateMsg; ?></strong>
        </div>
    <?php } ?>

    <form method="post" class="form-horizontal mt-5">
            
            <div class="form-group text-center">
                <div class="row">
                    <label for="username" class="col-sm-3 control-label">username</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_username" class="form-control" value="<?php echo $username; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="email" class="col-sm-3 control-label">email</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_email" class="form-control" value="<?php echo $email; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="row">
                    <label for="password" class="col-sm-3 control-label">password</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_password" class="form-control" value="<?php echo $password; ?>">
                    </div>
                </div>
            </div>
             <div class="form-group text-center">
                <div class="row">
                    <label for="role" class="col-sm-3 control-label">role</label>
                    <div class="col-sm-9">
                        <input type="text" name="txt_role" class="form-control" value="<?php echo $role; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="admin_home.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>


    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>
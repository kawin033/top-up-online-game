<?php 
    require_once('connection.php');

    if (isset($_REQUEST['btn_insert'])) {
        $username = $_REQUEST['txt_username'];
        $itemsell = $_REQUEST['txt_itemsell'];
        $promotion = $_REQUEST['txt_pro'];
        $total_price = $_REQUEST['int_totalprice'];

        if (empty($username)) {
            $errorMsg = "Please enter username";
        }  else if (empty($itemsell)) {
            $errorMsg = "Please Enter Item";
        }  else if (empty($promotion)) {
            $errorMsg = "Please Enter pro";
        } else if (empty($total_price )) {
            $errorMsg = "Please Enter Price";  
        } else {
            try {
                if (!isset($errorMsg)) {
                    $insert_stmt = $db->prepare("INSERT INTO datauser(username, itemsell,promotion,total_price ) VALUES (:uname, :it, :pro,:pri)");
                   
                    $insert_stmt->bindParam(':uname', $username);
                    $insert_stmt->bindParam(':it', $itemsell);
                    $insert_stmt->bindParam(':pro', $promotion);
                    $insert_stmt->bindParam(':pri', $total_price );
                    

                    if ($insert_stmt->execute()) {
                        $insertMsg = "Insert Successfully...";
                        header("refresh:2;checkuser.php");
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
            <div class="form-group">
            
            <div class="col-sm-12">
                <select name="txt_itemsell" class="form-control">
                    <option value="" selected="selected">- Select Item -</option>
                    <option value="Magazin Gold">Magazin Gold</option>
                    <option value="Teleport">Teleportt</option>
                    <option value="Bagpack silver">Bagpack silver</option>
                    <option value="AK-47">AK-47</option>
                    <option value="RiderHEAD">RiderHEAD</option>
                    <option value="Moneyingame">Moneyingame</option>
                    <option value="Potion">Potion</option>
                    <option value="Posion">Posion</option>
                    <option value="IE">IE</option>
                </select>
            </div>
        </div>
            <div class="form-group">
            <div class="col-sm-12">
                <select name="txt_pro" class="form-control">
                    <option value="" selected="selected">- Select promotion-</option>
                    <option value="sell0%">sell0%</option>
                    <option value="sell20%">sell20%</option>
                    <option value="sell50%">sell50%</option>
                    <option value="sell60%">sell60%</option>
                    <option value="sell 1+1">sell 1+1</option>
                    <option value="sell 1+2">sell 1+2</option>
                </select>
            </div>
        </div>
        <div class="form-group text-center">
                <div class="row">
                    <label for="totalprice" class="col-sm-3 control-label">Total</label>
                    <div class="col-sm-9">
                        <input type="int" name="int_totalprice" class="form-control" placeholder="Enter total...">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-md-12 mt-3">
                    <input type="submit" name="btn_insert" class="btn btn-success" value="Insert">
                    <a href="orderuser.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>


    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>
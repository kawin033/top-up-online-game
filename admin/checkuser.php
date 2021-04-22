<?php 
    session_start();
    require_once('connection.php');
    
    if (!isset($_SESSION['admin_login'])) {
        header("location: ../index.php");
    }
    
    if (isset($_REQUEST['delete_user'])) {
        $username = $_REQUEST['delete_user'];

        $select_stmt = $db->prepare("SELECT * FROM addmoney WHERE username = :uname");
        $select_stmt->bindParam(':uname', $username);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        // Delete an original record from db
        $delete_stmt = $db->prepare('DELETE FROM addmoney WHERE username = :uname');
        $delete_stmt->bindParam(':uname', $username);
        $delete_stmt->execute();

        header('Location:checkuser.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 90px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            z-index: 99;
        }

        @media (max-width: 767.98px) {
            .sidebar {
                top: 11.5rem;
                padding: 0;
            }
        }
            
        .navbar {
            box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .1);
        }

        @media (min-width: 767.98px) {
            .navbar {
                top: 0;
                position: sticky;
                z-index: 999;
            }
        }

        .sidebar .nav-link {
            color: #333;
        }

        .sidebar .nav-link.active {
            color: #0d6efd;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-light bg-light p-3">
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
              
 <a class="navbar-brand" href="#">
            Top Up Online: Admin Pages
            </a>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        
        <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
            
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                <?php if(isset($_SESSION['admin_login'])) { ?>
                Welcome, <?php echo $_SESSION['admin_login']; }?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                </ul>
              </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link " href="admin_home.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span class="ml-2">Dashboard</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link " href="orderuser.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                            <span class="ml-2">Orders in</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page"href="checkuser.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> 
                            <span class="ml-2">Usermoney</span>
                          </a>
                        
                       
                      </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Home</a></li>
                        
                    </ol>
                                   </nav>
                                   <h1 class="h2">Usermoney</h1>
                                  <p>This is the homepage for manage users Money</p>
                                     <div class="row">
                                          <div class="col-12 col-xl-8 mb-4 mb-lg-0">
                                              <div class="card">
                                                <h5 class="card-header">History Bought User </h5>
                                                    <div class="card-body">
                                                       <div class="table-responsive">
                                                          <table class="table">
                                                             <thead>
                                                                  <tr>
                                                                  <th>User Name</th>
                                                                  <th>money</th>
                                                                  <th>Edit</th>
                                                                  <th>Delete</th>
                                                                  </tr>
                                                             </thead>
                                                             <tbody>
                                                             <?php 
                                                               $select_stmt = $db->prepare("SELECT * FROM addmoney");
                                                               $select_stmt->execute();
                                               
                                                               while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                                                      ?>
                                                                  <tr>
                                                                  <td><?php echo $row["username"]; ?></td>
                                                                  <td><?php echo $row["money"]; ?></td>
                                                                  <td><a href="editmoney.php?update_user=<?php echo $row["username"]; ?>" class="btn btn-warning">Edit</a></td>
                                                                  <td><a href="?delete_user=<?php echo $row["username"]; ?>" class="btn btn-danger">Delete</a></td>
                                                                  </tr>

                                                              <?php } ?>
                                                             </tbody>
                                                            </table>
                                                       </div>
                                               
                                                    </div>
                                                </div>
                                            </div>
                                                                </br>
                                        </div>
                                         <div class="row">
                                          <div class="col-12 col-xl-8 mb-4 mb-lg-0">
                                              <div class="card">
                                                <h5 class="card-header">User HoloCoin </h5>
                                                    <div class="card-body">
                                                       <div class="table-responsive">
                                                          <table class="table">
                                                             <thead>
                                                                  <tr>
                                                                  <th>User Name</th>
                                                                  <th>HoloCoin</th>
                                                                  <th>Edit</th>
                                                                  </tr>
                                                             </thead>
                                                             <tbody>
                                                             <?php 
                                                                $select_stmt = $db->prepare("SELECT * FROM coin");
                                                                $select_stmt->execute();
                                                
                                                                while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                                                      ?>
                                                                  <tr>
                                                                  <td><?php echo $row["username"]; ?></td>
                                                                  <td><?php echo $row["holocoin"]; ?></td>
                                                                  <td><a href="editcoin.php?update_coin=<?php echo $row["username"]; ?>" class="btn btn-warning">Edit</a></td>
                                                                  
                                                                </tr>

                                                              <?php } ?>
                                                             </tbody>
                                                            </table>
                                                       </div>
                                                            <a href="datauser.php" class="btn btn-danger">input</a>
                                                    </div>
                                                </div>
                                            </div>
                   
                                        </div>
              
                                </div>
                                
                            </div>
                        </div>
                    </div>
                   
                </div>
             
            
            
            </main>
        </div>
    </div>       
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>
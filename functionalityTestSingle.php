<?php 

	// if(isset($_POST['submit'])) {
    //     $ip = $_POST['ip'];
    //     $port = $_POST['port'];
    //     $waitTimeoutInSeconds = 10; 
    //     if($fp = @fsockopen($ip,$port,$errCode,$errStr,$waitTimeoutInSeconds)){   
    //         //alert("Success");
    //         echo '<script>alert("Welcome to Geeks for Geeks")</script>';
    //      } else {
    //         //alert("Failed");
    //         echo '<script>alert("Welcome to Geeks for Geeks")</script>';
    //      } 

        //echo $loadingtime;
        //echo $status;
        
        // $ip = secure_data($_POST['ip']);
        // $port = secure_data($_POST['port']);
        // //Strip html and slashes etc
        // function secure_data($data){
        //     $Sdata = trim($data);
        //     $Sdata = stripslashes($data);
        //     $Sdata = htmlspecialchars($data);
        //     return $Sdata;
        // }

        // //Set up POST array
        // $array = array (
        //     "ip" => $ip,
        //     "port" => $port
        // );

        // $data_string = json_encode($array);

        // //Create cURL connection
        // $curl = curl_init("http://localhost:8888/datenbanken/RestAPI/api.php?path=funcTestSingle");

        // //set cURL options
        // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // //curl_setopt($curl, CURLOPT_POST, true);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        //     'Content-Type: application/json',
        //     'Content-Length: ' . strlen($data_string))
        // );

        // //Execute cURL
        // $curl_response = curl_exec($curl);

        // //Output server response
        // print_r($curl_response);

        // //Close cURL connection
        // curl_close($curl);
    //   }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Datenbanken und Webtechniken Projekt</title>
        <link href="Vendor/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Proxy List</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Home
                            </a>
                            <div class="sb-sidenav-menu-heading">Additional</div>
                            <a class="nav-link" href="getProxyList.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Get Proxies
                            </a>
                            <a class="nav-link" href="functionalityTest.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Func Test (All)
                            </a>
                            <a class="nav-link" href="functionalityTestSingle.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Func Test (Single)
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Functionality Test Single</h1>
                        <div class="row">
                            <div class="col-xl-6 col-md-12"> 
                                <?php 
                                if(isset($_POST['submit'])) {
                                    $ip = $_POST['ip'];
                                    $port = $_POST['port'];
                                    $waitTimeoutInSeconds = 10;

                                    if($fp = @fsockopen($ip,$port,$errCode,$errStr,$waitTimeoutInSeconds)){
                                        echo '
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Passed</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                     } else {
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Failed</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                     } 
                                }
                                ?>
                                <form action="functionalityTestSingle.php" method="post">
                                    <div class="form-group">
                                        <label for="ip">IP address</label>
                                        <input type="text" class="form-control" id="ip" name="ip" placeholder="Enter IP Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="port">Port</label>
                                        <input type="text" class="form-control" id="port" name="port" placeholder="Enter Port Number">
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Test</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; www.tusar.live</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="Vendor/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        
    </body>
</html>

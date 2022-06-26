<?php 
    $client = curl_init("http://localhost:8888/datenbanken/RestAPI/api.php?path=getAllProxies");
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($client);
    $response = json_decode($result);
    $response_code = curl_getinfo($client, CURLINFO_HTTP_CODE);
    $response_data = $response->data;
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
                        <h1 class="mt-4">Get Proxies</h1>
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <?php if($response_code == 200) : ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong><?php echo $response->status_message; ?></strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>IP</th>
                                                    <th>Port</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                foreach($response_data as $row)
                                                {
                                                    echo '<tr><td>'.$row->ip.'</td><td>'.$row->port.'</td></tr>';
                                                } 
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else : ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>No Data Found.</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
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
        <script type="text/javascript">
            $(document).ready(function(){
                setInterval(getAllProxies,600000);
            });
            function getAllProxies(){
                    $.ajax({
                        url:"http://localhost:8888/datenbanken/RestAPI/api.php?path=getAllProxies",
                        success:function(data)
                        {
                            var returnedData = JSON.parse(data);
                            if(returnedData.status == 200)
                            {
                                alert(returnedData.status_message);
                            }
                            else
                                alert(returnedData.status_message);
                    
                        }
		            })
                }
        </script>
    </body>
</html>

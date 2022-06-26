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
                        <h1 class="mt-4">Home</h1>
                       
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Get Proxies</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="getProxyList.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Functionality Test</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="functionalityTestSingle.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                My Proxy List 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Row</th>
                                            <th>IP</th>
                                            <th>Port</th>
                                            <th>Create Date</th>
                                            <th>Last Found Date</th>
                                            <th>Last Func Test date</th>
                                            <th>Test URL</th>
                                            <th>Validation</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Row</th>
                                            <th>IP</th>
                                            <th>Port</th>
                                            <th>Create Date</th>
                                            <th>Last Found Date</th>
                                            <th>Last Func Test date</th>
                                            <th>Test URL</th>
                                            <th>Validation</th>
                                        </tr>
                                    </tfoot>
                                    <?php
                                    $client = curl_init("http://localhost:8888/datenbanken/RestAPI/api.php?path=showProxies");
                                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                    $result = curl_exec($client);
                                    $response = json_decode($result);
                                    $response_code = curl_getinfo($client, CURLINFO_HTTP_CODE);
                                    $response_data = $response->data;
                                    if($response_code == 200) :
                                        echo '<tbody>';
                                        $count = 0;
                                        foreach($response_data as $row)
                                        {
                                            $count += 1;
                                            echo '<tr>';
                                            echo '<td>'.$count.'</td>';
                                            echo '<td>'.$row->ip.'</td>';
                                            echo '<td>'.$row->port.'</td>';
                                            echo '<td>'.$row->created_at.'</td>';
                                            echo '<td>'.$row->last_checked.'</td>';
                                            echo '<td>'.$row->basic_fun_tested_at.'</td>';
                                            echo '<td>'.'https://' .$row->ip. ':' .$row->port.'</td>';
                                            if($row->basic_fun_test == 1) : 
                                                echo '<td>Passed</td>'; 
                                            elseif($row->basic_fun_test == 0) : 
                                                echo '<td>Failed</td>'; 
                                            else : 
                                                echo '<td>Not Checked</td>'; 
                                            endif;
                                            echo '</tr>';
                                        }
                                        echo '</tbody>';
                                    endif; 
                                    ?>
                                   
                                    </table>
                                </div>
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
                $('#dataTable').DataTable();
            });
        </script>
    </body>
</html>

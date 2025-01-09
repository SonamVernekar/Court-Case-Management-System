<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <h1>
                <?php echo $_SESSION["lawyer_name"]; ?>
            </h1>
            <br>
            <ul id="side_menu" class="nav nav-pills nav-stacked">
            <li class="active">
                        <a href="lawyer_dashboard.php">
                            <span class="glyphicon glyphicon-user"></span>
                            &nbsp; Profile
                        </a>
                    </li>
                <li class="active">
                    <a href="lawyer_dashboard.php?q=currentcases">
                        <span class="glyphicon glyphicon-list-alt"></span>
                        &nbsp; Current Cases
                     </a>
                </li>
                <li class="">
                    <a href="lawyer_dashboard.php?q=finishedcases">
                        <span class="glyphicon glyphicon-ok"></span>
                        &nbsp; Finished Cases
                    </a>
                </li>
                <li class="">
                    <a href="lawyer_dashboard.php?q=addcase">
                        <span class="glyphicon glyphicon-list-alt"></span>
                        &nbsp; Add case
                    </a>
                </li>
                <li class="">
                    <a href="lawyer_dashboard.php?q=clientdetails">
                        <span class="glyphicon glyphicon-list-alt"></span>
                        &nbsp; Client Details
                    </a>
                </li>
            </ul>
       </div>   <!--div ending of vertical nav -->

       <div class="col-sm-10">
            <h1>Current Cases</h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Sr. no</th>
                        <th>Client Id</th>
                        <th>Case type</th>
                        <th>Case details</th>
                        <th>Hearing date</th>
                        <th>Case status</th>
                        <th>Court Appointed</th>
                        <th>Update</th>
                    
                    </tr>
                        <?php
                            require_once("includes/db.php");
                            $con;
                            if ($con) {
                                $x=1;
                                $stmt = $con->prepare("
                                SELECT case_id, clientforcase_id, case_type, case_details, hearing_date, court_name
                                FROM cases WHERE case_status = ?");
                                $status = "pending";
                                $stmt->bind_param('s', $status);
                                $stmt->execute();
                                $stmt->store_result();
                                $stmt->bind_result($case_id,$clientid, $case_type,
                                $case_details, $hearing_date,
                                 $court_name);

                                while ($stmt->fetch()) {
                                    echo "
                                    <tr>
                                        <td> {$x} </td>
                                        <td> {$clientid} </td>
                                        <td> {$case_type} </td>
                                        <td> {$case_details} </td>
                                        <td> {$hearing_date} </td>
                                        <td> Pending </td>
                                        <td> {$court_name} </td>
                                        <td><a class='btn btn-info' href='lawyer_dashboard.php?q=updatecase&id={$case_id}'> Update </button> </td>
                                    </tr>
                                    ";
                                    $x++;
                                }
                            }
                            else{
                                echo "Server Prob";
                            }
                        ?>
                </table>
            </div>
       </div>
   </div>
</div>

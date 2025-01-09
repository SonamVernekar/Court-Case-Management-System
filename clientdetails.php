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
                    <li class="">
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
            </div> <!--div ending of vertical nav -->

        <div class="col-sm-10">
            <h1>Clients</h1><br>
            <div class="container">
                <div class="row" style="background-color: white;">

                    <?php
                        require_once("includes/db.php");
                        $con;
                        if ($con) {
                            $stmt = $con->prepare("
                            SELECT client_id, client_first_name, client_last_name, client_email, phone_no
                            FROM client");
                            $stmt->execute();
                            $stmt->store_result();
                            $stmt->bind_result($cid, $cfn, $cln, $ce, $cp);
                            while ($stmt->fetch()) {
                                echo "
                                <div class='col-sm-3'>
                                    <div class='card' style='width: 18rem; text-align: center; margin-top: 2rem;'>
                                        <img src='public/image/user.png' width='40' height='40' class='card-img-top' alt='...'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>{$cid}</h5>
                                            <p class='card-text'>
                                            {$cfn} {$cln}
                                        </p>
                                            <p class='card-text'>
                                                {$ce}
                                            </p>
                                            <p class='card-text'>
                                                {$cp}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                ";
                            }
                        }
                    ?>
                </div>
            </div>  <!-- card container ends-->

        </div>  <!-- col-sm-10 ends-->
   </div>
</div>

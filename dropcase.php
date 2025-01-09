

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <h1>
                <?php echo $_SESSION["lawyer_name"]; ?>
            </h1>
            <br>
            <ul id="side_menu" class="nav nav-pills nav-stacked">
                <li class="">
                    <a href="lawyer_dashboard.php">
                        <span class="glyphicon glyphicon-user"></span>
                        &nbsp; Profile
                     </a>
                </li>
                <li class="active">
                    <a href="lawyer_dashboard.php">
                        <span class="glyphicon glyphicon-list-ok"></span>
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
        </div> 
<?php

    require_once("includes/db.php");
    if ($con) {
        $case_id = $_GET['id'];
        $stmt->execute("DELETE cases 
            WHERE case_id = ? ");
        $stmt->close();
        echo "drop case";
        Header("Location: lawyer/currentcases.php");
    }

?>



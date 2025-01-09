<?php
    if(isset($_POST["addcase"])){
        $clientid=($_POST["ccid"]);
        $casetype=($_POST["ctype"]);
        $casedetails=($_POST["cdetails"]);
        $case_status="pending";
        $court_name=($_POST["cname"]);
        require_once("includes/db.php");
        $con;
        if ($con) {

            $lawyerid = $_SESSION['lawyer_id'];
           

            $stmt = $con->prepare("INSERT INTO cases(
                case_type, case_details, case_status, court_name, clientforcase_id)
                VALUES(?, ?, ?, ?,?)");
            $stmt->bind_param('sssss', $casetype, $casedetails, $case_status, $court_name ,$clientid);
            $stmt->execute();
            if ($stmt->affected_rows === -1) {
                echo "Error";
            } else {
                $stmt->close();
                echo "Case Added";

            }
            $accepted_status = "not yet accepted";
            $stmt = $con->prepare("INSERT INTO notifications(
                 client_id, lawyer_id, case_type, case_details)
                VALUES(?, ?, ?, ?)");
            $stmt->bind_param('ssss', $clientid, $lawyerid, $casetype, $casedetails);

            $stmt->execute();
            if ($stmt->affected_rows === -1) {
                echo "Error";
            } else {
                $stmt->close();
                echo "Case Added";
                Header("Location: lawyer_dashboard.php");
            }

           
            
        }
    }

?>
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

        <div class="col-sm-10" style="font-weight: bold; padding-bottom: 30px;">

            <h1>Enter Case details</h1><br>
            <form action='lawyer_dashboard.php?q=addcase' method='post'>

           
                <label for='case-type'>
                    Case Type:
                </label>
                <input type='text' class='form-control'
                placeholder='Case Type' name='ctype' required><br>

                <label for='case-details'>
                    Case Details:
                </label>
                <input type='text' class='form-control'
                placeholder='Case Details' name='cdetails' required><br>

                <label for='court-name'>
                    Court Name:
                </label>
                <input type='text' class='form-control'
                placeholder='Court Name' name='cname' required><br>

                <label for='clientforcase-id'>
                    Client Id:
                </label>
                <input type='text' class='form-control'
                placeholder='Client id' name='ccid' required><br>


                <button class='btn btn-primary btn-lg btn-block' type='submit' name='addcase'>
                    Add Case
                </button>
            </form>

        </div>
   </div>
</div>
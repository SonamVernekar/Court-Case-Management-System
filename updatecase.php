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
       </div>   <!--div ending of vertical nav -->

       <?php if(isset($_GET['id'])){ ?>
           <?php
                require_once("includes/db.php");
                $con;
                if ($con) {
                    $stmt = $con->prepare("
                    SELECT case_type, case_details, hearing_date,
                    case_status, court_name
                    FROM cases WHERE case_id=?");
                    $stmt->bind_param('i', $_GET['id']);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($case_type, $case_details, $hearing_date,
                     $case_status, $court_name);
                    while ($stmt->fetch()) {
                        $c_type = $case_type;
                        $c_details = $case_details;
                        $c_hearing = $hearing_date;
                        $c_status = $case_status;
                        $c_name = $court_name;
                    }
                }
            ?>
           <div class="col-sm-10">
                <h1>Update Case</h1>
                <form action="lawyer_dashboard.php?q=updatecase&id=<?php echo $_GET['id']; ?>" method="post">
                    <fieldset>
                    <div class="form-group">

                        <label for="case-type"> Case Type: </label>
                        <input class="form-control" type="text" name="case-type"
                        value="<?php echo $c_type; ?>" placeholder="case-type" required><br>

                        <label for="case-details"> Case details: </label>
                        <input class="form-control" type="text" name="case-details"
                        value="<?php echo $c_details; ?>" placeholder="case-details" required><br>

                        <label for="hearing-date">  Hearing date(Format: yyyy-mm-dd): </label>
                        <input class="form-control" type="text" name="hearing-date"
                        value="<?php echo $c_hearing; ?>" placeholder="hearing-date"><br>

                        <label for="case-status"> Case Status(pending/finished): </label>
                        <input class="form-control" type="text" name="case-status"
                        value="<?php echo $c_status; ?>" placeholder="case-status" required><br>

                        <label for="court-name"> Court Name: </label>
                        <input class="form-control" type="text" name="court-name"
                        value="<?php echo $c_name; ?>" placeholder="court-name" required><br>

                        <input class="btn btn-info btn-block" type="submit" name="update-case" value="Update Case">
                    </div>
                </form>
           </div>
        <?php } ?>
   </div>
</div>


<?php
if(isset($_POST['update-case'])){
    $case_type = $_POST['case-type'];
    $case_details = $_POST['case-details'];
    $hearing_date = $_POST['hearing-date'];
    $case_status = $_POST['case-status'];
    $court_name = $_POST['court-name'];
    require_once("includes/db.php");
    $con;
    if ($con) {
        $case_id = $_GET['id'];
        $stmt = $con->prepare("UPDATE cases SET
            case_type = ?, case_details = ?, hearing_date = ?,
           case_status = ?, court_name = ?
            WHERE case_id = ? ");

        $stmt->bind_param('sssssi', $case_type, $case_details, $hearing_date,
        $case_status, $court_name, $case_id);
        $stmt->execute();
        $stmt->close();
        echo "updated case";
        Header("Location: llawyer_dashboard.php");
    }
}
?>

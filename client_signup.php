<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client-signup</title>
    <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
    crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/signup.css">
    <link rel = "icon"
    href = "public/image/statue.jpg"
    type = "image/x-icon">
</head>

<body>

    <?php
        if(isset($_POST["client-signup"])){
            $firstname=($_POST["client-firstname"]);
            $lastname=($_POST["client-lastname"]);
            $email=($_POST["client-email"]);
            $password=($_POST["client-password"]);
            $phone=($_POST["phone-no"]);
            require_once("includes/db.php");
            $con;
            if ($con) {
                $stmt = $con->prepare("SELECT * FROM client WHERE client_email = ?");
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $stmt->store_result();
                $numRows = $stmt->num_rows;
                if ($numRows > 0) {
                    echo "Email already used.";
                }
                else{
                    $hashedpwd = password_hash($password, PASSWORD_BCRYPT);
                    $stmt = $con->prepare("INSERT INTO client(client_first_name, client_last_name, client_email, client_password,phone_no)
                    VALUES (?,?,?,?,?)");
                    $stmt->bind_param('sssss', $firstname, $lastname, $email, $hashedpwd, $phone );
                    $stmt->execute();
                    if ($stmt->affected_rows === -1) {
                        echo "Error";
                        exit();
                    } else {
                        $stmt->close();
                        echo "signuped client";
                        Header("Location: client_login.php");
                        exit();
                    }
                }
            }
        }

    ?>


    <form action="client_signup.php" method="post" style="border:1px solid #ccc">
        <div class="container">
          <h1> Clients</h1>
          <p>Please fill in this form to register.</p>
          <hr>

          <label for="name"><b>First Name</b></label>
          <input type="text" placeholder="First Name" name="client-firstname" required>

          <label for="name"><b>Last Name</b></label>
          <input type="text" placeholder="Last Name" name="client-lastname" required>

          <label for="email"><b>Email</b></label>
          <input type="text" placeholder="Enter Email" name="client-email" required>

          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="client-password" id="pass" required>

          <label for="phone">Mobile number:</label>
          <input type="tel" placeholder="Enter Mobile "id="mobile" name="phone-no"  required>



          <p>By registering you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

          <div class="clearfix">
            <button type="button" class="cancelbtn" onclick="window.location.href='index.php'">
                Cancel
            </button>
            <button type="submit" name="client-signup" class="signupbtn">Register</button>
          </div>
          <a href="client_login.php"> Have account? Login </a>
        </div>
      </form>

</body>
</html>

<?php
session_start();


$conn = new mysqli('localhost', 'root', 'qwerty', 'myDB');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else{
  $last_id = $conn->insert_id;
}

// define variables and set to empty values
$namee = $gender = $age = $rel_status = $phone_num = $iphone = $currnet_phone = $features = $price = $expirence = "";
$name_err = $gender_err = $age_err = $rel_status_err = $phone_num_err = $iphone_err = $currnet_phone_err = $features_err = $price_err = $expirence_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["namee"])) {
    $name_err = "Name is required";
  } else {
    $namee = test_input($_POST["namee"]);
    // check if name only contains letters and whitespace
    // if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
    //   $name_err = "Only letters and white space allowed";
    // }
  }

  if (empty($_POST["gender"])) {
    $gender_err = "gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
    // check if e-mail address is well-formed
    // if (!filter_var($gender, FILTER_VALIDATE_EMAIL)) {
    //   $gender_err = "Invalid email format";
    // }
  }

  if (empty($_POST["age"])) {
    $age_err = "age is required";
  } else {
    $age = test_input($_POST["age"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    // if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
    //   $age_err = "Invalid URL";
    // }
  }

  if (empty($_POST["rel_status"])) {
    $rel_status_err = "status is required";
  } else {
    $rel_status = test_input($_POST["rel_status"]);

  }

  if (empty($_POST["phone_num"])) {
    $phone_num_err = "number is required";
  } else {
    $phone_num = test_input($_POST["phone_num"]);

  }
}

if (empty($_POST["iphone"])) {
  $iphone_err = "This is required";
} else {
  $iphone = test_input($_POST["iphone"]);
  // check if e-mail address is well-formed
  // if (!filter_var($iphone, FILTER_VALIDATE_EMAIL)) {
  //   $iphone_err = "Invalid email format";
  // }
}

if (empty($_POST["currnet_phone"])) {
  $currnet_phone_err = "model is required";
} else {
  $currnet_phone = test_input($_POST["currnet_phone"]);
  // check if e-mail address is well-formed
  // if (!filter_var($currnet_phone, FILTER_VALIDATE_EMAIL)) {
  //   $currnet_phone_err = "Invalid email format";
  // }
}

if (empty($_POST["features"])) {
  $features_err = "This is required";
} else {
  $features = test_input($_POST["features"]);
  // check if e-mail address is well-formed
  // if (!filter_var($features, FILTER_VALIDATE_EMAIL)) {
  //   $features_err = "Invalid email format";
  // }
}

if (empty($_POST["price"])) {
  $price_err = "price is required";
} else {
  $price = test_input($_POST["price"]);
  // check if e-mail address is well-formed
  // if (!filter_var($price, FILTER_VALIDATE_EMAIL)) {
  //   $price_err = "Invalid email format";
  // }
}

if (empty($_POST["expirence"])) {
  $expirence_err = "expirence is required";
} else {
  $expirence = test_input($_POST["expirence"]);
  // check if e-mail address is well-formed
  // if (!filter_var($expirence, FILTER_VALIDATE_EMAIL)) {
  //   $expirence_err = "Invalid email format";
  // }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

echo "<h2>Your Input:</h2>";
echo $namee;
echo "<br>";
echo $gender;
echo "<br>";
echo $age;
echo "<br>";
echo $rel_status;
echo "<br>";
echo $phone_num;
echo "<br>";
echo $iphone;
echo "<br>";
echo $currnet_phone;
echo "<br>";
echo $features;
echo "<br>";
echo $price;
echo "<br>";
echo $expirence;
$file = $_SESSION['username'];

$sql = "UPDATE users SET name='$namee',
                        gender='$gender',
                         age='$age',
                         rel_status='$rel_status',
                          phone_number='$phone_num',
                          iphone='$iphone',
                           current_phone='$currnet_phone',
                            features='$features',
                             price='$price',
                             expirence= '$expirence' WHERE username='$file'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">

        body{
          font: 14px sans-serif;
           text-align: center; }
        label{
          font-size: 30px;
        }
    </style>
</head>
<body>
  <script>
function scrollWin() {
    window.scrollBy(0, 620);
}
</script>
    <div class="page-header">
        <h1>Hi, <b><?php echo $_SESSION['username']; ?></b>. Welcome to our site.</h1>
        <h2>answer these questions</h2>
        <div class="wrapper">
            <form style=" margin: auto; width: 35%; border: 3px;padding: 10px;"
    action="cpy.php" method="post">

                <div style="border: 2px;
                              border-radius: 4px; width: 500px;margin-bottom: 500px" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>>
                    <label>Can you tell me your name?*</label>
                    <input style=" background-color: lightblue;" type="text" name="namee"class="form-control" value="">
                    <span class="help-block"><?php echo $name_err; ?></span>
                    <button style="position:fixed;margin-top:50px;background-color: grey;height:50px;width:250px;margin-left:-130px" onclick="scrollWin()" type="button">Next</button>
                </div>

                <div style="border: 2px;
                              border-radius: 4px; width: 500px;margin-bottom: 500px" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
                    <label>Tell me your gender</label><br>

                      <input style=" background-color: lightblue;height:20px;width:20px" type="radio" name="gender" value="male" checked> Male
                      <input style=" background-color: lightblue;height:20px;width:20px" type="radio" name="gender" value="female"> Female
                      <input style=" background-color: lightblue;height:20px;width:20px" type="radio" name="gender" value="other"> Other<br>

                    <span class="help-block"><?php echo $gender_err; ?></span>
                </div>

                <div style="border: 2px;
                              border-radius: 4px; width: 500px;margin-bottom: 500px" <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>>
                    <label>Can you tell me your age</label>
                    <input style=" background-color: lightblue;" type="number" name="age" class="form-control" value="">
                    <span class="help-block"><?php echo $age_err; ?></span>
                </div>

                <div style="border: 2px;
                              border-radius: 4px; width: 500px;margin-bottom: 500px" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>>
                    <label>Whats your relationship status?</label><br>
                    <div style="margin-top: 20px">
                      <input style=" background-color: lightblue;height:20px;width:20px" type="radio" name="rel_status" value="Single" checked>
                      <input style=" background-color: lightblue;height:20px;width:20px" type="radio" name="rel_status" value="Comitted"> Comitted
                      <input style=" background-color: lightblue;height:20px;width:20px" type="radio" name="rel_status" value="married"> married
                      <input style=" background-color: lightblue;height:20px;width:20px" type="radio" name="rel_status" value="one side"> one side

                    </div>
                    <span class="help-block"><?php echo $rel_status_err; ?></span>
                </div>

                <div style="border: 2px;
                              border-radius: 4px; width: 500px;margin-bottom: 500px" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
                    <label>Tell me your phone number</label>
                    <input style=" background-color: lightblue;" type="text" maxlength="10" name="phone_num" class="form-control" value="">
                    <span class="help-block"><?php echo $phone_num_err; ?></span>
                </div>

                <div style="border: 2px;
                              border-radius: 4px; width: 500px;margin-bottom: 500px" <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>>
                    <label>Do you own an iPhone?</label><br>

                      <input style=" background-color: lightblue;height:20px;width:20px;margin-bottom:10px" type="radio" name="iphone" value="yes" checked>YES<br>
                      <input style=" background-color: lightblue;height:20px;width:20px" type="radio" name="iphone" value="no">NO<br>

                    <span class="help-block"><?php echo $iphone_err; ?></span>
                </div>

                <div style="border: 2px;
                              border-radius: 4px; width: 500px;margin-bottom: 500px" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>>
                    <label style="margin-bottom:30px">How happy are you with your current Phone?*</label>
                      <input style=" background-color: lightblue;margin-right:10px;height:20px; width:20px;" type="radio" name="currnet_phone" value="1"> 1
                      <input style=" background-color: lightblue;margin-right:10px;height:20px; width:20px;" type="radio" name="currnet_phone" value="2"> 2
                      <input style=" background-color: lightblue;margin-right:10px;height:20px; width:20px;" type="radio" name="currnet_phone" value="3"> 3
                      <input style=" background-color: lightblue;margin-right:10px;height:20px; width:20px;" type="radio" name="currnet_phone" value="4"checked> 4
                      <input style=" background-color: lightblue;margin-right:10px;height:20px; width:20px;" type="radio" name="currnet_phone" value="5"> 5

                    <span class="help-block"><?php echo $currnet_phone_err; ?></span>
                </div>

                <div style="border: 2px;
                              border-radius: 4px; width: 500px;margin-bottom: 500px" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
                    <label>What new features you expect in iPhone 10?</label>
                    <input style=" background-color: lightblue;" type="text" name="features" class="form-control" value="">
                    <span class="help-block"><?php echo $features_err; ?></span>
                </div>

                <div style="border: 2px;
                              border-radius: 4px; width: 500px;margin-bottom: 500px" <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>>
                    <label>What according to you should be price of new iPhone 10?</label>
                    <input style=" background-color: lightblue;" type="text" name="price" class="form-control" value="">
                    <span class="help-block"><?php echo $price_err; ?></span>
                </div>

                <div style="border: 2px;
                              border-radius: 4px; width: 500px;margin-bottom: 200px" <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>>
                    <label>Rate your experience on Iphone X</label>

                      <input style=" background-color: lightblue;margin-right:10px;height:20px; width:20px;" type="radio" name="expirence" value="1"> 1
                      <input style=" background-color: lightblue;margin-right:10px;height:20px; width:20px;" type="radio" name="expirence" value="2"> 2
                      <input style=" background-color: lightblue;margin-right:10px;height:20px; width:20px;" type="radio" name="expirence" value="3"> 3
                      <input style=" background-color: lightblue;margin-right:10px;height:20px; width:20px;" type="radio" name="expirence" value="4"checked> 4
                      <input style=" background-color: lightblue;margin-right:10px;height:20px; width:20px;" type="radio" name="expirence" value="5"> 5

                    <span class="help-block"><?php echo $expirence_err; ?></span>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>

            </form>
        </div>
    </div>
    <p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></p>
</body>
</html>

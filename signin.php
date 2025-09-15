<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="signin-container">
    <h2>Sign In</h2>
    <form method="POST" action="signin.php">

    <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Sign In</button>
      <div class="links">
        <a href="#">Forgot Password?</a>
      </div>
    </form>
  </div>
</body>
</html>

<?php
//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'PHPMailer/vendor/autoload.php';
require 'db_conn.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'joypraise.mutwiri@strathmore.edu';                     //SMTP username
    $mail->Password   = 'jjfl cccb yskn qyco';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('joypraise.mutwiri@strathmore.edu', 'Joy');
    $mail->addAddress($email, 'Joy');     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

       //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'Welcome '.$username.' You have successfully registered';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent<br>';

    // Insert data into the db

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashedPassword);

    // Execute
    if ($stmt->execute()) {
        echo "New user registered successfully!<br>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $users = $conn->query("Select * from users");
    $count = 1;

    foreach($users as $user){
      echo $count." ".$user['username']." ".$user['email']."<br>"; 
      $count++;
    }
    
    

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function




//Create an instance; passing `true` enables exceptions



?>

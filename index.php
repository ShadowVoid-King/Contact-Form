<?php
// Check If User Coming From A Request
if ($_SERVER['REQUEST_METHOD'] == 'POST'):

    // Assign Variables

    // filter_var($_POST['username'] , FILTER_SANITIZE_STRING) Deprecated to prevent XSS Attack
    // Alter native > preg_replace('/[^A-Za-z0-9 ]/', '', $_POST['username']);
    $user = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    // This converts characters like <, >, &, and " into their HTML entity equivalents.

    $mail = filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL);
    $cell = filter_var($_POST['cellphone'] , FILTER_SANITIZE_NUMBER_INT);
    $msg = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

    //~ debug
    // echo $user . "<br />";
    // echo $msg . "<br />";

    // Creating Array Of Errors

    $formErrors = array();

    if (strlen($user) <= 3):
        $formErrors[] = "Username Must Be Large Than 3 Characters";
    endif;
    if (strlen($msg) < 10):
        $formErrors[] = "Message Can't Be Less Than 10 Characters";
    endif;
    // If No Errors Send To Email [ mail(TO , Subject, Message, Headers, Parameters) ]
    $headers   = 'Form: ' . $mail . '\r\n';
    $myEmail   = 'test@test.com'; // not really my email :D
    $mySubject = 'Contact Form';

    if (empty($formErrors)) :
        // You Will Get Error Because Xampp Can't handle SMTP Server unless you make some config to it 
        // it will work fine on online server with SMTP

        mail($myEmail, $mySubject, $msg, $headers);

        // $user = $mail = $cell = $msg = ''; // assign many variables as null
        $success = '<div class"alert alert-success">We Have Received Your Message</div>';
    endif;
endif;
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Elzero Contact Form</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/contact.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- Start Form -->
    <div class="container">
        <h1 class="text-center">Contact Me</h1>

        <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <?php if (! empty($formErrors)): ?>
                <div class="alert alert-danger alert-dismissible" role="start">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php foreach ($formErrors as $error) {
                        echo $error . '<br />';
                    }
                    ?>
                </div>
            <?php endif; ?>
            <?php if (isset($success)) { echo $success;} ?>

            <div class="form-group">
            <input class="username form-control" type="text" name="username" placeholder="Type Your  Username" value="<?php if (isset($user)) {echo $user; } ?>" />

                <!-- icon -->
                <i class="fa fa-user fa-fw"></i>
                <span class="asterisx">*</span>
                
                <div class="alert alert-danger custom-alert">
                    Username Must Be Larger Than <strong>4</strong> Characters
                </div>
            </div>

            <div class="form-group">
                <input class="email form-control" type="email" name="email" placeholder="Please, Type A Valid Email" 
                value="<?php if (isset($mail)) {echo $mail; } ?>"/>
                <i class="fa fa-envelope fa-fw"></i>
                <span class="asterisx">*</span>
                <div class="alert alert-danger custom-alert">
                    Email Can't be <strong>Empty</strong>
                </div>
            </div>

            <input class="form-control" type="number" name="cellphone" placeholder="Type Your Cell Phone" 
            value="<?php if (isset($cell)) {echo $cell; } ?>"/>
            <i class="fa fa-phone fa-fw"></i>

            <textarea class="message form-control" name="message" placeholder="Your Message !"><?php if (isset($msg)) {echo $msg; } ?></textarea>
            <div class="alert alert-danger custom-alert">
                    Message Must Be Larger Than <strong>10</strong> Characters
            </div>

            <input class="btn btn-success" type="submit" value="Send Message" />
            <i class="fa fa-send fa-fw send-icon"></i>

        </form>
    </div>
    <!-- End Form -->

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>

<!-- 
Add
    recaptcha
    PHP Mailer
-->
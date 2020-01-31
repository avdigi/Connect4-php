<?php
session_start();
    if(isset($_SESSION['username'])){
        ob_start();
        header('Location: https://secure.digiovanni.dev/');
        ob_end_flush();
        die();
    }
    require_once("../src/backend.php");
    $bd = new Backend();

    // define variables and set to empty values
    $username = $pass = $email = "";

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/tailwindcss@1.0.4/dist/tailwind.min.css" rel="stylesheet">    
    <link href="../assets/css/login.css" rel="stylesheet">

    <title>Connect 4 - Registration</title>

</head>
<body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
    <div class="gradBg h-screen w-screen">
    <div id="loginForm" class="flex flex-col items-center flex-1 h-full justify-center px-4 sm:px-0">
        <div class="flex rounded-lg shadow-lg w-full sm:w-3/4 lg:w-1/2 bg-white sm:mx-0 h-auto max-w-xl">
            <div class="flex flex-col w-full p-4">
                <div class="flex flex-col flex-1 justify-center mb-8">
                    <div id="logoContainer" class="mt-4">
                    <!-- With thanks to Alessandro Benassi - Source: https://codepen.io/solidpixel/pen/RZoJeO  -->
                        <svg onmouseenter="startAnimation()" onmouseleave="stopAnimation()" onclick="speedAnimation()" version="1.1" id="loading-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="992 -1075 596 596" style="enable-background:new 992 -1075 596 596;" xml:space="preserve">
                        <circle class="st0" cx="1290" cy="-951.9" r="94.8"/>
                        <circle class="st1" cx="1464.9" cy="-777" r="94.8"/>
                        <circle class="st2" cx="1290" cy="-602.1" r="94.8"/>
                        <circle class="st3" cx="1115.1" cy="-777" r="94.8"/>
                        </svg>
                    </div>
                        
                    <h1 class="text-4xl text-center font-thin">Connect 4</h1>
                    <h2 class="text-3xl text-center font-regular">Register a new account today!</h2>
                    <h2 class="text-2xl text-center font-thin">Once you finish your registration,<br/> we will email you an confirmation email</h2>
                    
                    <div class="w-full mt-4 mb-2">
                        <form class="form-horizontal w-3/4 mx-auto" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="flex flex-col mt-4">
                                <input id="username" type="text" class="flex-grow h-8 px-2 border rounded border-grey-400" name="username" value=""  autocomplete="new-user"  placeholder="Username">
                            </div>
                            <div class="flex flex-col mt-4">
                                <input id="email" type="text" class="flex-grow h-8 px-2 border rounded border-grey-400" name="email" value=""  autocomplete="new-email"  placeholder="Email">
                            </div>
                            <div class="flex flex-col mt-4">
                                <input id="password" type="password" class="flex-grow h-8 px-2 rounded border border-grey-400" name="password" required  autocomplete="new-password"  placeholder="Password">
                            </div>
                            <div class="flex flex-col mt-8">
                                <button type="submit" class="btn gradBtn text-white text-sm font-semibold py-2 px-4 rounded">
                                    Register!
                                </button>
                                <a href="../login/" class=" mt-2 text-center text-blue-500 bg-transparent hover:bg-blue-700 border border-blue-500 text-blue-500 hover:text-white text-sm font-semibold py-2 px-4 rounded">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Javascript stuff -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js"></script>
<script src="../assets/js/logo.js"></script>
<script src="../assets/js/login.js"></script>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Now we check if the data was submitted, isset() function will check if the data exists.
    if (!isset($_POST['username'], $_POST['email'], $_POST['password'])) {
        ?>
        <script type="text/javascript">
            openAlert("Registration Failed - Please check your credentials and try again");
        </script>
        <?php
        die();
    }
    // Make sure the submitted registration values are not empty.
    if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
        ?>
        <script type="text/javascript">
            openAlert("Registration Failed - Please check your credentials and try again");
        </script>
        <?php
        die();
    }

    $username = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);

    // Prevalidation
    if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
        ?>
        <script type="text/javascript">
            openAlert("Registration Failed - Username is invalid");
        </script>
        <?php
        die();
    }
    if (preg_match('/[A-Za-z0-9]+/', $_POST['email']) == 0) {
        ?>
        <script type="text/javascript">
            openAlert("Registration Failed - email is invalid");
        </script>
        <?php
        die();
    }
    if (preg_match('/[A-Za-z0-9]+/', $_POST['password']) == 0) {
        ?>
        <script type="text/javascript">
            openAlert("Registration Failed - password is invalid");
        </script>
        <?php
        die();
    }

    if (strlen($_POST['username']) > 100 || strlen($_POST['username']) <= 0) {
        ?>
        <script type="text/javascript">
            openAlert("Registration Failed - Username must be less than 64 characters long!");
        </script>
        <?php
        die();
    }
    if (strlen($_POST['email']) > 254 || strlen($_POST['email']) <= 0) {
        ?>
        <script type="text/javascript">
            openAlert("Registration Failed - email must be less than 254 characters long!");
        </script>
        <?php
        die();
    }
    if (strlen($_POST['password']) > 64 || strlen($_POST['password']) < 5) {
        ?>
        <script type="text/javascript">
            openAlert("Registration Failed - Password must be at least 5 characters long!");
        </script>
        <?php
        die();
    }
    //prevalidation end

    //check email & username unique
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        if($bd->db->checkPeople("username",$username)){
            if($bd->db->checkPeople("email",$email)){
                //if user and password is valid, register the user!
                if($bd->db->register($username,$email,$password)){
                    //emailing the user to inform them they have registerd a new account with us!
                    $from    = 'noreply@secure.digiovanni.dev';
                    $subject = 'Account Created for Connect Four';
                    $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
                    $activate_link = 'https://secure.digiovanni.dev/';
                    $message = '<p>You have created an account with us! Play your next Connect 4 match today! <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
                    mail($_POST['email'], $subject, $message, $headers);

                    $_SESSION['username'] = $username;
                    echo "<script> location.href='../index.php'; </script>";
                } else {
                    ?>
                    <script type="text/javascript">
                        openAlert("Registration failed - Please try again");
                    </script>
                    <?php
                    die();
                }    
            } else {
                ?>
                <script type="text/javascript">
                    openAlert("Registration failed - Please use a different email");
                </script>
                <?php
                die();
            } 
        } else {
            ?>
            <script type="text/javascript">
                openAlert("Registration failed - Please use a different username");
            </script>
            <?php
            die();
        }
    } else {
        ?>
        <script type="text/javascript">
            openAlert("Registration failed - Please use a valid email");
        </script>
        <?php
        die();
    }
}
?>
## cottco MIGRATION

--migration
php carlos orm:schema-tool:update --force

user Ctc100000dvx_adminweo_wsd
pass #%&*85655!Ctc100000dvx_adminweo_ws



main store 

Transit depot


           Transit
              |
   |===================
   |                   |
   CIDP                CIDP



   Dispatch Process
    208c Invoice

    Store Person (Procurement Offier)

    Store Cleck Receiver at Transit Level

    CIDP == Input Clerk






    <?php
    if (isset($_POST['submit'])) {
        $v1 = "FirstUser";
        $v2 = "MyPassword";
        $v3 = $_POST['text'];
        $v4 = $_POST['pwd'];
        if ($v1 == $v3 && $v2 == $v4) {
            $_SESSION['luser'] = $v1;
            $_SESSION['start'] = time(); // Taking now logged in time.
            // Ending a session in 30 minutes from the starting time.
            $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
            header('Location: http://localhost/somefolder/homepage.php');
        } else {
            echo "Please enter the username or password again!";
        }
    }
?>



<?php
    session_start();

    if (!isset($_SESSION['luser'])) {
        echo "Please Login again";
        echo "<a href='http://localhost/somefolder/login.php'>Click Here to Login</a>";
    }
    else {
        $now = time(); // Checking the time now when home page starts.

        if ($now > $_SESSION['expire']) {
            session_destroy();
            echo "Your session has expired! <a href='http://localhost/somefolder/login.php'>Login here</a>";
        }
        else { //Starting this else one [else1]
?>
            <!-- From here all HTML coding can be done -->
            <html>
                Welcome
                <?php
                    echo $_SESSION['luser'];
                    echo "<a href='http://localhost/somefolder/logout.php'>Log out</a>";
                ?>
            </html>
<?php
        }
    }
?>





<?php
/***
 * Starts a session with a specific timeout and a specific GC probability.
 * @param int $timeout The number of seconds until it should time out.
 * @param int $probability The probablity, in int percentage, that the garbage 
 *        collection routine will be triggered right now.
 * @param strint $cookie_domain The domain path for the cookie.
 */
function session_start_timeout($timeout=5, $probability=100, $cookie_domain='/') {
    // Set the max lifetime
    ini_set("session.gc_maxlifetime", $timeout);

    // Set the session cookie to timout
    ini_set("session.cookie_lifetime", $timeout);

    // Change the save path. Sessions stored in teh same path
    // all share the same lifetime; the lowest lifetime will be
    // used for all. Therefore, for this to work, the session
    // must be stored in a directory where only sessions sharing
    // it's lifetime are. Best to just dynamically create on.
    $seperator = strstr(strtoupper(substr(PHP_OS, 0, 3)), "WIN") ? "\\" : "/";
    $path = ini_get("session.save_path") . $seperator . "session_" . $timeout . "sec";
    if(!file_exists($path)) {
        if(!mkdir($path, 600)) {
            trigger_error("Failed to create session save path directory '$path'. Check permissions.", E_USER_ERROR);
        }
    }
    ini_set("session.save_path", $path);

    // Set the chance to trigger the garbage collection.
    ini_set("session.gc_probability", $probability);
    ini_set("session.gc_divisor", 100); // Should always be 100

    // Start the session!
    session_start();

    // Renew the time left until this session times out.
    // If you skip this, the session will time out based
    // on the time when it was created, rather than when
    // it was last used.
    if(isset($_COOKIE[session_name()])) {
        setcookie(session_name(), $_COOKIE[session_name()], time() + $timeout, $cookie_domain);
    }
}


<IfModule mod_php5.c>
    #Session timeout
    php_value session.cookie_lifetime 1800
    php_value session.gc_maxlifetime 1800
</IfModule>


$lifetime = strtotime('+30 minutes', 0);

session_set_cookie_params($lifetime);

session_start();


class Session{
    public static function init(){
        ini_set('session.gc_maxlifetime', 1800) ;
        session_start();
    }
    public static function set($key, $val){
        $_SESSION[$key] =$val;
    }
    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        } else{
            return false;
        }
    }
    public static function checkSession(){
        self::init();
        if(self::get("adminlogin")==false){
            self::destroy();
            header("Location:login.php");
        }
    }
    public static function checkLogin(){
        self::init();
        if(self::get("adminlogin")==true){
            header("Location:index.php");
        }
    }
    public static function destroy(){
        session_destroy();
        header("Location:login.php");
    }
}




<?php
$con  = mysqli_connect("localhost","root","","graph");
 if (!$con) {
     # code...
    echo "Problem in database connection! Contact administrator!" . mysqli_error();
 }else{
         $sql ="SELECT * FROM tblsales";
         $result = mysqli_query($con,$sql);
         $chart_data="";
         while ($row = mysqli_fetch_array($result)) { 
 
            $productname[]  = $row['Product']  ;
            $sales[] = $row['TotalSales'];
        }
 
 }
?>

<?php require_once 'record.php'; ?>
<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Graph</title> 
    </head>
    <body>
        <div style="width:60%;hieght:20%;text-align:center">
            <h2 class="page-header" >Product Sales Reports </h2>
            <p style="align:center;"><canvas  id="chartjs_bar"></canvas></p>
        </div>    
    </body>
  <script src="js/jquery.js"></script>
  <script src="js/Chart.min.js"></script>
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($productname); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969aa",
                                "#ff407b",
                                "#331523",
                                "#ffc750"
                            ],
                            data:<?php echo json_encode($sales); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
    </script>
</html>


https://www.sourcecodessite.com/how-to-create-graph-in-php-using-mysql-database/

if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
 echo "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
} else {
 echo "Your password is strong.";
}

if(isset($_POST['password'])) {
  $password = $_POST['password'];
  $number = preg_match('@[0-9]@', $password);
  $uppercase = preg_match('@[A-Z]@', $password);
  $lowercase = preg_match('@[a-z]@', $password);
  $specialChars = preg_match('@[^\w]@', $password);
 
  if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
    $msg = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
  } else {
    $msg = "Your password is strong.";
  }
}



<?php
$password = $_POST['password'];
 
$number       = preg_match('@[0-9]@', $password);
$uppercase    = preg_match('@[A-Z]@', $password);
$lowercase    = preg_match('@[a-z]@', $password);
$specialChars = preg_match('@[^\w]@', $password);
 
if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
 echo "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
} else {
 echo "Your password is strong.";
}
?>


function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
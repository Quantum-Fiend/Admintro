 <?php
    include('db.php');

    if (isset($_POST['login_btn'])) {
        $username_login = $_POST['username'];
        $password_login = $_POST['password'];

        $query = "SELECT * FROM super_admin WHERE username='$username_login' AND password='$password_login' LIMIT 1";
        $query_run = mysqli_query($conn, $query);
        $usertypes = mysqli_fetch_array($query_run);

        if ($usertype['usertype'] == "super_admin") {
            $_SESSION['username'] = $username_login;
            header('Location: super-admin/dashboard.php');
        } elseif ($usertypes['usertype'] == "admin") {
            $_SESSION['username'] = $username_login;
            header('Location: admin/dashboard.php');
        } elseif ($usertype['usertype'] == "user") {
            $_SESSION['username'] = $username_login;
            header('Location: user/dashboard.php');
        } else {
            $_SESSION['status'] = "username / Password is Invalid";
            header('Location: index.php');
        }
    }
    ?>
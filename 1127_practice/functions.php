<?php 
session_start();

// 데이터베이스에 연결합니다.
$db = mysqli_connect('localhost', 'root', '', 'multi_login');

// 변수를 선언합니다.
$username = "";
$email    = "";
$errors   = array(); 

// 'register_btn'을 클릭하면 'register()' 함수를 호출합니다.
if (isset($_POST['register_btn'])) {
        register();
}

// 사용자를 등록하는 'register()' 함수입니다.
function register(){
        // 'register()' 함수에서 사용할 수 있도록 전역 키워드로 이러한 변수를 호출합니다
        global $db, $errors, $username, $email;

        // 폼에서 모든 입력 값을 받습니다. 'e()' 함수를 호출합니다.
    // 폼 값을 이스케이프하기 위해 아래에 정의됩니다.
        $username    =  e($_POST['username']);
        $email       =  e($_POST['email']);
        $password_1  =  e($_POST['password_1']);
        $password_2  =  e($_POST['password_2']);

        // 폼 유효성 검사 : 폼이 올바르게 작성되었는지 확인합니다.
        if (empty($username)) { 
                array_push($errors, "Username is required");
        }
        if (empty($email)) { 
                array_push($errors, "Email is required");
        }
        if (empty($password_1)) { 
                array_push($errors, "Password is required");
        }
        if ($password_1 != $password_2) {
                array_push($errors, "The two passwords do not match");
        }

        // 폼에 오류가 없으면 사용자를 등록합니다.
        if (count($errors) == 0) {
                $password = md5($password_1);// 데이터베이스에 저장하기 전에 비밀번호를 암호화합니다.

                if (isset($_POST['user_type'])) {
                        $user_type = e($_POST['user_type']);
                        $query = "INSERT INTO users (username, email, user_type, password) 
                                        VALUES('$username', '$email', '$user_type', '$password')";
                        mysqli_query($db, $query);
                        $_SESSION['success']  = "New user successfully created!!";
                        header('location: home.php');
                }else{
                        $query = "INSERT INTO users (username, email, user_type, password) 
                                        VALUES('$username', '$email', 'user', '$password')";
                        mysqli_query($db, $query);

                        // 생성된 사용자의 ID를 가져옵니다.
                        $logged_in_user_id = mysqli_insert_id($db);

                        $_SESSION['user'] = getUserById($logged_in_user_id); // 로그인한 사용자를 세션에 저장합니다.
                        $_SESSION['success']  = "You are now logged in";
                        header('location: index.php');
                }
        }
}

// ID에 따라 사용자 배열을 반환하는 'getUserById($id)' 함수입니다.
function getUserById($id){
        global $db;
        $query = "SELECT * FROM users WHERE id=" . $id;
        $result = mysqli_query($db, $query);

        $user = mysqli_fetch_assoc($result);
        return $user;
}

// 문자열 이스케이프를 하는 'e($val)' 함수입니다.
function e($val){
        global $db;
        return mysqli_real_escape_string($db, trim($val));
}

// 오류가 발생하면 'error'를 출력합니다.
function display_error() {
        global $errors;

        if (count($errors) > 0){
                echo '<div class="error">';
                        foreach ($errors as $error){
                                echo $error .'<br>';
                        }
                echo '</div>';
        }
}
// 로그인 여부를 확인하는 'isLoggedIn()' 함수입니다.
function isLoggedIn()
{
        if (isset($_SESSION['user'])) {
                return true;
        }else{
                return false;
        }
}

// 'register_btn'이 클릭되면 'login()' 함수를 호출합니다.
if (isset($_POST['login_btn'])) {
        login();
}

// 사용자 등록이 완료되었습니다.
if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['user']);
        header("location: login.php");
}

// 사용자 로그인을 하는 'login()' 함수 입니다.
function login(){
        global $db, $username, $errors;

        // 폼 값을 얻습니다.
        $username = e($_POST['username']);
        $password = e($_POST['password']);

        // 폼이 올바르게 작성되었는지 확인합니다.
        if (empty($username)) {
                array_push($errors, "Username is required");
        }
        if (empty($password)) {
                array_push($errors, "Password is required");
        }

        // 폼에 오류가 없으면 로그인을 시도합니다.
        if (count($errors) == 0) {
                $password = md5($password);

                $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
                $results = mysqli_query($db, $query);

                if (mysqli_num_rows($results) == 1) { // 사용자 찾기
                        // 사용자가 관리자 또는 일반 사용자인지 확인합니다.
                        $logged_in_user = mysqli_fetch_assoc($results);
                        if ($logged_in_user['user_type'] == 'admin') {

                                $_SESSION['user'] = $logged_in_user;
                                $_SESSION['success']  = "You are now logged in";
                                header('location: admin/home.php');
                        }else{
                                $_SESSION['user'] = $logged_in_user;
                                $_SESSION['success']  = "You are now logged in";

                                header('location: index.php');
                        }
                }else {
                        array_push($errors, "Wrong username/password combination");
                }
        }
}

// 사용자가 관리자인지 확인하는 'isAdmin()' 함수입니다.
function isAdmin()
{
        if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
                return true;
        }else{
                return false;
        }
}

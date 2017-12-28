<?php
/**
 * @Author  : Subraga Islammada <subraga.9310@students.amikom.ac.id>
 * @Date    : 12/15/17 - 1:50 AM
 */

class LoginController extends Controller {

    public function index() {

        $login = isset($_SESSION["ctfplat_usession"]) ? $_SESSION["ctfplat_usession"] : "";

        if($login) {
            $this->redirect("index.php");
        }

        $message = array();

        if($_SERVER["REQUEST_METHOD"] == "POST") {

            $message = array(
                'success'   => false,
                'message'   => 'Maaf Username/Password Salah.'
            );

            $username = isset($_POST["username"]) ? $_POST["username"] : "";
            $password = isset($_POST["password"]) ? $_POST["password"] : "";

            $this->model('user');

            $user = $this->user->getWhere(array(
                'name' => $username,
                'password' => md5($password)
            ));

            if(count($user) > 0) {

                $message    = array(
                    'success'   => true,
                    'message'   => 'Selamat anda berhasil login.'
                );

                $_SESSION["ctfplat_usession"] = $user[0];

                echo '<meta http-equiv="refresh" content="1;url=index.php">';

            }

        }

        $view = $this->view('login')->bind('message', $message);
    }

    public function logout() {
        unset($_SESSION["ctfplat_usession"]);
        $this->redirect('index.php');
    }
}
?>
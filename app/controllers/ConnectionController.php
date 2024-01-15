<?php
class ConnectionController extends Controller
{

  public function index()
  {

    if (isset($_SESSION['USER'])) {
      redirect('admin');
    }

    $this->view('login', ['pageState' => ['menu' => 'login']]);
  }

  public function login()
  {


    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHTTPREQUEST') {

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        if ($_SESSION['csrf_token'] === $_POST['csrf_token']) {


          $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
          $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

          $user = new User();
          $arr["username"] = $username;


          $result = $user->first($arr);
          if ($result) {
            if (password_verify($password, $result['password'])) {
              $_SESSION['csrf_token'] = bin2hex(random_bytes(32));


              $_SESSION['USER'] = [
                'username' => $result['username'],
                'role' => $user->getRole($result['id'])
              ];

              $response = [
                'status' => 'sucess',
                'message' => 'redirection vers admin.'
              ];
            }
          } else {

            sleep(2);

            $response = [
              'status' => 'error',
              'message' => 'Nom de compte ou mot de passe incorrect.'
            ];

          }

          // $_SESSION['ERRORS']['username'] = 'Nom du compte ou mot de passe incorrect';


        } else {

          $response = [
            'status' => 'error',
            'message' => 'La clé csfr ne correspond pas.'
          ];

          //  $_SESSION['ERRORS']['csfr'] = 'La clé csfr ne corresponds pas';
        }


      }

      header('Content-Type: application/json');
      http_response_code(HTTP_OK);
      echo json_encode($response);
    } else {
      http_response_code(HTTP_METHOD_NOT_ALLOWED);
      echo 'Method not allowed';
    }
    // isset($_SESSION["USER"]) ? $this->view('home') : $this->view('login');

  }

  public function logout()
  {

    if (!empty($_SESSION['USER'])) {
      unset($_SESSION['USER']);
    }
    redirect();

  }
}

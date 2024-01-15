<?php


final class UserAdminController extends Controller
{



  // Check if user is a "admin" and load users else redirect to gift page
  public function user()
  {

    if (isset($_SESSION['USER'])) {

      if ($_SESSION["USER"]["role"] === "admin") {

        $pageState = [
          'dashboard' => 'user',
          'currentPage' => (isset($_GET['page']) && ctype_digit($_GET['page'])) ? intval($_GET['page']) : 1,
          'search' => $_GET['search'] ?? '',
          'menu' => 'admin',
        ];



        if (isset($_GET['search'])) {

          $search = filter_input(INPUT_GET, "search", FILTER_SANITIZE_STRING);

          $pageState['search'] = $search;
        }
        try {
          $user = new User();

          $nbItems = $user->getCount($pageState['search']);
          $totalPages = ceil($nbItems / $user->getLimit());
          $first = ($pageState['currentPage'] * $user->getLimit()) - $user->getLimit();
          $user->setOffset($first);


          $users = $user->fetchData($pageState['search']);
          if (empty($users)) {
            if (!isset($search)) {
              $_SESSION['ALERTS']['users'] = 'Aucun utilisateurs ';

            } else {
              $_SESSION['ALERTS']['users'] = 'Aucun utilisateur trouvé pour <strong>' . $search . '</strong> ';

            }

          }

          $this->view("admin", ['users' => $users, 'pageState' => $pageState, 'totalPages' => $totalPages]);
        } catch (Exception $e) {
          $_SESSION['ERRORS']['users'] = 'Impossible de récupéré les utilisateurs error :' . $e->getMessage();
        }



      } else {

        redirect('admin/gifts');
      }

    } else {
      redirect('login');
    }


  }


  // function to delete user and display message 
  public function deleteUser($id)
  {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION["USER"])) {

      if ($_SESSION['csrf_token'] === $_POST['csrf_token'] && $_SESSION['USER']['role'] === 'admin') {

        try {
          $user = new User();

          $deletedUser = $user->where(['id' => $id]);

          $user->delete($id);


          $_SESSION['ALERTS']['delete'] = 'L\'utilisateur <strong>' . $deletedUser[0]['username'] . '</strong> à été supprimé';
        } catch (Exception $e) {
          $_SESSION['ERROS']['errors'] = 'Impossible de supprimé l\'utilisateur <strong>' . $deletedUser[0]['username'] . '</strong> error : ' . $e->getMessage();
        }

      }
    }

    redirect('admin/user');
  }


  // function to add user and display message 
  public function addUser()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION["USER"])) {

      if ($_SESSION['csrf_token'] === $_POST['csrf_token'] && $_SESSION['USER']['role'] === 'admin') {

        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');


        try {
          $user = new User();

          if (!$user->usernameExists($username)) {
            $arr["username"] = $username;
            //$arr["password"] = $password;
            $arr["password"] = password_hash($password, PASSWORD_DEFAULT);
            $arr["role_id"] = 2;




            $user->insert($arr);

            $_SESSION['ALERTS']['username'] = 'L\'utilisateur <strong>' . $username . '</strong> à été ajouté';

          } else {
            $_SESSION['ERRORS']['user'] = 'Un utilisateur avec ce nom existe déjà';

          }

        } catch (Exception $e) {
          $_SESSION['ERRORS']['user'] = 'Impossible d\'ajouter l\'utilisateur : ' . $e->getMessage();
        }

      }




    }
    redirect("admin/user");
  }

}

<?php
/**
 * Home Controller
 */
class HomeController extends Controller
{


  public function index()
  {
    $currentPage = 1;

    if ($_SERVER['REQUEST_METHOD'] === "GET") {

      if (isset($_GET['desc_page']))

        $currentPage = ($_GET['desc_page'] > 0 && !is_int($_GET['desc_page'])) ? (int) $_GET['desc_page'] : 1;


    }




    $gift = new Gift();
    $experiences = $this->fetchExperiences($currentPage);
    $gifts = $gift->fetchData();

    $this->view('home', ['experiences' => $experiences['experiences'] ?? [], 'totalPage' => $experiences['totalPages'] ?? [], 'gifts' => $gifts, 'currentPage' => $currentPage, 'pageState' => ['menu' => 'home']]);
  }




  private function fetchExperiences($currentPage = 1)
  {
    $experience = new Experience();
    $experience->setLimit(3);
    $nbItems = $experience->count(['validate' => 1]);

    if ($nbItems >= 1) {
      try {
        $totalPages = ceil($nbItems / $experience->getLimit());



        $currentPage = ($currentPage > $totalPages) ? $totalPages : $currentPage;
        $first = ($currentPage * $experience->getLimit()) - $experience->getLimit();
        $experience->setOffset($first);



        $experiences = $experience->where(['validate' => 1]);

        return ['experiences' => $experiences, 'totalPages' => $totalPages];

      } catch (Exception $e) {
        $_SESSION['ERRORS']['experience'] = 'Impossible de récupérer les expériences error : ' . $e->getMessage();
      }
    }

  }


  public function sendExperience()
  {

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHTTPREQUEST') {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if ($_SESSION['csrf_token'] === $_POST['csrf_token']) {


          $speudo = filter_input(INPUT_POST, "speudo", FILTER_SANITIZE_STRING);
          $description = filter_input(INPUT_POST, "experience", FILTER_SANITIZE_STRING);


          $experience = new Experience();

          try {
            $experience->insert(['speudo' => $speudo, 'description' => $description]);


            $response = [
              'status' => 'success',
              'message' => 'Expérience enregistrée avec succès.'

            ];

          } catch (Exception $e) {
            $response = [
              'status' => 'error',
              'message' => 'Impossible d\'enregistrer l\'expérience. error : ' . $e->getMessage(),
            ];
          }

        } else {

          $response = [
            'status' => 'error',
            'message' => 'La clé csrf ne correspond pas'
          ];

        }


      }

      header('Content-Type: application/json');
      http_response_code(HTTP_OK);
      echo json_encode($response);

    } else {
      http_response_code(HTTP_METHOD_NOT_ALLOWED);
      echo 'Method not allowed';
    }

  }



}



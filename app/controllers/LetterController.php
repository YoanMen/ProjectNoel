<?php
/**
 * Letter Controller
 */
class LetterController extends Controller
{

  public function index()
  {



    $this->view('letter');
  }


  public function sendLetter()
  {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHTTPREQUEST') {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {


      }
    }
  }

  public function removeWantedGift()
  {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHTTPREQUEST') {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

        $key = array_search($name, $_SESSION['wanted_gifts']);

        if ($key !== false) {
          unset($_SESSION['wanted_gifts'][$key]);

          $response = ['status' => 'sucess',
            'message' => 'wanted gift suprimé' . $key];


          header('Content-type: application/json');
          http_response_code(HTTP_OK);
          echo json_encode($response);
        } else {


          $response = ['status' => 'error',
            'message' => 'Impossible de supprimé le cadeau'];


          header('Content-type: application/json');
          http_response_code(HTTP_OK);
          echo json_encode($response);
        }
      }
    } else {

      $response = ['message' => "Method not alowed",
        'status' => 'error'];

      header('Content-Type: application/json');
      http_response_code(HTTP_BAD_REQUEST);
      echo json_encode($response);
    }
  }

  public function addWantedGift()
  {

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHTTPREQUEST') {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $search = filter_input(INPUT_POST, 'wanted_gift', FILTER_SANITIZE_STRING);



        try {
          $gift = new Gift();

          if (empty(trim($search)))
            throw new Exception("Ne dois pas être vide");


          if (!$gift->GiftExists($search)) {

            if (isset($_SESSION['wanted_gifts']) && in_array($search, $_SESSION['wanted_gifts'])) {
              throw new Exception("Déja une demande de cadeau avec ce nom");
            }


            $response = [
              'message' => 'Le cadeau à été ajouté',
              'status' => 'sucess'];

            $_SESSION['wanted_gifts'][] = $search;

          } else {

            throw new Exception("Un cadeau avec ce nom existe déjà");

          }


          header('Content-Type: application/json');
          http_response_code(HTTP_OK);
          echo json_encode($response);

        } catch (Exception $e) {

          $response = ['message' => $e->getMessage(),
            'status' => 'error'];

          header('Content-Type: application/json');
          http_response_code(HTTP_OK);
          echo json_encode($response);
        }

      } else {

        $response = ['message' => "Method not alowed",
          'status' => 'error'];

        header('Content-Type: application/json');
        http_response_code(HTTP_BAD_REQUEST);
        echo json_encode($response);
      }
    }
  }

  public function loadGifts()
  {

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHTTPREQUEST') {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $gifts = [];
        $wanted_gifts = [];

        if (isset($_SESSION['gifts'])) {

          foreach ($_SESSION['gifts'] as $gift => $value) {
            $gift = new Gift();

            $result = $gift->where(['id' => $value]);

            $gifts[] = [
              'id' => $value,
              'name' => $result[0]['name']
            ];

          }
        }



        if (isset($_SESSION['wanted_gifts'])) {

          foreach ($_SESSION['wanted_gifts'] as $gift => $value) {
            $wanted_gifts[] = ['name' => $value];
          }
        }


        $response = [
          'gifts' => $gifts,
          'wanted_gifts' => $wanted_gifts,
          'message' => 'Cadeaux chargés',
          'status' => 'sucess'
        ];


        header('Content-Type: application/json');
        http_response_code(HTTP_OK);
        echo json_encode($response);
      } else {

        $response = ['message' => 'Impossible de charger les cadeaux',
          'status' => 'error'];

        header('Content-Type: application/json');
        http_response_code(HTTP_OK);
        echo json_encode($response);
      }

    } else {
      http_response_code(HTTP_METHOD_NOT_ALLOWED);
      echo 'Method not allowed';
    }
  }



}


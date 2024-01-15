<?php

/**
 * Gifts Controller
 */
class GiftsroomController extends Controller
{


  public function index()
  {




    $pageState = [
      'currentPage' => (isset($_GET['page']) && ctype_digit($_GET['page'])) ? intval($_GET['page']) : 1,
      'category' => $_GET['category'] ?? 'all',
      'search' => $_GET['search'] ?? '',
      'order' => $_GET['order'] ?? 'new',
      'menu' => 'gift',
    ];




    $data = $this->fetchData($pageState['currentPage']);

    $this->view('giftsroom', ['gifts' => $data['gifts'], 'categorys' => $data['categorys'], 'totalPages' => $data['totalPages'], 'pageState' => $pageState]);


  }




  // Fetch data depending page and order/category selected
  private function fetchData($currentPage)
  {
    $category = new Category();
    $gift = new Gift();
    $gift->setLimit(8);

    $name = '';

    $categorys = $category->fetchAll();


    if (isset($_GET['order'])) {

      ($_GET['order'] == 'new') ? $gift->setOrderColumn("id") : $gift->setOrderColumn("recommended_age");

      switch ($_GET["order"]) {

        case ORDER_ASC:
          $gift->setOrderBy('asc');
          break;
        case ORDER_DESC:
          $gift->setOrderBy('desc');
          break;
      }
    }



    if (isset($_GET['search'])) {

      $name = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);


    }

    if (isset($_GET["category"]) && $_GET["category"] != 'all') {


      $category = filter_input(INPUT_GET, "category", FILTER_SANITIZE_STRING);



      $data = $this->getDataWithCategory($gift, $name, $category, $currentPage);


    } else {

      $data = $this->getData($gift, $name, $currentPage);
    }


    return ['gifts' => $data['gifts'], 'categorys' => $categorys, 'totalPages' => $data['totalPages'], 'currentCategory' => $name ?? 'all'];
  }


  private function getDataWithCategory($gift, $name, $category, $currentPage)
  {
    $nbItems = $gift->getCountCategory($category, $name);
    $totalPages = ceil($nbItems / $gift->getLimit());
    $first = ($currentPage * $gift->getLimit()) - $gift->getLimit();
    $gift->setOffset($first);
    $result = $gift->fetchWithCategory($category, $name);




    $gifts = $result ? $result : [];

    return ['gifts' => $gifts, 'totalPages' => $totalPages];
  }

  private function getData($gift, $name, $currentPage)
  {
    $nbItems = $gift->getCount($name);

    $totalPages = ceil($nbItems / $gift->getLimit());
    $first = ($currentPage * $gift->getLimit()) - $gift->getLimit();
    $gift->setOffset($first);
    $gifts = $gift->fetchData($name);


    return ['gifts' => $gifts, 'totalPages' => $totalPages];
  }




  public function detail($id)
  {


    $id = (int) strip_tags($id);

    $gift = new Gift();
    $image = new Image();

    $detail = $gift->first(["id" => $id]);
    $imagePath = $image->first(['gift_id' => $id]);

    $detail['image_path'] = $imagePath['path'];


    $pageState = [
      'menu' => 'gift',
    ];



    $detail ? $this->view('detail', ['gift' => $detail, 'pageState' => $pageState]) : redirect('giftsroom');

  }

  public function addGiftToLetter()
  {

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHTTPREQUEST') {

      if ($_SERVER['REQUEST_METHOD'] == "POST") {


        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);

        if (isset($id) && $id > 0) {
          $id = (int) strip_tags($id);

          $_SESSION['gifts'][] = $id;

          $response = ['message' => 'gift added',
            'status' => 'sucess'
          ];
        } else {
          $response = ['message' => 'cant add gift =>' . $id,
            'status' => 'error'
          ];
        }

        header('Content-type: application/json');
        http_response_code(HTTP_OK);
        echo json_encode($response);
      } else {

        $response = ['message' => 'cant add gift something wrong',
          'status' => 'error'
        ];
      }


    } else {


      $response = ['message' => 'no permission',
        'status' => 'error'
      ];
      header('Content-Type: application/json');
      http_response_code(HTTP_BAD_REQUEST);
      echo json_encode($response);
    }
  }

  public function removeGiftfromLetter($id = null)
  {

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHTTPREQUEST') {
      if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);


        if (isset($id) && $id > 0) {
          $id = (int) strip_tags($id);

          $key = array_search($id, $_SESSION['gifts']);

          if ($key !== false) {
            unset($_SESSION['gifts'][$key]);

            $response = ['message' => 'gift removed',
              'status' => 'sucess'
            ];
            header('Content-type: application/json');
            http_response_code(HTTP_OK);
            echo json_encode($response);
          }
        }
      } else {
        $response = ['message' => 'cant add gift',
          'status' => 'error'
        ];

      }
    } else {
      $response = ['message' => 'no permission',
        'status' => 'error'
      ];

      header('Content-Type: application/json');
      http_response_code(HTTP_BAD_REQUEST);
      echo json_encode($response);
    }
  }
}
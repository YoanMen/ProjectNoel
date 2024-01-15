<?php

class GiftAdminController extends Controller
{


  public function gift()
  {


    if (isset($_SESSION['USER'])) {


      $pageState = [
        'dashboard' => 'gift',
        'currentPage' => (isset($_GET['page']) && ctype_digit($_GET['page'])) ? intval($_GET['page']) : 1,
        'category' => $_GET['category'] ?? 'all',
        'search' => $_GET['search'] ?? '',
        'order' => $_GET['order'] ?? 'new',
        'menu' => 'admin'
      ];



      $gift = new Gift();
      $category = new Category();
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
        $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);

        $pageState['search'] = $search;
      }

      if (isset($_GET["category"]) && $_GET["category"] != 'all') {

        $category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);



        $nbItems = $gift->getCountCategory($category, $pageState['search']);
        $totalPages = ceil($nbItems / $gift->getLimit());
        $first = ($pageState['currentPage'] * $gift->getLimit()) - $gift->getLimit();
        $gift->setOffset($first);
        $result = $gift->fetchWithCategory($category, $pageState['search']);


        $gifts = $result ? $result : [];





        $data = ['gifts' => $gifts, 'totalPages' => $totalPages];


      } else {

        $nbItems = $gift->getCount($pageState['search']);

        $totalPages = ceil($nbItems / $gift->getLimit());
        $first = ($pageState['currentPage'] * $gift->getLimit()) - $gift->getLimit();
        $gift->setOffset($first);
        $gifts = $gift->fetchData($pageState['search']);


        $data = ['gifts' => $gifts, 'totalPages' => $totalPages];

      }


      if (empty($data['gifts'])) {
        if (!isset($search)) {
          $_SESSION['ALERTS']['gift'] = 'Aucun cadeaux ';

        } else {
          $_SESSION['ALERTS']['gift'] = 'Aucun cadeaux trouvé pour <strong>' . $search . '</strong> ';

        }
      }


      $this->view('admin', ['gifts' => $data['gifts'], 'categorys' => $categorys, 'totalPages' => $data['totalPages'], 'pageState' => $pageState]);


    } else {
      redirect('login');
    }



  }

  public function removeGift($id)
  {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION["USER"])) {

      if ($_SESSION['csrf_token'] === $_POST['csrf_token']) {


        try {

          $gift = new Gift();
          $image = new Image();

          $deletedGift = $gift->where(['id' => $id]);
          $imagePath = $image->first(['gift_id' => $id]);

          $gift->delete($id);

          if (isset($imagePath['path'])) {
            removeImage($imagePath['path']);
          }

          $_SESSION['ALERTS']['gifts'] = 'Le cadeau <strong>' . $deletedGift[0]['name'] . '</strong> à été supprimé';

        } catch (Exception $e) {
          $_SESSION['ERRORS']['errors'] = 'Impossible de supprimé le cadeaux  error : ' . $e->getMessage();
        }



      } else {
        $_SESSION['ERRORS']['errors'] = 'La clé csrf ne corresponds pas ';

      }


      redirect("admin/gift");

    } else {
      redirect('admin');
    }
  }

  public function addGift()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION["USER"])) {
      $name = filter_input(INPUT_POST, "name");
      $description = filter_input(INPUT_POST, "description");
      $age = $_POST['age'];
      $category = $_POST["category"];

      $gift = new Gift();
      $image = new Image();
      try {

        $setImage = setNewImage($name);

        if (!$gift->GiftExists($name) && isset($setImage)) {

          $gift->insert(['name' => $name, 'description' => $description, 'recommended_age' => $age, 'category_id' => $category]);
          $giftSaved = $gift->first(['name' => $name]);
          $image->insert(['gift_id' => $giftSaved['id'], 'path' => $setImage]);

          $_SESSION['ALERTS']['gift'] = 'Le cadeau <strong>' . $name . '</strong> à été ajouté';

        } else if ($gift->GiftExists($name)) {
          $_SESSION['ERRORS']['gift'] = 'Un cadeau avec le nom <strong>' . $name . '</strong> existe déjà';
        }
      } catch (Exception $e) {
        $_SESSION['ERRORS']['gift'] = 'Impossible d\'ajouter ' . $name . ' error :  ' . $e->getMessage();
      }



      redirect("admin/gift");


    } else {

      redirect("admin");
    }


  }





  public function updateGift($id)
  {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION["USER"])) {

      $name = filter_input(INPUT_POST, 'name');
      $description = filter_input(INPUT_POST, 'description');
      $age = $_POST["age"];
      $category = $_POST["category"];

      $gift = new Gift();
      try {
        $currentGift = $gift->first(['id' => $id]);

        if (!$gift->GiftExists($name) || $name == $currentGift['name']) {



          // Check if have a new image
          if ($_FILES['file']['error'] !== 4) {
            $image = new Image();
            $imagePath = $image->first(['gift_id' => $id]);


            // remove old image and replace
            if (isset($imagePath['path'])) {
              removeImage($imagePath['path']);
            }
            $setImage = setNewImage($name);


            $image->update($id, ['path' => $setImage], 'gift_id');

          } else if ($name != $currentGift['name']) {

            // if new name replace name of image
            $image = new Image();
            $imagePath = $image->first(['gift_id' => $id]);

            $newPath = renameImage($imagePath['path'], $name);

            $image->update($id, ['path' => $newPath], 'gift_id');

          }



          $gift->update($id, ['name' => trim($name), 'description' => trim($description), 'recommended_age' => $age, 'category_id' => $category]);


          $_SESSION['ALERTS']['gift'] = '<strong>' . $name . '</strong> à été modifier';

        } else {
          $_SESSION['ERRORS']['gift'] = 'Un cadeau avec le nom <strong>' . $name . '</strong> existe déjà';
        }
      } catch (Exception $e) {
        $_SESSION['ERRORS']['gift'] = 'Impossible de modifier <strong>' . $name . '</strong> error : ' . $e->getMessage();
      }


      redirect("admin/gift");


    } else {
      redirect("admin");

    }
  }



}


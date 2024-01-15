<?php


class ExperienceAdminController extends Controller
{

  public function experience()
  {

    if (isset($_SESSION['USER'])) {

      $pageState = [
        'dashboard' => 'experience',
        'currentPage' => (isset($_GET['page']) && ctype_digit($_GET['page'])) ? intval($_GET['page']) : 1,
        'menu' => 'admin',
      ];

      $experience = new Experience();
      $experience->setOrderColumn('validate');
      $experience->setOrderBy('asc');
      $nbItems = $experience->count();
      $totalPages = ceil($nbItems / $experience->getLimit());
      $first = ($pageState['currentPage'] * $experience->getLimit()) - $experience->getLimit();
      $experience->setOffset($first);


      $experiences = $experience->fetchAll();

      $this->view("admin", ['experiences' => $experiences, 'pageState' => $pageState, 'totalPages' => $totalPages]);


    } else {
      redirect('login');
    }


  }



  public function removeExperience($id)
  {
    $experience = new Experience();

    try {

      $experience->delete($id);

      $_SESSION['ALERTS']['experience'] = 'L\'expérience à été supprimé';


    } catch (Exception $e) {
      $_SESSION['ERRORS']['experience'] = 'Impossible de supprimer l\'expérience error : ' . $e->getMessage();
    }


    redirect("admin/experience");

  }


  public function validateExperience($id)
  {
    $experience = new Experience();

    try {
      $exp = $experience->where(['id' => $id]);

      $experience->update($id, ['validate' => $exp[0]['validate'] ? 0 : 1]);



      if ($exp[0]['validate'] == 0) {

        $_SESSION['ALERTS']['experience'] = 'L\'expérience à été validé';
      } else {
        $_SESSION['ALERTS']['experience'] = 'L\'expérience n\'est plus valide ';

      }


    } catch (Exception $e) {
      $_SESSION['ERRORS']['experience'] = 'Impossible de gérer la validation error : ' . $e->getMessage();
    }


    redirect("admin/experience");


  }




}

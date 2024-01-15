<?php

class AdminController extends Controller
{
  public function index()
  {
    if (isset($_SESSION["USER"])) {

      if ($_SESSION['USER']['role'] == 'admin') {
        redirect('admin/user');
      } else {
        redirect('admin/gift');

      }

    } else {
      redirect('login');
    }
  }




}
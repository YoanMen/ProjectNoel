<?php

/** 
 * Letter Model
 */
final class Letter
{
  use Model;

  protected $table = "letter";
  protected $allowedColumns = [
    "id",
    "name",
    "description",
    "recommended_age",
  ];

}
<?php

/** 
 * Category Model
 */
final class Category
{
  use Model;

  protected $table = "category";
  protected $allowedColumns = [
    "id",
    "name",
  ];

}
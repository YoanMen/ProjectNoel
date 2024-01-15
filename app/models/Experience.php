<?php

/** 
 * Experience Model
 */
final class Experience
{
  use Model;

  protected $table = "experience";
  protected $allowedColumns = [
    "id",
    "speudo",
    "description",
    "validate"
  ];



}
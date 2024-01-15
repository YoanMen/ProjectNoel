<?php

final class Image
{
  use Model;


  protected $table = "image_gift";
  protected $allowedColumns = [
    "gift_id",
    "path",
  ];


}

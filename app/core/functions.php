<?php

function debugPrint($stuff)
{

  echo '<pre>';
  print_r($stuff);
  echo '</pre>';
}

function convertToDash($string)
{
  return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $string));
}

function esc($str)
{
  return htmlspecialchars($str);
}


function redirect($path = '')
{
  header('Location: ' . ROOT . '/' . $path);
  die;
}


function setNewImage(string $name): string
{

  if (isset($_FILES['file'])) {

    $uploaddir = 'uploads/';



    $extension = explode('/', $_FILES['file']['type']);
    $tempFile = explode('/', $_FILES['file']['tmp_name']);
    $tempFile = end($tempFile);
    $fileSize = $_FILES['file']['size'];

    if ($fileSize > MAX_FILE_SIZE || $fileSize === 0) {

      throw new Exception('L\'image est trop volumineuse');
    } else if (!in_array(strtolower(end($extension)), ALLOWED_EXTENSIONS_FILE)) {
      throw new Exception('Le format n\'est pas le bon, utiliser png, jpeg, jpg');
    }


    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir . str_replace(' ', '', $name) . '.' . end($extension))) {

      return $uploaddir . str_replace(' ', '', $name) . '.' . strtolower(end($extension));

    } else {
      throw new Exception("Impossible d'enregistrer l'image");

    }

  }

  throw new Exception('Pas reussi à télécharger image');
}

function renameImage($oldPath, $name)
{
  $extension = explode('.', $oldPath);
  $new = DESTINATION_IMAGE_FOLDER . $name . '.' . end($extension);
  try {
    rename($oldPath, $new);

  } catch (Exception $e) {
    throw new Exception('Impossible de renommer l\'image error : ' . $e->getMessage());
  }

  return $new;
}

function removeImage(string $path)
{
  try {
    unlink($path);
  } catch (Exception $e) {
    throw new Exception("Impossible de supprimer l\'image error : " . $e->getMessage());

  }

}

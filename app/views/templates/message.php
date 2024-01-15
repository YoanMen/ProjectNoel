<?php

if (isset($_SESSION['ERRORS']) && !empty($_SESSION['ERRORS'])) {
    echo '<div class="error">';
    foreach ($_SESSION['ERRORS'] as $error) {
        echo '<p>' . $error . '</p>';
    }
    echo '</div>';


    unset($_SESSION['ERRORS']);
}


if (isset($_SESSION['ALERTS']) && !empty($_SESSION['ALERTS'])) {
    echo '<div class="alert">';
    foreach ($_SESSION['ALERTS'] as $alert) {
        echo '<p>' . $alert . '</p>';
    }
    echo '</div>';


    unset($_SESSION['ALERTS']);
}
?>
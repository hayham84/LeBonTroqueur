<?php
/**
 * Php control file to log out.
 */
session_start();
session_destroy();
header('Location: index.php');
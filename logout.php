<?php

session_start();

session_destroy();

$_SESSION = array(); //reinitializing

header('Location: index.html'); //redirect


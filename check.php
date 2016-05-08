<?php

//if it`s not logged in - calendar is not available
if(!isset($_SESSION['username']))
    header('Location: index.html'); //redirect

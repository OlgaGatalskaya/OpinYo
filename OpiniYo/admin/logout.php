<?php

session_start();

session_unset();
session_destroy();

// Перенаправление на index.php
header('Location: index.php');
exit();
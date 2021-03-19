<?php

$link = mysqli_connect('localhost', 'root', 'toor', 'inventory');

if (!$link) {
  die('Connect Error: ' . mysqli_connect_error());
}
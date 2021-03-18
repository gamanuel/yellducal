<?php
  require_once 'routeClass.php';
  require_once 'controller/authController.php';
  require_once 'controller/usersController.php';

  
  $r = new Router();
  
  
  $r->addRoute("login", "GET", "homeController", "login"); 
  $r->addRoute("auth", "POST", "authController", "authenticate"); 

  $r->addRoute("users", "GET", "usersController", "users"); 
  $r->addRoute("users", "POST", "usersController", "add"); 
  $r->addRoute("users/:id", "POST", "usersController", "update"); 
  $r->addRoute("users/:id", "DELETE", "usersController", "delete"); 

  $r->route($_GET['action'], $_SERVER['REQUEST_METHOD']);

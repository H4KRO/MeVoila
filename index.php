<?php
require_once('app/config/config.php');
require_once('app/Database/Database.php');
Database::init();
require_once('app/config/router.php');
require_once('app/Model/PageModel.php');
require_once('app/Model/UserModel.php');
require_once('app/Model/ParameterModel.php');
require_once('app/Model/NavigationModel.php');

$routes = array(
  "/" => route("MainController", "index"),
  "/*lang/" => route("MainController", "index"),
  "/*lang/page/" => route("PageController", "main"),
  "/page/" => route("PageController", "main"),
  "/*lang/page/*page/" => route("PageController", "page"),
  "/page/*page/" => route("PageController", "page")
);

exec_route($routes);

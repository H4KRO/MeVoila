<?php
require_once('app/config/config.php');
require_once('app/Database/Database.php');
Database::init();
require_once('app/config/router.php');

$routes = array(
  "/" => route("MainController", "index"),
  "/blog/" => route("BlogController", "main"),
  "/blog/*" => route("BlogController", "category"),
  "/blog/*/*" => route("BlogController", "article"),
  "/portfolio/" => route("PortfolioController", "main"),
  "/portfolio/*" => route("PortfolioController", "category"),
  "/portfolio/*/*" => route("PortfolioController", "project")
);

echo "<pre>";
print_r(exec_route($routes));
echo "</pre>";

<?php

/**
 * Start the application
 */

require "../application/bootstrap.php";
Bootstrap::run($_SERVER["REQUEST_URI"]);
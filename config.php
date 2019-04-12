<?php

/**
 * Configuration for database connection
 *
 */
$GLOBALS['state'] = 0; // 0 means logged out, 1 means logged in
$host       = "localhost";
$username   = "root";
$password   = "#1Password";
$dbname     = "assignment2";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );

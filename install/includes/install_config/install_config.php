<?php

/**
 * PRECONFIGURATION
 */
$http_scheme = is_https() ? "https" : "http";

// Config Paths
$db_config_path = '../application/config/';
if (isset($_ENV['CI_ENV'])) {
	$db_config_path = '../application/config/' . $_ENV['CI_ENV'] . '/';
}
$db_file_path = $db_config_path . "database.php";

// Logfile Path
global $logfile;
$logfile = '../application/logs/installer_debug.log';

// Wanted Pre-Check Parameters
// PHP
$min_php_version = '8.2.0';  		// below this version is no install possible
$min_php_version_warning = '8.3.0'; 	// below this version some features may not available (e.g. Cronmanager)
$max_execution_time = 600;		// Seconds
$upload_max_filesize = 8;  		// Megabyte
$memory_limit = 256;			// Megabyte
$post_max_size = 8;			// Megabyte
$req_allow_url_fopen = '1';		// 1 = on

// Array of PHP modules to check
global $required_php_modules;

$mysql_available = isExtensionInstalled('mysqli');
$postgres_available = isExtensionInstalled('pgsql');

$required_php_modules = [
	'php-curl' 		=> ['condition' => isExtensionInstalled('curl')],
	(
		$mysql_available
		? 'php-mysql'
		: ($postgres_available ? 'php-pgsql' : 'php-mysql || php-pgsql')
	) 			=> ['condition' => $mysql_available || $postgres_available],
	'php-mbstring' 		=> ['condition' => isExtensionInstalled('mbstring')],
	'php-xml' 		=> ['condition' => isExtensionInstalled('xml')],
	'php-zip' 		=> ['condition' => isExtensionInstalled('zip')],
	'php-gd' 		=> ['condition' => isExtensionInstalled('gd')],
];

// MariaDB / MySQL
$mariadb_version = 10.11;
$mysql_version = 8.0;

// PHP modules that are directly required for the installer
global $installer_required_modules;
$installer_required_modules = array("mbstring", "curl");

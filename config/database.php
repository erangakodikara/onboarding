<?php

//// Import data from file.
define("DATA_FILE", "src/dao/db/resource/export.csv");
define("CHART_DATA_TABLE","onboard_data");

// Import data from database.
define("DB_DRIVER", "mysql");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_DATABASE", "onboard");
define("DB_CHARSET", "utf8");

//// Import data from database for unit testing.
//define("DB_DRIVER", "mysql");
//define("DB_HOST", "localhost");
//define("DB_USER", "root");
//define("DB_PASS", "root");
//define("DB_DATABASE", "onboard_test_db");
//define("DB_CHARSET", "utf8");
//define("DATA_FILE", "src/dao/db/resource/export_test.csv");
//define("CHART_DATA_TABLE","onboard_data");
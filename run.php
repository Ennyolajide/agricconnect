<?php

require_once 'src/Classes/Db.php';

require_once 'src/Classes/DbSeed.php';

require_once 'vendor/autoload.php'; 


use Classes\Db;
use Classes\DbSeed;

(new DbSeed(new Db()))->seedPostCategories();

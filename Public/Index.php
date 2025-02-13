<?php

// Autoload required classes using Composer's autoloader.
require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Database;
use App\Models\DataModel;
use App\Controllers\DataController;
use Pecee\SimpleRouter\SimpleRouter;

/**
 * Initialize the database connection using the Database class.
 *
 * The getInstance() method returns a PDO instance configured with 
 * the application's settings.
 */
$pdo = Database::getInstance();

/**
 * Create the DataModel and DataController instances.
 *
 * DataModel handles the data access layer and accepts a PDO instance.
 * DataController manages the HTTP requests and responses.
 */
$dataModel     = new DataModel($pdo);
$dataController = new DataController($dataModel);

/**
 * Define application routes using SimpleRouter.
 *
 * The GET route for the root ('/') displays the data table view.
 * The POST route '/data/fetch' handles AJAX requests to fetch data.
 */
SimpleRouter::get('/', function () use ($dataController) {
    $dataController->index();
});

SimpleRouter::post('/data/fetch', function () use ($dataController) {
    $dataController->fetchData();
});

/**
 * Start the routing process.
 *
 * SimpleRouter::start() begins processing the incoming request and
 * dispatches it to the appropriate route callback.
 */
SimpleRouter::start();

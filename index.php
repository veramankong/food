<?php
/** Created by PhpStorm... */

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();

//define a default route
$f3->route('GET /', function() {

    //Display home view
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define a breakfast route
$f3->route('GET /breakfast', function() {

    //Display breakfast view
    $view = new Template();
    echo $view->render('views/breakfast.html');
});

//Define a continental breakfast route
$f3->route('GET /continental', function() {

    //Display breakfast view
    $view = new Template();
    echo $view->render('views/bfast-cont.html');
});

//Define a lunch route
$f3->route('GET /lunch', function() {

    //Display lunch view
    $view = new Template();
    echo $view->render('views/lunch.html');
});

//Define a buffet route
$f3->route('GET /lunch/brunch/buffet', function() {

    //Display lunch view
    $view = new Template();
    echo $view->render('views/buffet.html');
});

//Route with parameters
$f3->route('GET /@item', function($f3, $params) {

    $item = $params['item'];
    //validate
    $foodWeServe = array('spaghetti', 'enchiladas', 'pad thai');

    if (!in_array($item, $foodWeServe)) {
        echo "We don't serve $item";
    }

    switch ($item) {
        case 'spaghetti':
            echo "<h3>I like $item with meatballs.</h3>";
            break;
        case 'pizza':
            echo "<h3>Pepperoni or veggie?</h3>";
            break;
        case 'tacos':
            echo "<h3>We don't have $item.</h3>";
        case 'bagel':
            $f3->reroute("/continental");
        default:
            $f3->error(404);
    }
});

//Name route
$f3->route('GET /@first/@last', function($f3, $params) {

    $first = $params['first'];
    $last = $params['last'];

    echo "<h3>Hello $first $last!</h3>";

});

//Run fat free
$f3->run();

?>
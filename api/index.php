<?php
/**
 * API of the poets application
 * 
 * @author  Arturo Mora-Rioja (amri@kea.dk)
 * @version 1.0.0 August 2022
 * @version 2.0.0 March 2024 API turned RESTful
 */

require_once __DIR__ . '/../classes/utils.php';

header('Content-Type: application/json');
header('Accept-version: v1');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    Utils::leave(405);
}

if (!isset($_GET['entity']) || !isset($_GET['information'])) {
    echo Utils::addHATEOAS();
} else {
    http_response_code(200);

    $entity = $_GET['entity'];
    $information = $_GET['information'];
    
    switch ($entity) {
        case 'catalog':
            require_once __DIR__ . '/../classes/catalog.php';
            $catalog = new Catalog();
            
            switch ($information) {
                case 'authors':
                    echo Utils::addHATEOAS($catalog->getAuthors());
                    break;
                default:
                    Utils::leave();
                }
                break;
        case 'author':
            if (!isset($_GET['name'])) {
                Utils::leave();
            } else {
                require_once __DIR__ . '/../classes/author.php';
                $name = $_GET['name'];

                $author = new Author($name);
                switch ($information) {
                    case 'info':
                        echo Utils::addHATEOAS($author->getInfo());
                        break;
                    case 'poems':
                        echo Utils::addHATEOAS($author->getPoems());
                        break;
                    default:
                        Utils::leave();
                }
            }                    
            break;
        case 'poem':
            if (!isset($_GET['authorName']) || !isset($_GET['title'])) {
                Utils::leave();
            } else {
                require_once __DIR__ . '/../classes/poem.php';
                $authorName = $_GET['authorName'];
                $title = $_GET['title'];

                $poem = new Poem($authorName, $title);
                switch ($information) {
                    case 'text':
                        echo Utils::addHATEOAS($poem->getText());
                        break;
                    default: 
                        Utils::leave();
                }
            }
            break;
        default:
            Utils::leave();
    }
}
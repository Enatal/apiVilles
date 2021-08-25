<?php
session_start();

/***** SETTINGS/CONSTANTES *****/
// On définit les différents modes d'accès aux données
define("PDO", 0) ; // connexion par PDO
define("MEDOO", 1) ; // Connexion par Medoo
// Choix du mode de connexion
define("DB_MANAGER", MEDOO); // PDO ou MEDOO
// Création de deux constantes URL et FULL_URL qui pourront servir dans les controlleurs et/ou vues
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
define("FULL_URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]/{$_SERVER['REQUEST_URI']}"));


/***** REQUIRES/INCLUDES *****/
// Chargement du framework Medoo
include_once ("./librairies/medoo/Medoo.php");
// on charge le fichier qui contient les fonctions supplémentaires qu'on va utiliser dans la vue
require_once "helpers/string_helper.php";
require_once "helpers/exists_helper.php";
// inclusion des controllers
require_once "controllers/WelcomeController.php";
require_once "controllers/UsersController.php";
require_once "controllers/CitiesController.php";


/****** ROUTING *********/
//réalisation du système de routage
// le fichier .htccess effectue une redirection automatique depuis l'url /nom_de_la_route vers index.php?page=nom_de_la_route
// on va donc gérer notre routage depuis le paramètre $_GET["page"]
try
{

    $request_method = $_SERVER["REQUEST_METHOD"];
    // analyse de la methode de requête
    switch ($request_method) {
        case 'GET':
            // si $_GET['page'] est vide alors on charge simplement la page d'index
            if (empty($_GET['page'])) 
            {
                $controller = new WelcomeController();
                $controller->index();
            }
            else // sinon on traite au cas par cas nos routes
            {
                // on décompose le paramètre $_GET['page'] d'après le "/"
                $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
                // on regarde le premier élément de la route
                switch ($url[0]) 
                {
                    // route "/simple"
                    case "simple":
                        $controller = new WelcomeController();
                        $controller->simple();
                        break;

                    // routes "/index" ou "/home", si plusieurs routes ont le même résultat on peut les enchainer comme ça
                    case "index":
                    case "home":
                        $controller = new WelcomeController();
                        $controller->index();
                        break;

                    // route "/elements"
                    case "elements":
                        $controller = new WelcomeController();
                        $controller->elements();
                        break;

                    // route "/generic"
                    case "generic":
                        $controller = new WelcomeController();
                        $controller->generic();
                        break;

                    // route "/generic2", il s'agit du même resultat que "/generic" mais avec une
                    // vue décomposée en header/navbar/footer
                    case "generic2":
                        $controller = new WelcomeController();
                        $controller->generic2();
                        break;

                    // route "/testjson", par exemple réponse à un appel AJAX
                    case "testjson":
                        $controller = new WelcomeController();
                        $controller->testjson();
                        break;

                    // route "/allusers", qui utilise le modèle et la base de données
                    case "allusers":
                        // à noter qu'ici on a fait le choix d'utiliser un autre controller
                        $controller = new UsersController();
                        $controller->display_all_users();
                        break;

                    // route "/user/(:number)", qui utilise le modèle et la base de données (exemple : /user/1)
                    case "user":
                        // on récupère ensuite l'id du user
                        $id_user = $url[1] ; // on peut rajouter des vérifications, notamment si l'id n'est pas un nombre ou si l'url est mal formée
                        $controller = new UsersController();
                        $controller->display_user($id_user);
                        break;
                    
                    // endpoint /ville/{code_postal} /ville{code_postal}/{id}
                    case "ville":
                        if(array_key_exists(1,$url)){
                            if(array_key_exists(2,$url)){
                                if(is_numeric($url[2])){
                                    $controller = new CitiesController();
                                    $controller->outputCityByid($url[2]);
                                }
                            }else{
                                if(count(str_split($url[1]))==5 && is_numeric($url[1])){
                                    $controller = new CitiesController();
                                    $controller->outputCitiesByPostCode($url[1]);
                                }else{
                                    throw new Exception("le code postal est composé de 5 chiffres");
                                }
                            }
                        }else{
                            throw new Exception("requête incomplète");
                        }
                        break;

                    // endpoint /population/{code_postal}
                    case "population":
                        if(array_key_exists(1,$url)){
                            if(count(str_split($url[1]))==5 && is_numeric($url[1])){
                                $controller = new CitiesController();
                                $controller->outputPopulationsByPostCode($url[1]);
                            }else{
                                throw new Exception("le code postal est composé de 5 chiffres");
                            }
                        }else{
                            throw new Exception("requête incomplète");
                        }
                        break;

                    // endpoint /superficie/{code_postal}
                    case "superficie":
                        if(array_key_exists(1,$url)){
                            if(count(str_split($url[1]))==5 && is_numeric($url[1])){
                                $controller = new CitiesController();
                                $controller->outputAreasByPostCode($url[1]);
                            }else{
                                throw new Exception("le code postal est composé de 5 chiffres");
                            }
                        }else{
                            throw new Exception("requête incomplète");
                        }
                        break;

                        // endpoint /villes/{code_departement} et :villes/{code_departement/code_canton}
                    case "villes":
                        if(array_key_exists(1,$url)){
                            if(array_key_exists(2,$url)){
                                if(count(str_split($url[2]))==2 && is_numeric($url[2])){
                                    $controller = new CitiesController();
                                    $controller->getCitiesByCantonInDept($url[1],$url[2]);
                                }else{
                                    throw new Exception("le code du canton est composé de 2 chiffres");
                                }
                            }else{
                                if(count(str_split($url[1]))>=2 && count(str_split($url[1]))<=3 && is_numeric($url[1])){
                                    $controller = new CitiesController();
                                    $controller->outputCitiesByDept($url[1]);
                                }else{
                                    throw new Exception("le code du departement est composé de 2 ou 3 chiffres");
                                }
                            }
                        }else{
                            throw new Exception("requête incomplète");
                        }
                        break;
                        case 'post.php' :
                            $controller = new WelcomeController();
                            $controller->testPost();
                            break;
                        
                        case 'put.php' :
                            $controller = new WelcomeController();
                            $controller->testPut();
                            break;
                // route chargée par défaut si aucune autre route n'a été chargée
                    default:
                        throw new Exception("La page n'existe pas");
                }
            }
            break;

        case 'POST':
            // si $_GET['page'] est vide alors on charge simplement la page d'index
            if (empty($_GET['page'])) 
            {
                throw new Exception ("aucun endpoint défini");
            }
            else // sinon on traite au cas par cas nos routes
            {
                // on décompose le paramètre $_GET['page'] d'après le "/"
                $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
                // on regarde le premier élément de la route
                switch ($url[0]) 
                {
                    case "ville":
                        $controller = new CitiesController();
                        $controller->recordNewCity($_POST);
                        break;
                    default :
                    throw new Exception ("mauvaise requete");
                }
            }
            break;

        case 'PUT':

             // si $_GET['page'] est vide alors on charge simplement la page d'index
             if (empty($_GET['page'])) 
             {
                 throw new Exception ("aucun endpoint défini");
             }
             else // sinon on traite au cas par cas nos routes
             {
                 // on décompose le paramètre $_GET['page'] d'après le "/"
                 $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
                 // on regarde le premier élément de la route
                 switch ($url[0]) 
                 {   
                     // endpoint PUT /ville/{code_postal} et /ville/{code_postal}/{id}
                     case "ville":
                        if(array_key_exists(1,$url)){
                            if(array_key_exists(2,$url)){
                                if(is_numeric($url[2])){
                                    $_PUT = array();
                                    parse_str(file_get_contents('php://input'), $_PUT);
                                    $controller = new CitiesController();
                                    $controller->ModifyCitiesById($url[2],$_PUT);
                                }else{
                                    throw new Exception ("L'identifiant est comosé de chiffres"); 
                                }
                            }else{
                                if(count(str_split($url[1]))==5 && is_numeric($url[1])){
                                    $_PUT = array();
                                    parse_str(file_get_contents('php://input'), $_PUT);
                                    $controller = new CitiesController();
                                    $controller->ModifyCitiesByPostCode($url[1],$_PUT);
                                }else{
                                    throw new Exception("le code postal est composé de 5 chiffres");
                                }
                            }
                            
                        }else{
                            throw new Exception("requête incomplète");
                        }
                         break;
                     default :
                     throw new Exception ("mauvaise requete");
                 }
             }
             break;
 

        case 'DELETE':
            break;

        default:
            header("HTTP/1.0 405 Method Not Allowed");
            break;
    }
   
} catch (Exception $e) {
    // en cas d'exeption l
    echo $e->getMessage();
}

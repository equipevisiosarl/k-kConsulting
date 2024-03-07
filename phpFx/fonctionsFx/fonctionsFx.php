<?php


function debug($value)
{ //permet de debuguer
    echo   '<pre>';
    print_r($value);
    echo '</pre>';
}

function str_plural($chaine)
{ // verifies s il a s a un string si non ajoute s et return le string
    // Vérifier si la chaîne se termine par "s"
    if (substr($chaine, -1) !== "s") {
        // Ajouter "s" à la fin de la chaîne
        $chaine .= "s";
    }

    // Retourner le résultat
    return $chaine;
}

function findToIncludeFile($directory, $searchString)
{

    $find = false;
    $filePath = '';
    // Parcours du dossier
    foreach (scandir($directory) as $file) {
        // Exclure les dossiers spéciaux
        if ($file != '.' && $file != '..') {
            // Chemin complet du fichier
         $filePath = $directory . '/' . $file;
            // Vérifier si le fichier contient la chaîne
            // $fileContent = file_get_contents($filePath);
            if (getStringAfterLastUnderscore($filePath) == $searchString) {
                // Inclure le fichier si la chaîne est trouvée
                $find = true;
                break;
            }

           
        }
    }

    if ($find) {
        return $filePath;
    }

    return false;
}


function getStringAfterLastUnderscore($chaine) {
    $positionDernierUnderscore = strrpos($chaine, '_');
    
    if ($positionDernierUnderscore === false) {
        return $chaine; // Retourne la chaîne entière si aucun "_" n'est trouvé
    } else {
        return substr($chaine, $positionDernierUnderscore + 1);
    }
}

//genere un token ou mot de passe
function getToken()
{
    // Stockez toutes les lettres possibles dans une chaîne.
    $str = '0123456789abcdefghijklmnopqrstuvwxy@+%/_-?!zABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $n = rand(16, 32);
    $a = date("Ymhis") / rand();
    $randomStr = '';
    // Générez un index aléatoire de 0 à la longueur de la chaîne -1.
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($str) - 1);
        $randomStr .= $str[$index];
    }

    return $randomStr;
}


function crsf()
{
    $token = sha1(md5(date('Y-m-d H:i:s')));
    $_SESSION['crsf'] = $token;
    return '<input type="hidden" name="token_crsf" value="'.$token.'" />"';
}

function old_value(string $key)
{
    if (isset($_SESSION['post'][$key])) {
        $value = $_SESSION['post'][$key];
        unset($_SESSION['post'][$key]);
        return $value;
    }
}

function error($propertie)
{
    if (isset($_SESSION['errors'][$propertie])) {
        $value = '<font color="red">' . $_SESSION['errors'][$propertie] . '</font>';
        unset($_SESSION['errors'][$propertie]);
        return $value;
    }
}


// lire un message
function read_message()
{
    if (isset($_SESSION['message'])) {

        echo   $_SESSION['message'];


        unset($_SESSION['message']);
    }
}

//fonction message flash alerte
function message_flash($message, $color)
{
    $flash = '

    <div class="alert alert-' . $color . ' alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Alerte!  </strong>' . $message . ' 
    <span aria-hidden="true">&times;</span>
    </div>
    
    ';

    return $flash;
}



function flash($etat, $message)
{
    switch ($etat) {
        case 'success':
            unset($_SESSION['post']);
            $_SESSION['message'] = message_flash($message, 'success');
            break;

        case 'error':
            $_SESSION['message'] = message_flash($message, 'danger');
            break;

        default:
            $_SESSION['message'] = message_flash($message, 'secondary');
            break;
    }
}

function user_session($key){
    $value = null;
    if (isset($_SESSION['USER'][$key])) {
        $value  =  $_SESSION['USER'][$key];
    }

    return $value;
   
}



/*************************************************************************************** */


// supprime tout les nombres
function clear_number($string)
{
    $pattern = "/\d+/i";
    return preg_replace($pattern, "", $string);
}

// supprime tout les lettre
function clear_string($string)
{
    $pattern = "/[^0-9]/i";
    return preg_replace($pattern, "", $string);
}

function supp_expression($expression, $string)
{
    $nouvelleChaine = str_replace($string, "", $expression);
    return $nouvelleChaine;
}



function ajout_zero($numero)
{
    if ($numero < 10) {
        $zero = '00';
    } elseif ($numero >= 10 && $numero < 100) {
        $zero = '0';
    } elseif ($numero >= 100) {
        $zero = "";
    }

    return $zero.$numero;
}

function formatDate($date){
$dateTime = new DateTime($date);
$formattedDate = $dateTime->format('d/m/Y H:i');

return $formattedDate;

}

function formatDate_simple($date){
    $dateTime = new DateTime($date);
    $formattedDate = $dateTime->format('d/m/Y');
    
    return $formattedDate;
    
    }

function extract_last_string($string, $parametre = '-' ){
    $result = substr(strrchr($string, $parametre), 1);
    return $result;
}

function supprimerEspaces($chaine) {
    return preg_replace('/\s/', '', $chaine);
  }


  function transf_date_rdv_oneWeek ($date){
    $date_depart = $date;
$date_depart_objet = DateTime::createFromFormat('d/m/Y H:i', $date_depart);
$date_depart_formattee = $date_depart_objet->format('d-m-Y');
$date_arrivee_objet = $date_depart_objet->modify('+1 week');
$date_arrivee_formattee = $date_arrivee_objet->format('d-m-Y');
return $date_arrivee_formattee;

  }

/**************************************************************************************** */
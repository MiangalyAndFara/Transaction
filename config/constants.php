<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Display Debug backtrace
  |--------------------------------------------------------------------------
  |
  | If set to TRUE, a backtrace will be displayed along with php errors. If
  | error_reporting is disabled, the backtrace will not display, regardless
  | of this setting
  |
 */
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
  |--------------------------------------------------------------------------
  | Exit Status Codes
  |--------------------------------------------------------------------------
  |
  | Used to indicate the conditions under which the script is exit()ing.
  | While there is no universal standard for error codes, there are some
  | broad conventions.  Three such conventions are mentioned below, for
  | those who wish to make use of them.  The CodeIgniter defaults were
  | chosen for the least overlap with these conventions, while still
  | leaving room for others to be defined in future versions and user
  | applications.
  |
  | The three main conventions used for determining exit status codes
  | are as follows:
  |
  |    Standard C/C++ Library (stdlibc):
  |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
  |       (This link also contains other GNU-specific conventions)
  |    BSD sysexits.h:
  |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
  |    Bash scripting:
  |       http://tldp.org/LDP/abs/html/exitcodes.html
  |
 */
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
//dev 113 : Statut des utilsateurs
define('CLIENT', 1);
define('CADRE', 2);
define('GERANT',3);
define('CHEF_DE_PROJET',4);
define('RESPONSABLE_TECH',5);
define('COMMERCIAL', 6);
define('EMPLOYE', 7);
define('DEVELOPPEUR', 8);
define('INTEGRATEUR', 9);
define('TESTEUR', 10);
define('ASSISTANT_DE_DIRECTION', 11);
define('NON_EMP',0);
define('IS_EMP',1);

//dev112 valeur calcul difference
define('DIFF_AGE_MAX', 18);
define('DIFF_AGE_MIN', 78);
define('DIFF_ENTREE_MAX', 0);
define('DIFF_ENTREE_MIN', 1900);
define('CIN_VALID', 12);
define('DIFF_CONGE_MAX',7);
define('DIFF_CONGE_MIN',0.5);
define('CONGE_MOIS',2.5);
define('CONGE_ANNEE',30);
//dev112
define('Errors_RequiredField', "Champ obligatoire");
define('Errors_ToShortField', "Mot de passe supérieur ou égal à 8 caractères");
define('Errors_RequiredNumeric', "Ne doit contenir que des chiffres");
define('Errors_UserAlreadyInsert', "Utilisateur dejà inscrit");
define('Errors_DateInvalid', "Date invalide");
define('Errors_EntreeDateInvalid', "Date entrée invalide");
define('Errors_RequiredStringChraracters', "Ne doit contenir que des caractères");
define('Errors_CINInvalid', "CIN invalide");
define('Errors_identifiantUtilise', "Identifiant dejà utilisé");
//dev 113
define('Errors_InvalidEmail', "Adresse e-mail invalide");
define('Errors_InvalidNumber', "Numero de telephone invalide");
define('Errors_InvalidDate', "Date invalide");
define('Errors_InvalidDuree', "Duree de conge invalide");

//dev112 table name
define('TAB_EMP', "employe");
define('TAB_USER', "utilisateur");
define('TAB_CONGE', "conge");
define('TAB_CONTACT', "contact");
define('TAB_PROJET', "projet");
define('TAB_ACCOUNT', "account");


// dev 113 : Statut
define('EST_PROSPECT', 0);
define('CLIENT_FIXE', 1);
define('EN_ATTENTE', 1);
define('REFUSE', 2);
define('VALIDE', 3);
define('EN_COURS', 4);
define('VALIDE_CONDITION', 4);
define('FAIT', 5);

//dev 113
define('ANNE_DEBUT', 2015); // debut de teko



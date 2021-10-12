<?php
$MODE_DEVELOP = true;

if($MODE_DEVELOP != false)
{
//SETTING BD
define('HOST','localhost');
define('DATABASE','fondos_recaudacion');
define('USER','root');
define('PWD','root');
define('PORT','3306');
//META TAGS APP
define('AUTOR_APP','AleviRDZ');
define('TITLE_APP','Panel Administrativo');
define('DESCRIPTION_APP','Panel administrativo del sistema de control');
define('KEYWORDS_APP','site, web, sistem');
define('VIEWPORT_APP','width=device-width, initial-scale=1, shrink-to-fit=no');
define('CHARSET_APP','utf-8');
//ICON APP
define('ICON_APP','../../assets/theme/favicon/diseno-de-interfaz-de-usuario.svg');
define('ICON_APP_INDEX','assets/theme/favicon/diseno-de-interfaz-de-usuario.svg');
//ROUTES CSS & JS
define('ROUTE_CSS_APP','../../assets/css/');
define('ROUTE_JS_APP','../../assets/js/');
define('ROUTE_CSS_INDEX','assets/css/');
define('ROUTE_JS_INDEX','assets/js/');
//SETTING COVER PAGE INDEX
define('TITLE_APP_WEB','Prueba la Aplicación<br>de impulso');
define('DESCRIPTION_APP_WEB','Inicia sesión con tu cuenta para tener acceso.');
}
else
{
//SETTING BD
define('HOST','127.0.0.1');
define('DATABASE','aleviweb_AplicationSys');
define('USER','aleviweb_UserSys');
define('PWD','123456789');
define('PORT','3306');
//META TAGS APP
define('AUTOR_APP','AleviRDZ');
define('TITLE_APP','Panel Administrativo');
define('DESCRIPTION_APP','Panel administrativo del sistema de control');
define('KEYWORDS_APP','site, web, sistem');
define('VIEWPORT_APP','width=device-width, initial-scale=1, shrink-to-fit=no');
define('CHARSET_APP','utf-8');
//ICON APP
define('ICON_APP','../../assets/theme/favicon/diseno-de-interfaz-de-usuario.svg');
define('ICON_APP_INDEX','assets/theme/favicon/diseno-de-interfaz-de-usuario.svg');
//ROUTES CSS & JS
define('ROUTE_CSS_APP','../../assets/css/');
define('ROUTE_JS_APP','../../assets/js/');
define('ROUTE_CSS_INDEX','assets/css/');
define('ROUTE_JS_INDEX','assets/js/');
//SETTING COVER PAGE INDEX
define('TITLE_APP_WEB','Prueba la Aplicación<br>de impulso');
define('DESCRIPTION_APP_WEB','Inicia sesión con tu cuenta para tener acceso.');
}
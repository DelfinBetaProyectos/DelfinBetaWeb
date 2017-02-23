<?php
#############################################################
#                VARIABLES DE CONFIGURACION:                #
# approot:       Ubicacion física de la aplicación          #
# domain_root:   Ubicacion HTTP de la aplicación            #
# DBservidor:    Nombre del servidor de bases de datos      #
# DBnombre:      Nombre de la base de datos                 #
# DBusuario:     Nombre de usuario de la base de datos      #
# DBcontrasena:  Contraseña del usuario de la base de datos #
#############################################################

################# Configuracion en Servidor #################
$GLOBALS['app_root'] = $_SERVER['DOCUMENT_ROOT'];
$GLOBALS['domain_root'] = "http://".$_SERVER['HTTP_HOST'];
$DBservidor = "localhost";
$DBnombre = "delfinbeta";
$DBusuario = "udelfinbeta";
$DBcontrasena = "9q58pbCw8GJU";
$TIEMPO_MAXIMO_SESION = 3600;  // en segundos

#################### Configuracion Local ####################
$GLOBALS['app_root'] = $_SERVER['DOCUMENT_ROOT']."/delfinbeta";
$GLOBALS['domain_root'] = "http://".$_SERVER['HTTP_HOST']."/delfinbeta";
$DBservidor = "localhost";
$DBnombre = "delfinbeta";
$DBusuario = "root";
$DBcontrasena = "tecnod20";
$TIEMPO_MAXIMO_SESION = 3600;  // en segundos
?>
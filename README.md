cakephp-gestotux
================

[![Build Status](https://travis-ci.org/tranfuga25s/cakephp-gestotux.png?branch=master)](https://travis-ci.org/tranfuga25s/cakephp-gestotux)

Plugin de integración entre el programa gestotux y el Framework CakePHP

Gestotux: http://gestotux.googlecode.com/


Documentación
=============

Este plugin servirá para obtener una descripción del estado del servicio para un cliente específico.

Se conectará a la base de datos especificada en bootstrap.php y consultará los datos desde allí.

Configuración
=============
Los datos de que cliente está asociado con el servicio que está funcionando y su cliente correspondiente se guardan en el archivo Config/cliente.ini.
Este es cargado en el inicio del plugin mediante el sistema de bootstrap.
El primer parametro será el ID del cliente que posee el servicio y el segundo el ID del servicio que se encuentra corriendo.
El sistema se encargará luego de obtener los datos desde la conexión remota correspondiente.

Para cargar el plugin, se deberá agregar la siguiente entrada en el bootstrap.php de la aplicación:

CakePlugin::load( 'Gestotux', array( 'bootstrap' => true ) );

La conexión a la base de datos se realiza solamente cuando es necesario.

Autor
=====
Esteban Javier Zeller esteban.zeller<at>gmail.com
<?php

namespace Kawschool;

class Usuario
{
    // Declaro las propiedades privadas de la clase
    private $config;
    private $cn = null;

    // El constructor se ejecuta al crear una instancia de la clase
    public function __construct()
    {
        // Cargo la configuración del archivo config.ini
        $this->config = parse_ini_file(__DIR__ . '/../config.ini');

        // Creo una nueva conexión PDO a la base de datos utilizando los parámetros de configuración
        $this->cn = new \PDO($this->config['dns'], $this->config['usuario'], $this->config['clave'], array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // Establezco la codificación de caracteres a utf8
        ));
    }

    // Función para realizar el login de un usuario
    public function login($nombre, $clave)
    {
        // Preparo la consulta SQL para verificar si el nombre de usuario y la clave coinciden en la base de datos
        $sql = "SELECT nombre_usuario FROM `usuarios` WHERE nombre_usuario = :nombre AND clave = :clave ";

        // Preparo la consulta utilizando PDO
        $resultado = $this->cn->prepare($sql);

        // Asigno los valores de los parámetros a la consulta
        $_array = array(
            ":nombre" =>  $nombre,
            ":clave" =>  $clave
        );

        // Ejecuto la consulta y, si tiene éxito, devuelvo el resultado
        if ($resultado->execute($_array)) {
            return $resultado->fetch(); // Devuelvo los datos del usuario
        }

        // Si no encuentra al usuario o la consulta falla, devuelvo false
        return false;
    }
}

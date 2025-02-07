<?php

namespace Kawschool;

class Cliente{

    // Declaro las propiedades privadas de la clase
    private $config;
    private $cn = null;

    // El constructor se ejecuta cuando se crea una nueva instancia de la clase
    public function __construct(){

        // Cargo la configuración desde el archivo config.ini
        $this->config = parse_ini_file(__DIR__.'/../config.ini') ;

        // Establezco la conexión con la base de datos usando PDO y los datos de configuración
        $this->cn = new \PDO( $this->config['dns'], $this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // Aseguro que la conexión use UTF-8
        ));

    }

    // Función para registrar un nuevo cliente en la base de datos
    public function registrar($_params){
        // Preparo la consulta SQL para insertar un nuevo cliente
        $sql = "INSERT INTO `clientes`(`nombre`, `apellidos`, `email`, `telefono`, `comentario`) 
        VALUES (:nombre,:apellidos,:email,:telefono,:comentario)";

        // Preparo la consulta en PDO
        $resultado = $this->cn->prepare($sql);

        // Asigno los parámetros de la consulta con los valores que recibo
        $_array = array(
            ":nombre" => $_params['nombre'],
            ":apellidos" => $_params['apellidos'],
            ":email" => $_params['email'],
            ":telefono" => $_params['telefono'],
            ":comentario" => $_params['comentario']
        );

        // Si la consulta se ejecuta correctamente, devuelvo el ID del nuevo cliente
        if($resultado->execute($_array))
            return $this->cn->lastInsertId();

        // Si algo sale mal, devuelvo false
        return false;
    }
}

<?php

namespace Kawschool;

class Categoria{

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

    // Función para mostrar todas las categorías desde la base de datos
    public function mostrar(){
        // Preparo la consulta SQL para obtener todas las categorías
        $sql = "SELECT * FROM categorias";

        // Preparo la consulta en PDO
        $resultado = $this->cn->prepare($sql);

        // Si la consulta se ejecuta correctamente, devuelvo todas las categorías
        if($resultado->execute())
            return $resultado->fetchAll();

        // Si algo sale mal, devuelvo false
        return false;
    }
}

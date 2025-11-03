<?php
Class Database{
    private $servidor="sql210.infinityfree.com";
    private $usuario="if0_40318561";
    private $password="AY4WRCWuCLo";
    private $bd="if0_40318561_sistema_ventas";
    private $charset = 'utf8';

    function conectar(){
        try{
            $conexion = "mysql:host=".$this->servidor."; dbname=".$this->bd.";
            charset=".$this->charset;

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            $pdo = new PDO($conexion,$this->usuario,$this->password,$options);

            return $pdo;
        }catch(PDOException $e){
            //echo "Error conexion: ".$e->getMessage();
            //exit;
            throw $e;
        }
    }
}
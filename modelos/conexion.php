<?php



class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=192.169.145.218;dbname=pos",
			            "repaut",
			            "Tanela@2023");

		$link->exec("set names utf8");

		return $link;

	}     

}
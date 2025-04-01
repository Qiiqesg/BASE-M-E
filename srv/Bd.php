<?php

class Bd
{
    private static mysqli $conexion;

    static function conexion(): mysqli
    {
        if (!isset(self::$conexion)) {
            self::$conexion = new mysqli(
                "sql300.infinityfree.com",   // Host de MySQL
                "if0_38648957",              // Usuario de MySQL
                "X6JW1iWkz5t60L",            // Contraseña del panel (la copiaste bien)
                "if0_38648957_Eregistros"    // Nombre de la base de datos
            );

            if (self::$conexion->connect_error) {
                die("Error de conexión: " . self::$conexion->connect_error);
            }
        }

        return self::$conexion;
    }
}
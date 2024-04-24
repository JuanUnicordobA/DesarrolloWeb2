<?php

namespace Utils; // Define el espacio de nombres 'Utils'.

use PDO; // Importa la clase PDO.
use PDOException; // Importa la clase PDOException.

class Connection // Define la clase Connection.
{

    private PDO $conn; // Declara la propiedad privada $conn de tipo PDO.

    private $password = ""; // Declara la propiedad $password para la contraseña de la base de datos.
    private $username = "root"; // Declara la propiedad $username para el nombre de usuario de la base de datos.
    private $dbname = "eventos"; // Declara la propiedad $dbname para el nombre de la base de datos.
    private $servername = "localhost"; // Declara la propiedad $servername para la dirección del servidor de la base de datos.

    public function __construct() // Constructor de la clase.
    {
        try {
            // Intenta establecer una conexión a la base de datos.
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establece el modo de errores de PDO.
        } catch (PDOException $e) { // Captura excepciones de PDOException.
            // Si la conexión falla, muestra un mensaje de error y termina el script.
            die("Conexión fallida: " . $e->getMessage());
        }
    }

    public function getConnection() // Método para obtener la conexión a la base de datos.
    {
        return $this->conn; // Devuelve la conexión PDO.
    }
}

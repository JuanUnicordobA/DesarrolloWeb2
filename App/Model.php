<?php

namespace app; // Define el espacio de nombres 'app' para la clase Model.

require_once 'Utils/Connection.php'; // Incluye el archivo de conexión a la base de datos.
require_once 'Utils/JsonResponse.php'; // Incluye el archivo de respuesta JSON.

use PDO; // Importa la clase PDO para trabajar con bases de datos.
use Utils\Connection; // Importa la clase Connection para establecer la conexión.
use Utils\JsonResponse; // Importa la clase JsonResponse para enviar respuestas JSON.

class Model // Define la clase Model.
{
    private PDO $pdo; // Declara una propiedad privada $pdo de tipo PDO.
    protected string $table; // Declara una propiedad protegida $table para almacenar el nombre de la tabla.

    public function __construct() // Constructor de la clase.
    {
        $this->pdo = (new Connection())->getConnection(); // Inicializa la conexión a la base de datos.
    }

    public function all() // Método para obtener todos los registros.
    {
        $sql = "SELECT * FROM $this->table"; // Consulta SQL para seleccionar todos los registros de la tabla.
        $prepare = $this->pdo->prepare($sql); // Prepara la consulta.
        $prepare->execute(); // Ejecuta la consulta.
        $objects = $prepare->fetchAll(PDO::FETCH_OBJ); // Obtiene todos los registros como objetos.
        return $objects; // Devuelve los registros.
    }

    public function find(int $id) // Método para encontrar un registro por ID.
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id"; // Consulta SQL para seleccionar un registro por ID.
        $prepare = $this->pdo->prepare($sql); // Prepara la consulta.
        $prepare->bindParam(':id', $id); // Vincula el parámetro :id al valor de $id.
        $prepare->execute(); // Ejecuta la consulta.

        if ($prepare->rowCount() > 0) { // Si se encuentra al menos un registro.
            return $prepare->fetch(PDO::FETCH_OBJ); // Devuelve el registro encontrado.
        }
        
        JsonResponse::send( // Si no se encuentra el registro, envía una respuesta JSON de error.
            404,
            'registro no encontrado',
            null
        );
        die(); // Finaliza la ejecución del script.
    }

    public function create($data) // Método para crear un nuevo registro.
    {
        $i = 1; // Inicializa un contador.
        $sql = "INSERT INTO $this->table (" . implode(",", array_keys($data)) . ") VALUES(" . implode(",", array_fill(0, count($data), "?")) . ")"; // Consulta SQL para insertar un nuevo registro.
        $prepare = $this->pdo->prepare($sql); // Prepara la consulta.

        foreach ($data as $key => $value) { // Recorre los datos.
            $prepare->bindValue($i, $value); // Vincula los valores a los marcadores de posición.
            $i++; // Incrementa el contador.
        }

        $prepare->execute(); // Ejecuta la consulta.
        return $this->pdo->lastInsertId(); // Devuelve el ID del último registro insertado.
    }

    public function delete(int $id) // Método para eliminar un registro por ID.
    {
        $sql = "DELETE FROM $this->table WHERE id = :id"; // Consulta SQL para eliminar un registro por ID.
        $prepare = $this->pdo->prepare($sql); // Prepara la consulta.
        $prepare->bindParam(':id', $id); // Vincula el parámetro :id al valor de $id.

        if(!$prepare->execute()){ // Si no se puede ejecutar la consulta.
            JsonResponse::send( // Envía una respuesta JSON de error.
                404,
                'registro no encontrado',
                null
            );
            die(); // Finaliza la ejecución del script.
        }

        return true; // Devuelve true si se elimina el registro correctamente.
    }

    public function update(array $data, int $id) // Método para actualizar un registro por ID.
    {
        $i = 1; // Inicializa un contador.
        $keys = array_keys($data); // Obtiene las claves de los datos.

        $updateSql = array_map(function ($key) { // Crea una array de cadenas en formato "clave = ?".
            return " $key = ?";
        }, $keys);

        $sql = "UPDATE $this->table SET" . implode(', ', $updateSql) . " WHERE id = ?"; // Consulta SQL para actualizar un registro por ID.
        $prepare = $this->pdo->prepare($sql); // Prepara la consulta.

        foreach ($data as $key => $value) { // Recorre los datos.
            $prepare->bindValue($i, $value); // Vincula los valores a los marcadores de posición.
            $i++; // Incrementa el contador.
        }

        $prepare->bindValue($i, $id); // Vincula el valor de $id al marcador de posición.
        $prepare->execute(); // Ejecuta la consulta.
    }
}

<?php

namespace Controller;

require_once 'Utils/JsonResponse.php'; // Incluye la clase JsonResponse para enviar respuestas JSON.
require_once 'Models/Asistente.php'; // Incluye el modelo Asistente para interactuar con la base de datos.

use Models\Asistente; // Usa el modelo Asistente.
use Utils\JsonResponse; // Usa la clase JsonResponse para enviar respuestas JSON.

class AsistenteController // Define la clase AsistenteController.
{

    public function index() // Método para obtener todos los asistentes.
    {
        $asistentes = new Asistente(); // Crea una nueva instancia del modelo Asistente.

        JsonResponse::send( // Envía una respuesta JSON.
            200, // Código de estado 200 (OK).
            'Lista de asistentes', // Mensaje.
            $asistentes->all() // Obtiene todos los asistentes.
        );
    }

    public function store() // Método para crear un nuevo asistente.
    {
        $requestData = json_decode(file_get_contents('php://input'), true); // Obtiene los datos de la solicitud en formato JSON y los decodifica.

        $asistente = new Asistente(); // Crea una nueva instancia del modelo Asistente.

        $id = $asistente->create([ // Crea un nuevo asistente en la base de datos.
            'nombre' => $requestData['nombre'],
            'apellido' => $requestData['apellido'],
            'email' => $requestData['email'],
            'telefono' => $requestData['telefono'],
            'fecha_nacimiento' => $requestData['fecha_nacimiento']
        ]);

        JsonResponse::send( // Envía una respuesta JSON.
            201, // Código de estado 201 (Creado).
            'Asistente creado', // Mensaje.
            ['id' => $id] // Devuelve el ID del nuevo asistente creado.
        );
    }

    public function read($id) // Método para obtener un asistente por su ID.
    {
        $asistente = new Asistente(); // Crea una nueva instancia del modelo Asistente.

        $asistente = $asistente->find($id); // Busca el asistente por su ID.

        JsonResponse::send( // Envía una respuesta JSON.
            200, // Código de estado 200 (OK).
            'Asistente encontrado', // Mensaje.
            $asistente // Devuelve el asistente encontrado.
        );
    }

    public function update($id) // Método para actualizar un asistente por su ID.
    {
        $requestData = json_decode(file_get_contents('php://input'), true); // Obtiene los datos de la solicitud en formato JSON y los decodifica.

        $asistente = new Asistente(); // Crea una nueva instancia del modelo Asistente.

        $asistente->update([ // Actualiza los datos del asistente en la base de datos.
            'nombre' => $requestData['nombre'],
            'apellido' => $requestData['apellido'],
            'email' => $requestData['email'],
            'telefono' => $requestData['telefono'],
            'fecha_nacimiento' => $requestData['fecha_nacimiento']
        ], $id);

        JsonResponse::send( // Envía una respuesta JSON.
            200, // Código de estado 200 (OK).
            'Asistente actualizado', // Mensaje.
            ['id' => $id] // Devuelve el ID del asistente actualizado.
        );
    }

    public function delete($id) // Método para eliminar un asistente por su ID.
    {
        $asistente = new Asistente(); // Crea una nueva instancia del modelo Asistente.

        $asistente->delete($id); // Elimina el asistente de la base de datos.

        JsonResponse::send( // Envía una respuesta JSON.
            200, // Código de estado 200 (OK).
            'Asistente eliminado', // Mensaje.
            null // No devuelve datos adicionales.
        );
    }
}

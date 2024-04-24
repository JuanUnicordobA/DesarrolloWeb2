<?php

namespace Controller; // Define el espacio de nombres 'Controller'.

require_once 'Utils/JsonResponse.php'; // Incluye la clase JsonResponse para enviar respuestas JSON.
require_once 'Models/Detalle.php'; // Incluye el modelo Detalle para interactuar con la base de datos.

use Models\Detalle; // Usa el modelo Detalle.
use Utils\JsonResponse; // Usa la clase JsonResponse para enviar respuestas JSON.

class DetalleController // Define la clase DetalleController.
{

    public function index() // Método para obtener todos los detalles.
    {
        $detalles = new Detalle(); // Crea una nueva instancia del modelo Detalle.

        JsonResponse::send( // Envía una respuesta JSON.
            200, // Código de estado 200 (OK).
            'Lista de detalles', // Mensaje.
            $detalles->all() // Obtiene todos los detalles.
        );
    }

    public function store() // Método para crear un nuevo detalle.
    {
        $requestData = json_decode(file_get_contents('php://input'), true); // Obtiene los datos de la solicitud en formato JSON y los decodifica.

        $detalle = new Detalle(); // Crea una nueva instancia del modelo Detalle.

        $id = $detalle->create([ // Crea un nuevo detalle en la base de datos.
            'evento_id' => $requestData['evento_id'],
            'asistente_id' => $requestData['asistente_id'],
            'inscripcion_id' => $requestData['inscripcion_id'],
            'tipo_entrada' => $requestData['tipo_entrada'],
            'codigo_promocional' => $requestData['codigo_promocional']
        ]);

        JsonResponse::send( // Envía una respuesta JSON.
            201, // Código de estado 201 (Creado).
            'Detalle creado', // Mensaje.
            ['id' => $id] // Devuelve el ID del nuevo detalle creado.
        );
    }

    public function read($id) // Método para obtener un detalle por su ID.
    {
        $detalle = new Detalle(); // Crea una nueva instancia del modelo Detalle.

        $detalle = $detalle->find($id); // Busca el detalle por su ID.

        JsonResponse::send( // Envía una respuesta JSON.
            200, // Código de estado 200 (OK).
            'Detalle encontrado', // Mensaje.
            $detalle // Devuelve el detalle encontrado.
        );
    }

    public function update($id) // Método para actualizar un detalle por su ID.
    {
        $requestData = json_decode(file_get_contents('php://input'), true); // Obtiene los datos de la solicitud en formato JSON y los decodifica.

        $detalle = new Detalle(); // Crea una nueva instancia del modelo Detalle.

        $detalle->update([ // Actualiza los datos del detalle en la base de datos.
            'evento_id' => $requestData['evento_id'],
            'asistente_id' => $requestData['asistente_id'],
            'inscripcion_id' => $requestData['inscripcion_id'],
            'tipo_entrada' => $requestData['tipo_entrada'],
            'codigo_promocional' => $requestData['codigo_promocional']
        ], $id);

        JsonResponse::send( // Envía una respuesta JSON.
            200, // Código de estado 200 (OK).
            'Detalle actualizado', // Mensaje.
            ['id' => $id] // Devuelve el ID del detalle actualizado.
        );
    }

    public function delete($id) // Método para eliminar un detalle por su ID.
    {
        $detalle = new Detalle(); // Crea una nueva instancia del modelo Detalle.

        $detalle->delete($id); // Elimina el detalle de la base de datos.

        JsonResponse::send( // Envía una respuesta JSON.
            200, // Código de estado 200 (OK).
            'Detalle eliminado', // Mensaje.
            null // No devuelve datos adicionales.
        );
    }
}

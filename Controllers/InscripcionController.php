<?php

namespace Controller; // Define el espacio de nombres 'Controller'.

require_once 'Models/Inscripcion.php'; // Incluye el modelo Inscripcion para interactuar con la base de datos.
require_once 'Utils/JsonResponse.php'; // Incluye la clase JsonResponse para enviar respuestas JSON.

use Models\Inscripcion; // Usa el modelo Inscripcion.
use Utils\JsonResponse; // Usa la clase JsonResponse para enviar respuestas JSON.

class InscripcionController // Define la clase InscripcionController.
{

    public function index() // Método para obtener todas las inscripciones.
    {
        $inscripcion = new Inscripcion(); // Crea una nueva instancia del modelo Inscripcion.

        JsonResponse::send( // Envía una respuesta JSON.
            200, // Código de estado 200 (OK).
            'Lista de inscripciones', // Mensaje.
            $inscripcion->all() // Obtiene todas las inscripciones.
        );
    }

    public function store() // Método para crear una nueva inscripción.
    {
        $requestData = json_decode(file_get_contents('php://input'), true); // Obtiene los datos de la solicitud en formato JSON y los decodifica.

        $inscripcion = new Inscripcion(); // Crea una nueva instancia del modelo Inscripcion.

        $id = $inscripcion->create([ // Crea una nueva inscripción en la base de datos.
            'rol' => $requestData['rol'],
            'costo' => $requestData['costo'],
            'estado_pago' => $requestData['estado_pago'],
            'fecha_inscripcion' => $requestData['fecha_inscripcion'],
            'fecha_vencimiento' => $requestData['fecha_vencimiento']
        ]);

        JsonResponse::send( // Envía una respuesta JSON.
            201, // Código de estado 201 (Creado).
            'Inscripción creada', // Mensaje.
            ['id' => $id] // Devuelve el ID de la nueva inscripción creada.
        );
    }

    public function read($id) // Método para obtener una inscripción por su ID.
    {
        $inscripcion = new Inscripcion(); // Crea una nueva instancia del modelo Inscripcion.

        $inscripcion = $inscripcion->find($id); // Busca la inscripción por su ID.

        JsonResponse::send( // Envía una respuesta JSON.
            200, // Código de estado 200 (OK).
            'Inscripción encontrada', // Mensaje.
            $inscripcion // Devuelve la inscripción encontrada.
        );
    }

    public function update($id) // Método para actualizar una inscripción por su ID.
    {
        $requestData = json_decode(file_get_contents('php://input'), true); // Obtiene los datos de la solicitud en formato JSON y los decodifica.

        $inscripcion = new Inscripcion(); // Crea una nueva instancia del modelo Inscripcion.

        $inscripcion->update([ // Actualiza los datos de la inscripción en la base de datos.
            'rol' => $requestData['rol'],
            'costo' => $requestData['costo'],
            'estado_pago' => $requestData['estado_pago'],
            'fecha_inscripcion' => $requestData['fecha_inscripcion'],
            'fecha_vencimiento' => $requestData['fecha_vencimiento']
        ], $id);

        JsonResponse::send( // Envía una respuesta JSON.
            200, // Código de estado 200 (OK).
            'Inscripción actualizada', // Mensaje.
            ['id' => $id] // Devuelve el ID de la inscripción actualizada.
        );
    }

    public function delete($id) // Método para eliminar una inscripción por su ID.
    {
        $inscripcion = new Inscripcion(); // Crea una nueva instancia del modelo Inscripcion.

        $inscripcion->delete($id); // Elimina la inscripción de la base de datos.

        JsonResponse::send( // Envía una respuesta JSON.
            200, // Código de estado 200 (OK).
            'Inscripción eliminada', // Mensaje.
            null // No devuelve datos adicionales.
        );
    }
}


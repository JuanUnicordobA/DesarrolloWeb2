<?php

namespace Controller; // Define el espacio de nombres 'Controller'.

require_once 'Utils/JsonResponse.php'; // Incluye la clase JsonResponse para enviar respuestas JSON.
require_once 'Models/Evento.php'; // Incluye el modelo Evento para interactuar con la base de datos.

use Models\Evento; // Usa el modelo Evento.
use Utils\JsonResponse; // Usa la clase JsonResponse para enviar respuestas JSON.

class EventoController // Define la clase EventoController.
{

    public function index() // Método para obtener todos los eventos.
    {
        $eventos = new Evento(); // Crea una nueva instancia del modelo Evento.

        JsonResponse::send( // Envía una respuesta JSON.
            200, // Código de estado 200 (OK).
            'Lista de eventos', // Mensaje.
            $eventos->all() // Obtiene todos los eventos.
        );
    }

    public function store() // Método para crear un nuevo evento.
    {
        $requestData = json_decode(file_get_contents('php://input'), true); // Obtiene los datos de la solicitud en formato JSON y los decodifica.

        $evento = new Evento(); // Crea una nueva instancia del modelo Evento.

        $id = $evento->create([ // Crea un nuevo evento en la base de datos.
            'nombre' => $requestData['nombre'],
            'fecha' => $requestData['fecha'],
            'lugar' => $requestData['lugar'],
            'tipo' => $requestData['tipo'],
            'duracion' => $requestData['duracion']
        ]);

        JsonResponse::send( // Envía una respuesta JSON.
            201, // Código de estado 201 (Creado).
            'Evento creado', // Mensaje.
            ['id' => $id] // Devuelve el ID del nuevo evento creado.
        );
    }

    public function read($id) // Método para obtener un evento por su ID.
    {
        $evento = new Evento(); // Crea una nueva instancia del modelo Evento.

        $evento = $evento->find($id); // Busca el evento por su ID.

        JsonResponse::send( // Envía una respuesta JSON.
            200, // Código de estado 200 (OK).
            'Evento encontrado', // Mensaje.
            $evento // Devuelve el evento encontrado.
        );
    }

    public function update($id) // Método para actualizar un evento por su ID.
    {
        $requestData = json_decode(file_get_contents('php://input'), true); // Obtiene los datos de la solicitud en formato JSON y los decodifica.

        $evento = new Evento(); // Crea una nueva instancia del modelo Evento.

        $evento->update([ // Actualiza los datos del evento en la base de datos.
            'nombre' => $requestData['nombre'],
            'fecha' => $requestData['fecha'],
            'lugar' => $requestData['lugar'],
            'tipo' => $requestData['tipo'],
            'duracion' => $requestData['duracion']
        ], $id);

        JsonResponse::send( // Envía una respuesta JSON.
            200, // Código de estado 200 (OK).
            'Evento actualizado', // Mensaje.
            ['id' => $id] // Devuelve el ID del evento actualizado.
        );
    }

    public function delete($id) // Método para eliminar un evento por su ID.
    {
        $evento = new Evento(); // Crea una nueva instancia del modelo Evento.

        $evento->delete($id); // Elimina el evento de la base de datos.

        JsonResponse::send( // Envía una respuesta JSON.
            200, // Código de estado 200 (OK).
            'Evento eliminado', // Mensaje.
            null // No devuelve datos adicionales.
        );
    }
}


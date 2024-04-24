<?php

namespace Utils; // Define el espacio de nombres 'Utils'.

class JsonResponse // Define la clase JsonResponse.
{
    public static function send($statusCode = 200, $message, $data) // Método estático para enviar una respuesta JSON.
    {
        http_response_code($statusCode); // Establece el código de respuesta HTTP.

        $response = array( // Crea un array para la respuesta JSON.
            'code' => $statusCode, // Añade el código de estado.
            'message' => $message, // Añade el mensaje.
            'data' => $data, // Añade los datos.
        );

        echo json_encode($response); // Convierte el array en formato JSON y lo imprime.
    }
}

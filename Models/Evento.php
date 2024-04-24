<?php

namespace Models; // Define el espacio de nombres 'Models'.

require_once 'App/Model.php'; // Incluye la clase Model.

use App\Model; // Usa la clase Model.

class Evento extends Model // Define la clase Evento que extiende de Model.
{
    protected string $table = 'Eventos'; // Define el nombre de la tabla en la base de datos.

    private $id; // Declara la propiedad privada $id.
    private $nombre; // Declara la propiedad privada $nombre.
    private $fecha; // Declara la propiedad privada $fecha.
    private $lugar; // Declara la propiedad privada $lugar.
    private $tipo; // Declara la propiedad privada $tipo.
    private $duracion; // Declara la propiedad privada $duracion.
    private array $detalles; // Declara la propiedad privada $detalles como un array.

    public function __construct() // Constructor de la clase.
    {
        parent::__construct(); // Llama al constructor de la clase padre.

        // Inicializa las propiedades con valores predeterminados.
        $this->id = -1;
        $this->nombre = '';
        $this->fecha = '';
        $this->lugar = '';
        $this->tipo = '';
        $this->duracion = '';
    }

    // Métodos para obtener los valores de las propiedades.
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getLugar()
    {
        return $this->lugar;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getDuracion()
    {
        return $this->duracion;
    }

    // Métodos para establecer los valores de las propiedades.
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function setLugar($lugar)
    {
        $this->lugar = $lugar;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }

    // Métodos getter y setter para la propiedad $detalles.
    public function setDetalles($detalle)
    {
        $this->detalles = $detalle;
    }

    public function getDetalles()
    {
        return $this->detalles;
    }

    // Método para convertir los datos del evento en un array.
    public function toArray()
    {
        $data = [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'fecha' => $this->fecha,
            'lugar' => $this->lugar,
            'tipo' => $this->tipo,
            'duracion' => $this->duracion,
        ];

        // Si no hay detalles, devuelve los datos del evento.
        if (empty($this->detalles)) {
            return $data;
        }

        // Si hay detalles, los convierte en un array y los añade a los datos del evento.
        foreach ($this->detalles as $detalle) {
            foreach ($detalle as $obj) {
                $data['detalles'][] = $obj->toArray();
            }
        }

        return $data;
    }
}

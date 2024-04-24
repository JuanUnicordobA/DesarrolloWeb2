<?php

namespace Models; // Define el espacio de nombres 'Models'.

require_once 'Models/Evento.php'; // Incluye el modelo Evento.
require_once 'Models/Asistente.php'; // Incluye el modelo Asistente.
require_once 'Models/Inscripcion.php'; // Incluye el modelo Inscripcion.

use app\Model; // Usa la clase Model.
use Models\Evento; // Usa el modelo Evento.
use Models\Asistente; // Usa el modelo Asistente.
use Models\Inscripcion; // Usa el modelo Inscripcion.

class Detalle extends Model // Define la clase Detalle que extiende de Model.
{

    protected string $table = 'Detalles'; // Define el nombre de la tabla en la base de datos.

    private $id; // Declara la propiedad privada $id.
    private $eventoId; // Declara la propiedad privada $eventoId.
    private $asistenteId; // Declara la propiedad privada $asistenteId.
    private $inscripcionId; // Declara la propiedad privada $inscripcionId.
    private $tipoEntrada; // Declara la propiedad privada $tipoEntrada.
    private $codigoPromocional; // Declara la propiedad privada $codigoPromocional.
    private ?Evento $evento = null; // Declara la propiedad privada $evento como un objeto Evento nullable.
    private ?Asistente $asistente = null; // Declara la propiedad privada $asistente como un objeto Asistente nullable.
    private ?Inscripcion $inscripcion = null; // Declara la propiedad privada $inscripcion como un objeto Inscripcion nullable.

    public function __construct() // Constructor de la clase.
    {
        parent::__construct(); // Llama al constructor de la clase padre.

        // Inicializa las propiedades con valores predeterminados.
        $this->id = -1;
        $this->eventoId = '';
        $this->tipoEntrada = '';
        $this->asistenteId = '';
        $this->inscripcionId = '';
        $this->codigoPromocional = '';
    }

    // Métodos para obtener los valores de las propiedades.
    public function getId()
    {
        return $this->id;
    }

    public function getEventoId()
    {
        return $this->eventoId;
    }

    public function getAsistenteId()
    {
        return $this->asistenteId;
    }

    public function getInscripcionId()
    {
        return $this->inscripcionId;
    }

    public function getTipoEntrada()
    {
        return $this->tipoEntrada;
    }

    public function getCodigoPromocional()
    {
        return $this->codigoPromocional;
    }

    // Métodos para establecer los valores de las propiedades.
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEventoId($eventoId)
    {
        $this->eventoId = $eventoId;
    }

    public function setAsistenteId($asistenteId)
    {
        $this->asistenteId = $asistenteId;
    }

    public function setInscripcionId($inscripcionId)
    {
        $this->inscripcionId = $inscripcionId;
    }

    public function setTipoEntrada($tipoEntrada)
    {
        $this->tipoEntrada = $tipoEntrada;
    }

    public function setCodigoPromocional($codigoPromocional)
    {
        $this->codigoPromocional = $codigoPromocional;
    }

    // Métodos getter y setter para las propiedades $evento, $asistente y $inscripcion.
    public function getEvento()
    {
        return $this->evento;
    }

    public function setEvento($evento)
    {
        $this->evento = $evento;
    }

    public function getAsistente()
    {
        return $this->asistente;
    }

    public function setAsistente($asistente)
    {
        $this->asistente = $asistente;
    }

    public function getInscripcion()
    {
        return $this->inscripcion;
    }

    public function setInscripcion($inscripcion)
    {
        $this->inscripcion = $inscripcion;
    }

    // Método para convertir los datos del detalle en un array.
    public function toArray()
    {
        $data = [
            'id' => $this->id,
            'eventoId' => $this->eventoId,
            'asistenteId' => $this->asistenteId,
            'inscripcionId' => $this->inscripcionId,
            'tipoEntrada' => $this->tipoEntrada,
            'codigoPromocional' => $this->codigoPromocional
        ];
        
        // Si el evento está definido, lo añade al array.
        if($this->evento != null){
            $data['evento'] = $this->evento->toArray();
        }

        // Si el asistente está definido, lo añade al array.
        if($this->asistente != null){
            $data['asistente'] = $this->asistente->toArray();
        }

        // Si la inscripción está definida, la añade al array.
        if($this->inscripcion != null){
            $data['inscripcion'] = $this->inscripcion->toArray();
        }

        return $data;
    }
}

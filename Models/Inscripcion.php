<?php

namespace Models; // Define el espacio de nombres 'Models'.

use App\Model; // Importa la clase Model.

class Inscripcion extends Model // Define la clase Inscripcion que extiende de Model.
{

    protected string $table = 'Inscripciones'; // Define el nombre de la tabla en la base de datos.

    private $id; // Declara la propiedad privada $id.
    private $rol; // Declara la propiedad privada $rol.
    private $costo; // Declara la propiedad privada $costo.
    private $estadoPago; // Declara la propiedad privada $estadoPago.
    private $fechaInscripcion; // Declara la propiedad privada $fechaInscripcion.
    private $fechaVencimiento; // Declara la propiedad privada $fechaVencimiento.

    public function __construct() // Constructor de la clase.
    {
        parent::__construct(); // Llama al constructor de la clase padre.

        // Inicializa las propiedades con valores predeterminados.
        $this->id = -1;
        $this->rol = '';
        $this->costo = -1;
        $this->estadoPago = '';
        $this->fechaInscripcion = '';
        $this->fechaVencimiento = '';
    }

    // Métodos para obtener los valores de las propiedades.
    public function getId()
    {
        return $this->id;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function getCosto()
    {
        return $this->costo;
    }

    public function getEstadoPago()
    {
        return $this->estadoPago;
    }

    public function getFechaInscripcion()
    {
        return $this->fechaInscripcion;
    }

    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

    // Métodos para establecer los valores de las propiedades.
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function setCosto($costo)
    {
        $this->costo = $costo;
    }

    public function setEstadoPago($estadoPago)
    {
        $this->estadoPago = $estadoPago;
    }

    public function setFechaInscripcion($fechaInscripcion)
    {
        $this->fechaInscripcion = $fechaInscripcion;
    }

    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;
    }

    // Método para convertir los datos de la inscripción en un array.
    public function toArray()
    {
        return [
            'id' => $this->id,
            'rol' => $this->rol,
            'costo' => $this->costo,
            'estado_pago' => $this->estadoPago,
            'fecha_inscripcion' => $this->fechaInscripcion,
            'fecha_vencimiento' => $this->fechaVencimiento
        ];
    }
}

<?php

namespace Models; // Define el espacio de nombres 'Models'.

require_once 'App/Model.php'; // Incluye la clase Model.

use app\Model; // Usa la clase Model.

class Asistente extends Model // Define la clase Asistente que extiende de Model.
{

    protected string $table = 'Asistentes'; // Define el nombre de la tabla en la base de datos.

    private $id; // Declara la propiedad privada $id.
    private $nombre; // Declara la propiedad privada $nombre.
    private $apellido; // Declara la propiedad privada $apellido.
    private $email; // Declara la propiedad privada $email.
    private $telefono; // Declara la propiedad privada $telefono.
    private $fecha_nacimiento; // Declara la propiedad privada $fecha_nacimiento.

    public function __construct() // Constructor de la clase.
    {
        parent::__construct(); // Llama al constructor de la clase padre.

        // Inicializa las propiedades con valores predeterminados.
        $this->id = -1;
        $this->nombre = '';
        $this->apellido = '';
        $this->email = '';
        $this->telefono = '';
        $this->fecha_nacimiento = '';
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

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
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

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setFechaNacimiento($fecha_nacimiento)
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    // Método para convertir los datos del asistente en un array.
    public function toArray()
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'fecha_nacimiento' => $this->fecha_nacimiento
        ];
    }
}

<?php
    require_once 'config.php';

class Conexion {
    protected $db; //oriouedad oara ka cibexcuib a ka BD

    //metodo constructor
    public function __construct(){
        //guardamos en la propiedad $db la conexion
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        //en caso de error de conexion
        if($this->db->connect_errno) {
            echo 'Fallo al conectar a MySQL: ', $this->db->connect_error;
        }

        $this->db->set_charset(DB_CHARSET);
        $this->db->query("SET NAMES 'utf8'");
    }
}

//Clase de modelo basado en la clase conexion
    
class Modelo extends Conexion {
    //propiedades
    private $tabla;  //nombre tabla
    private $id = 0;   //id registro
    private $criterio = '';   //criterio consultas
    private $campos = '*';   //lista de campos
    private $orden = 'id';   //campo de ordenamiento
    private $limite = 0;   //cantidad de regsitros

        public function __construct($tabla) {
            parent::__construct();      //ejecuta constructor padre
            $this->tabla = $tabla;     //la propiedad tabla se guarda en argumento $tabla
    }

    //metodos Getter y Setter

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCriterio() {
        return $this->criterio;
    }

    public function setCriterio($criterio) {
        $this->criterio = $criterio;
    }

    public function getCampos() {
        return $this->campos;
    }

    public function setCampos($campos) {
        $this->campos = $campos;
    }

    public function getOrden() {
        return $this->orden;
    }

    public function setOrden($orden) {
        $this->orden = $orden;
    }

    public function getLimite() {
        return $this->limite;
    }

    public function setLimite($limite) {
        $this->limite = $limite;
    }

    /**
     * metodo de seleccion
     * permite seleccionar registros de una tabla de BD
     * @return $datos
     */

    public function seleccionar() {
        //SELECT * FROM productos WHERE id='10' ORDER BY id LIMIT 10
        $sql = "SELECT $this->campos FROM $this->tabla";
        //si hay un criterio lo agregamos
        if($this->criterio != '') {
            $sql .= " WHERE $this->criterio";
        }
        //agregamos el orden
        $sql .= " ORDER BY $this->orden";
        //Si el $limite es > que 0, agregamos el limite
        if($this->limite > 0) {
            $sql .= " LIMIT $this->limite";
        }
        //echo $sql; //mostramos la instruccion SQL

        //Ejecutamos la instruccion SQL
        $resultado = $this->db->query($sql);
        $datos = $resultado->fetch_all(MYSQLI_ASSOC); //guardamos los datos en un Array asociativo
        $datos = json_encode($datos); //convertimos los datso a JSON
        
        //devolvemos los datos
        return $datos;
    }

}
?>
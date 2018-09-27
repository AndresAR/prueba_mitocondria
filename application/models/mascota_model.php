<?php

/*
	CREATE TABLE `mascotas` (
	  `id` int(11) NOT NULL,
	  `nombre` varchar(150) NOT NULL,
	  `imagen` varchar(255) NOT NULL,
	  `nickname` varchar(150) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	ALTER TABLE `mascotas`
	  ADD PRIMARY KEY (`id`);
	ALTER TABLE `mascotas`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
*/

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Mascota_model extends CI_Model {

    public function construct() {
        parent::__construct();
    }
    
    function filas() {
        $consulta = $this->db->get('mascotas');
        return $consulta->num_rows();
    }
    

    function getMascotas(){
    	$this->db->from('mascotas');
		$this->db->order_by("votos", "desc");
		$query = $this->db->get(); 
		return $query->result();
    }

    function getByID($id){
    	$this->db->where('id', $id);
    	$mascota = $this->db->get('mascotas')->result();
    	return $mascota;
    }

    function votar($id, $total){
    	
    	$votos = [
    		'votos' => $total*1
    	];
    	$this->db->where('id', $id);
    	$this->db->update('mascotas',$votos);
    	return true;
    }

    function total_productos_paginados($por_pagina, $segmento) {
        $consulta = $this->db->get('productos', $por_pagina, $segmento);
        if ($consulta->num_rows() > 0) {
            foreach ($consulta->result() as $fila) {
                $data[] = $fila;
            }
            return $data;
        }
    }
    
    //cuando pulsemos en añadir al carrito esta función será la encargada
    //de saber que producto hemos seleccionado por su id, que la envíamos desde
    //la vista al controlador, y desde el controlador aquí, el modelo.
    function porId($id) {
        $this->db->where('id', $id);
        $productos = $this->db->get('productos');
        foreach ($productos->result() as $producto) {
            $data[] = $producto;
        }
        if ($producto->opciones) {
            $producto->opciones = explode(',', $producto->opciones);
        }
        return $producto;
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InicioModel extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function registro($nombreFac, $fechaFac, $fileFac, $checkbox, $contrato, $precioFac, $ivaFac, $totalFac, $nombreCont, $fechaCont, $id)	{

		if ($id!=0) {
			$updateFac = "UPDATE factura set nombre = '".$nombreFac."', fecha = '".$fechaFac."', licitacion = '".$checkbox."', precio = '".$precioFac."', iva = '".$ivaFac."', total = '".$totalFac."' where contrato='".$id."'; ";

			$this->db->query($updateFac);

			$insertCont = "UPDATE contrato set nombre = '".$nombreCont."', fecha = '".$fechaCont."' where id='".$id."'; ";

			$this->db->query($insertCont);

		} else {

			$resultado_total = array();
			$resultado = array();

			$img = $fileFac['name'];

			$dir_subida = $_SERVER['DOCUMENT_ROOT']."/ENREDA/img/";

			$fichero_subido = $dir_subida.basename($fileFac['name']);

			move_uploaded_file($fileFac['tmp_name'], $fichero_subido);


			$insertCont = "INSERT into contrato (nombre, fecha) values ('".$nombreCont."', '".$fechaCont."'); ";

			$this->db->query($insertCont);

			$devolverID = "SELECT * from contrato where nombre='".$nombreCont."' and fecha='".$fechaCont."' ";

			$resultado = $this->db->query($devolverID)->result();

			foreach ($resultado[0] as $key => $value) {
				$resultado_total[0][$key] = $value;
			}

			$idCont = $resultado_total[0]['id'];	

			$insertFact = "INSERT into factura (nombre, fecha, licitacion, adjunto, contrato, precio, iva, total) values ('".$nombreFac."', '".$fechaFac."', '".$checkbox."', '".$img."', '".$idCont."', '".$precioFac."', '".$ivaFac."', '".$totalFac."'); ";

			$this->db->query($insertFact);
		}
	}

	public function obtener_tabla() {

		$sql = "SELECT c.nombre as nombreCont, c.fecha as fechaCont, f.nombre as nombreFac, f.fecha as fechaFac, licitacion, adjunto, precio, iva, total, contrato from contrato c join factura f on f.contrato=c.id";

		$info = $this->db->query($sql)->result();

		$info = json_encode($info);

		echo $info;
	}


	public function obtener_datos($id) {
		$sql = "SELECT c.nombre as nombreCont, c.fecha as fechaCont, f.nombre as nombreFac, f.fecha as fechaFac, licitacion as checkbox, adjunto, precio as precioFac, iva as ivaFac, total as totalFac, contrato from contrato c join factura f on f.contrato=c.id where contrato='".$id."' ";

		$info = $this->db->query($sql)->result();

		$info = json_encode($info);

		echo $info;
	}

	public function borrar_datos($id)	{

		$sql = "DELETE FROM factura WHERE contrato='".$id."'";
		$sql2 = "DELETE FROM contrato WHERE id='".$id."'";

		$this->db->query($sql);
		$this->db->query($sql2);

	}
}

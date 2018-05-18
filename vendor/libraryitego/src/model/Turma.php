<?php 
namespace Controller\model;
use Controller\model\{Table, Curso};
/**
 * 
 */
class Turma extends Table
{
	
	function __construct()
	{
		$this->curso_idcurso = new Curso();
	}
	private $idturma;
	private $data_inicio;
	private $data_termino;
	private $curso_idcurso;

	public function getObject()
	{
		return get_object_vars($this);
	}

	public function getIdturma(){
		return $this->idturma;
	}
	public function getData_inicio(){
		return $this->data_inicio;
	}
	public function getData_termino(){
		return $this->data_termino;
	}
	public function getCurso_idcurso(): Curso{
		return $this->curso_idcurso;
	}

	public function setIdturma($idturma){
		$this->idturma = $idturma;
	}
	public function setData_inicio($data_inicio){
		$this->data_inicio = $data_inicio;
	}
	public function setData_termino($data_termino){
		$this->data_termino = $data_termino;
	}
	public function setCurso_idcurso(Curso $curso_idcurso){
		$this->curso_idcurso = $curso_idcurso;
	}
	
}


 ?>
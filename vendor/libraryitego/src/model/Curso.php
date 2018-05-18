<?php 

namespace Controller\model;
use Controller\model\{Table,Tipo};


	class Curso extends Table{
		
		private $idcurso;
		private $nome_curso;
		private $carga_horaria;
		private $vagas;
		private $tipo_idtipo;

		 function __construct()
		 {
		 	$this->tipo_idtipo = new Tipo();
		 	$this->nome_curso = "";
		 }

		public function getObject()
		{
			return get_object_vars($this);
		}
		public function getIdcurso(){
			return $this->idcurso;
		}
		public function getNome_curso(){
			return $this->nome_curso;
		}
		public function getCarga_horaria(){
			return $this->carga_horaria;
		}
		public function getVagas(){
			return $this->vagas;
		}
		public function getTipo_idtipo(): Tipo{
			return $this->tipo_idtipo;
		}

		public function setIdcurso($idcurso)
		{
			$this->idcurso = $idcurso;
		}
		public function setNome_curso($nome_curso){
			$this->nome_curso = $nome_curso;
		}
		public function setCarga_horaria($carga_horaria)
		 {
		 	$this->carga_horaria = $carga_horaria;
		 }
		 public function setVagas($vagas)
		{
			$this->vagas = $vagas;
		}
		 public function setTipo_idtipo(Tipo $tipo)
		 {
		 	$this->tipo_idtipo = $tipo;
		 }




	}

 ?>
 
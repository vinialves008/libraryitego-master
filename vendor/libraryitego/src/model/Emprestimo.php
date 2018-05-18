<?php 

namespace Controller\model;
use Controller\model\{Table,Patrimonio,Usuario};


	class Emprestimo extends Table{
		
		private $idemprestimo;
		private $data_emprestimo;
		private $data_devolucao;
		private $usuario_idusuario;
		private $patrimonio_idpatrimonio;
		
		function __construct()
		{
			$this->usuario_idusuario = new Usuario();
			$this->patrimonio_idpatrimonio = new Patrimonio();
		}

		public function getObject()
		{
			return get_object_vars($this);
		}
		public function getIdemprestimo(){
			return $this->idemprestimo;
		}
		public function getData_emprestimo(){
			return $this->data_emprestimo;
		}
		public function getData_devolucao(){
			return $this->data_devolucao;
		}
		public function getUsuario_idusuario(): Usuario{
			return $this->usuario_idusuario;
		}
		public function getPatrimonio_idpatrimonio(): Patrimonio{
			return $this->patrimonio_idpatrimonio;
		}
		

		public function setIdemprestimo($idemprestimo)
		{
			$this->idemprestimo = $idemprestimo;
		}
		public function setData_emprestimo($data_emprestimo){
			$this->data_emprestimo = $data_emprestimo;
		}
		public function setData_devolucao($data_devolucao)
		{
			$this->data_devolucao = $data_devolucao;
		}
		public function setUsuario_idusuario(Usuario $usuario)
		{
			$this->usuario_idusuario = $usuario;
		}
		public function setPatrimonio_idpatrimonio(Patrimonio $patrimonio)
		{
			$this->patrimonio_idpatrimonio = $patrimonio;
		}
		




	}

 ?>
 
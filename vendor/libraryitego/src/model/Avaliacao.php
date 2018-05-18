<?php 

namespace Controller\model;
use Controller\model\{Table, Emprestimo};

	class Avaliacao extends Table{
		
		private $idavaliacao;
		private $comentario;
		private $emprestimo_idemprestimo;

		public function getObject()
		{
			return get_object_vars($this);
		}
		public function getIdavaliacao(){
			return $this->idavaliacao;
		}
		public function getComentario(){
			return $this->comentario;
		}
		public function getEmprestimo_idemprestimo():Emprestimo{
			return $this->emprestimo_idemprestimo;
		}

		public function setIdavaliacao($idavaliacao)
		{
			$this->idavaliacao = $idavaliacao;
		}
		public function setComentario($comentario){
			$this->comentario = $comentario;
		}
		public function setEmprestimo_idemprestimo(Emprestimo $emprestimo)
		{
			$this->emprestimo_idemprestimo = $emprestimo;
		}





	}

 ?>
 
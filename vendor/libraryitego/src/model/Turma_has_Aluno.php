<?php 

namespace Controller\model;
use Controller\model\{Table,Curso,Aluno};


	class Turma_has_Aluno extends Table{
		
		
		private $aluno_idaluno;
		private $matricula;
		private $turma_idturma;

		function __construct()
		{
			$this->aluno_idaluno = new Aluno();
			$this->turma_idturma = new Turma();
		}

		public function getObject()
		{
			return get_object_vars($this);
		}
		
		public function getAluno_idaluno(): Aluno{
			return $this->aluno_idaluno;
		}
		public function getMatricula(){
			return $this->matricula;
		}
		public function getTurma_idturma(): Turma{
			return $this->turma_idturma;
		}

		public function setAluno_idaluno(Aluno $aluno)
		{
			$this->aluno_idaluno = $aluno;
		}
		
		public function setMatricula($matricula){
			$this->matricula = $matricula;
		}
		public function setTurma_idturma(Turma $turma){
			$this->turma_idturma = $turma;
		}
		
		public function getTableKeyName()
		{
			return "matricula";
		}





	}

 ?>
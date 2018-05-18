<?php 
namespace Controller\dao;
use \Controller\model\Turma_has_Aluno;
/**
* 
*/
class Turma_has_alunoSql extends Sql
{
	
	public function insert($table)
		{
			$q = "CALL sp_turma_has_aluno_insert ( :TURMA, :ALUNO, :MATRICULA);";
			$values = array(
				':TURMA' => $table->getTurma_idturma()->getIdturma(),
				':ALUNO' => $table->getAluno_idaluno()->getIdaluno(),
				':MATRICULA' => $table->getMatricula()
			);
			return $this->select($q, $values);

		}	
	public  function getMatricula(Turma_has_Aluno $table){
		$q = "SELECT matricula from ".$table->getTableName()." where turma_idturma = :TURMA and aluno_idaluno = :ALUNO;";
		$values = array(

			':TURMA' => $table->getTurma_idturma()->getIdturma(),
			':ALUNO' => $table->getAluno_idaluno()->getIdaluno()
		);
		return $this->select($q, $values);
	}
	public function getDataToCpf($cpf)
		{
			//$q = "CALL sp_usuario_getidtocpf( :CPF);";
			$q = "select idaluno, cpf, nome_usuario, dtnasc from aluno inner join usuario 
    				on aluno.usuario_idusuario = usuario.idusuario
   					 where cpf = :CPF ;";
			 $values = array(

			 	':CPF' => $cpf
			 );
			 return $this->select($q, $values);

		}	
		public function getDataToIdTurma($idturma)
		{
			$q = "select idturma, data_inicio, data_termino nome_curso, nome_tipo from turma inner join curso on turma.curso_idcurso = curso.idcurso 
			inner join tipo on curso.tipo_idtipo = tipo.idtipo
   			where idturma = :IDTURMA ;";
			 $values = array(

			 	':IDTURMA' => $idturma
			 );
			 return $this->select($q, $values);
		}

}

 ?>
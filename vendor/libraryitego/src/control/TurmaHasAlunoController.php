<?php 
namespace Controller\control;		

use \Controller\model\Turma_has_Aluno;
use \Controller\dao\Turma_has_alunoSql;
	/**
	* 
	*/
	class TurmaHasAlunoController extends CrudController
{
	public static function insert($table)
	{
		return parent::insert($table);
	}
	public function getMatricula(Turma_has_Aluno $table)
	{
		$crud = new Turma_has_alunoSql();
		return $crud->getMatricula($table);
	}
	public function getDataToCpf($cpf)
	{
		$crud = new Turma_has_alunoSql();
		return $crud->getDataToCpf($cpf);
	}
	public function getDataToIdTurma($idturma)
	{
		$crud = new Turma_has_alunoSql();
		return $crud->getDataToIdTurma($idturma);
	}
}
		
			

	

 ?>
<?php 
namespace Controller\dao;

/**
 * 
 */
class TurmaSql extends Sql
{
	
	public function insert($table)
		{
			$q = "CALL sp_curso_turma_insert(:INICIO, :TERMINO ,:IDCURSO);";
			$values = array(
				':INICIO' => $table->getData_inicio(),
				':TERMINO' => $table->getData_termino(),
				':IDCURSO' =>$table->getCurso_idcurso()->getIdcurso()
			);
			
			return $this->select($q, $values);
		}	
}

 ?>
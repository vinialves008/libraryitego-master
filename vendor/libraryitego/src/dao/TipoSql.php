<?php 
namespace Controller\dao;

/**
* 
*/
class TipoSql extends Sql
{
	
	public function insert($table)
		{
			$q = "CALL sp_tipo_curso_insert(:NOME);";
			$values = array(
				':NOME' => $table->getNome_tipo(),
			);
			
			return $this->select($q, $values);
		}	
}



 ?>
<?php 
namespace Controller\dao;

/**
* 
*/
class FormacaoSql extends Sql
{
	
	public function insert($table)
		{
			$q = "CALL sp_formacao_insert(:NOME);";
			$values = array(
				':NOME' => $table->getNome_formacao()

			);
			
			return $this->select($q, $values);
		}

		public function update($table)
		{
		$q = "CALL sp_formacao_update(:ID,:NOME);";
		$values = array(
			':ID'=> $table->getIdformacao(),
			':NOME' => $table->getNome_formacao()
		);
		
		return $this->select($q, $values);
		}		
}
 ?>
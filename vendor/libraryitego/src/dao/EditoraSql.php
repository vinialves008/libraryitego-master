<?php 
namespace Controller\dao;		
/**
* 
*/
	class EditoraSql extends Sql
	{
		
		public function insert($table)
			{
				$q = "CALL sp_editora_insert(:NOME);";
				$values = array(
					':NOME' => $table->getNome_editora(),
				);
				
				return $this->select($q, $values);
			}	

		public function update($table)
		{
		$q = "CALL sp_editora_update(:ID,:NOME);";
		$values = array(
			':ID'=> $table->getIdeditora(),
			':NOME' => $table->getNome_editora()
		);
		
		return $this->select($q, $values);
		}		
	}


 ?>
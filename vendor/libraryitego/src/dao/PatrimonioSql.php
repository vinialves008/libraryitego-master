<?php 
namespace Controller\dao;

/**
* 
*/
class PatrimonioSql extends Sql
{
	
	public function insert($table)
		{
			$q = "CALL sp_patrimonio_insert(:PATRIMONIO, :LIVRO);";
			$values = array(
				':PATRIMONIO' => $table->getIdpatrimonio(),
				':LIVRO' => $table->getLivro_idlivro()->getIdlivro()

				
			);
			
			return $this->select($q, $values);

		}	
}


 ?>
<?php 
namespace Controller\dao;


/**
* 
*/
class Livro_has_autorSql extends Sql
{
	public function insert($table)
		{
			$q = "CALL sp_livro_has_autor_insert (:LIVRO, :AUTOR);";
			$values = array(
				':LIVRO' => $table->getLivro_idlivro()->getIdlivro(),
				':AUTOR' => $table->getAutor_idautor()->getIdautor()
			);
			return $this->select($q, $values);
		}	
}
	

 ?>
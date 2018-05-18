<?php 
namespace Controller\dao;
/**
* 
*/
class EmprestimoSql extends Sql
{
	
	public function insert($table)
		{
			$q = "CALL sp_emprestimo_insert(:PATRIMONIO, :USUARIO);";
			$values = array(
				':PATRIMONIO' => $table->getPatrimonio_idpatrimonio()->getIdpatrimonio(),
				':USUARIO' => $table->getUsuario_idusuario()->getIdusuario()
			);
			
			return $this->select($q, $values);
		}	
}


 ?>
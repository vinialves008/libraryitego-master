<?php 
namespace Controller\dao;


/**
* 
*/
class SenhaSql extends Sql
{
	
	public function insert($table)
		{
			$q = "CALL sp_usuario_senha_insert(
				:SENHA, :DATA, :USUARIO
			);";
			
			$values = array(
				':SENHA' => $table->getSenha_usuario(),
				':DATA' => $table->getData_cadastro(),
				':USUARIO' => $table->getUsuario_idusuario()->getIdusuario()
			);
			return $this->select($q, $values);
		}
}


 ?>
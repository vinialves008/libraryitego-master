<?php 
namespace Controller\dao;

/**
* 
*/
class CursoSql extends Sql
{
	
	public function insert($table)
		{
			//var_dump($table);
			$q = "CALL sp_curso_insert(:NOME,:TIPO,:CARGA,:VAGAS);";
			//call sp_usuario_insert('Vinicius', 'vinialves08@gmail.com', '04221293136', 62991267068,6233193086, 'AV N3', 'QD 30 LT 20', '0', 'ANÁPOLIS CITY', '75094080', 'ANÁPOLIS', 'GO');
			$values = array(
				':NOME' => $table->getNome_curso(),
				':TIPO'=> $table->getTipo_idtipo()->getIdtipo(),
				':CARGA' => $table->getCarga_horaria(),
				':VAGAS' => $table->getVagas()
				
				
				
			);
			
			return $this->select($q, $values);
		}
		public function search_curso_like_name ($nome_curso, $tipo){

			$q = "SELECT idcurso,nome_curso,nome_tipo from curso inner join tipo on
			curso.tipo_idtipo = tipo.idtipo 

			where nome_curso like '%".$nome_curso."%' ";
			if (!empty($tipo)) {
				$q += " and tipo_idtipo = :TIPO;";
			}

			$values = array(
				//':CURSO' => $nome_curso,
				':TIPO'=> $tipo
			);

			return $this->select($q, $values);
		}
		
}

 ?>
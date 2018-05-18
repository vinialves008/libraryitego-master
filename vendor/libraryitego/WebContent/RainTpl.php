<?php 
namespace ViewController;
use Rain\Tpl;
	/**
	* 
	*/
class RainTpl extends Tpl
{
	
	protected $tpl;
	private $caminho = "vendor/libraryitego/WebContent/view";

	protected $config = array(
		"tpl_dir" => "vendor/libraryitego/WebContent/view/",
		"cache_dir" => "vendor/libraryitego/WebContent/cache/"
	);
	/*protected $menu = array(
		"menu" => array(
				 array(
					"item" => "Acervo", "link" => "/acervo", "dropdown" => "", "toggle" => "", "selected" => false
				),
				 array(
				 	"item" => "Conta", "link" => "/#", "dropdown" => "dropdown", "toggle" => "dropdown-toggle", "selected" => true,
					"submenu" => array(
						array("subitem" => "Cadastre-se", "sublink" => "/cadastro"),
						array("subitem" => "login" , "sublink" => "/login" ),
					)
				 )

		)
	);*/

	/*protected $menu_usuario_comum = array(
		"menu_usuario_comum" => array(
				 array(
					"item" => "Acervo", "link" => "/acervo", "dropdown" => "", "toggle" => "", "selected" => false
				),
				 array(
				 	"item" => "Empréstimo", "link" => "/emprestimo", "dropdown" => "", "toggle" => "", "selected" => false
					
				 ),
				  array(
				 	"item" => "Conta", "link" => "/#", "dropdown" => "dropdown", "toggle" => "dropdown-toggle", "selected" => true,
					"submenu" => array(
						array("subitem" => "Editar", "sublink" => "/editar"),
						array("subitem" => "Desativar" , "sublink" => "/desativar" ),
					)
				 ),
				  array(
				 	"item" => "Sair", "link" => "/index", "dropdown" => "", "toggle" => "", "selected" => false
					
				 ),
				  

		)
	);*/
	
	/*protected $menu_adm_secundario = array(
		"menu_adm_secundario" => array(
				 array(
					"item" => "Acervo", "link" => "/acervo", "dropdown" => "", "toggle" => "", "selected" => false
				),
				 array(
				 	"item" => "Empréstimo", "link" => "/emprestimo", "dropdown" => "", "toggle" => "", "selected" => false
					
				 ),
				  array(
				 	"item" => "Relatórios", "link" => "/relatorios", "dropdown" => "", "toggle" => "", "selected" => false
					
				 ),
				  array(
				 	"item" => "Usuário", "link" => "/#", "dropdown" => "dropdown", "toggle" => "dropdown-toggle", "selected" => true,
					"submenu" => array(
						array("subitem" => "Inserir", "sublink" => "/usuario/cadastro"),
						array("subitem" => "Editar", "sublink" => "/usuario/editar"),
						array("subitem" => "Desativar" , "sublink" => "/usuario/desativar" )
					)
				 ),
				  array(
				 	"item" => "Livro", "link" => "/#", "dropdown" => "dropdown", "toggle" => "dropdown-toggle", "selected" => true,
					"submenu" => array(
						array("subitem" => "Inserir", "sublink" => "/livro/inserir"),
						array("subitem" => "Editar", "sublink" => "/livro/editar"),
						array("subitem" => "Desativar" , "sublink" => "/livro/desativar" )
					)
				 ),
				  array(
				 	"item" => "Curso", "link" => "/#", "dropdown" => "dropdown", "toggle" => "dropdown-toggle", "selected" => true,
					"submenu" => array(
						array("subitem" => "Inserir", "sublink" => "/curso/inserir"),
						array("subitem" => "Editar", "sublink" => "/curso/editar"),
						array("subitem" => "Sair" , "sublink" => "/curso/sair" )
					)
				 )
				  
				  
		)
	);*/

		protected $menu = array(
		"menu" => array(
				 array(
				 	"item" => "Empréstimo", "link" => "/#", "dropdown" => "dropdown", "toggle" => "dropdown-toggle", "selected" => true,
				 	"submenu" => array(
						array("subitem" => "Valor Diário da Multa", "sublink" => "/crud/multa/valor/insert"),
						array("subitem" => "Realizar Empréstimo", "sublink" => "/crud/emprestimo/insert"),
						array("subitem" => "Realizar Avaliação", "sublink" => "/crud/avaliacao/insert")
					)
					
				 ),
				 array(
				 	"item" => "Relatórios", "link" => "/relatorios", "dropdown" => "", "toggle" => "", "selected" => false
					
				 ),
				  array(
				 	"item" => "Usuário", "link" => "/#", "dropdown" => "dropdown", "toggle" => "dropdown-toggle", "selected" => true,
					"submenu" => array(
						array("subitem" => "Inserir", "sublink" => "/crud/usuario/insert"),
						array("subitem" => "Editar", "sublink" => "/conta/editar"),
						array("subitem" => "Desativar" , "sublink" => "/conta/desativar" ),
						array("subitem" => "Nível de Acesso" , "sublink" => "/conta/nivel" )
					)
				 ),
				  array(
				 	"item" => "Funcionário", "link" => "/#", "dropdown" => "dropdown", "toggle" => "dropdown-toggle", "selected" => true,
					"submenu" => array(
						array("subitem" => "Cadastrar Cargo", "sublink" => "/crud/funcionario/cargo/insert"),
						array("subitem" => "Cadastrar Formação", "sublink" => "/crud/funcionario/formacao/insert")
						
					)
				 ),
				  array(
				 	"item" => "Livro", "link" => "/#", "dropdown" => "dropdown", "toggle" => "dropdown-toggle", "selected" => true,
					"submenu" => array(
						array("subitem" => "Cadastrar Livro", "sublink" => "/crud/livro/insert"),
						array("subitem" => "Cadastrar Patrimônio", "sublink" => "/crud/livro/patrimonio/insert"),
						array("subitem" => "Editar", "sublink" => "/livro/editar"),
						array("subitem" => "Listar Livros", "sublink" => "/crud/livro/read"),
						array("subitem" => "Desativar" , "sublink" => "/livro/desativar" ),
						array("subitem" => "Cadastrar área" , "sublink" => "/crud/livro/area/insert" ),
						array("subitem" => "Cadastrar editora" , "sublink" => "/crud/livro/editora/insert" ),
						array("subitem" => "Cadastrar autor" , "sublink" => "/crud/autor/insert" )
					)
				 ),
				  array(
				 	"item" => "Curso", "link" => "/#", "dropdown" => "dropdown", "toggle" => "dropdown-toggle", "selected" => true,
					"submenu" => array(
						array("subitem" => "Cadastrar Curso", "sublink" => "/crud/curso/insert"),
						array("subitem" => "Editar Curso", "sublink" => "/crud/curso/update"),
						array("subitem" => "Desativar" , "sublink" => "/crud/curso/desativar" ),
						array("subitem" => "Cadastrar Tipo Curso" , "sublink" => "/crud/curso/tipo/insert" ),
						

					)
				 ),
				  array(
				  	"item" => "Turma", "link" => "/#", "dropdown" => "dropdown", "toggle" => "dropdown-toggle", "selected" => true,
				  	"submenu" => array(
				  		array("subitem" => "Cadastrar Turma", "sublink" => "/crud/curso/turma/insert"),
						array("subitem" => "Editar Turma", "sublink" => "/crud/curso/turma/update"),
						array("subitem" => "Cadastrar Matricula" , "sublink" => "/crud/curso/aluno/insert" )
				  	)
				  ),
				  array(
				 	"item" => "Sair", "link" => "/index", "dropdown" => "", "toggle" => "", "selected" => false
					
				 )
				  

		)
	);

	function __construct()
	{
		$this->tpl = new Tpl();
		$this->tpl->configure($this->config);
		
		//$this->setData($this->menu);
		//$this->setData($this->menu_usuario_comum);
		//$this->setData($this->menu_adm_secundario);
		$this->setData($this->menu);
		$this->setTpl(array("head", "header","scripts"));
		
		
	}
	protected function setTpl($template = array()){
		foreach ($template as $key => $value) {
			$this->tpl->draw($value);

		}
	}
	public function setData($dados = array()){
		foreach ($dados as $key => $value) {
			$this->tpl->assign($key, $value);
		}		
	}
	public function setDataSelect($dados = array())
	{
		foreach ($dados as $key => $value) {
			$this->setData($key, $value);
		}
	}
	public function setConteudo($value = array(), $data = array())
	{
		$this->setData($data);
		$this->setTpl($value);
	}
	public function setTable($dados = array(), $table)
	{
		foreach ($dados as $key => $value) {
			$method = "set".ucfirst($key);
			if (method_exists($table, $method)) {
				$table->{$method}($value);
			}
		}
		return $table;
	}
	public function getPagination($value = array(),$inicio,$limite)
	{
		$totalLivros = count($value);

		$ultimapag = $totalLivros/$limite;

		if ($inicio == 0) {
			$numero1 = 0;
			$numero2 = 1;
			$numero3 = 2;
		}
		else{
			$numero1 = (int)($inicio -10)/10;
			$numero2 = (int)($inicio )/10;
			$numero3 = (int)($inicio + 10)/10;
		}
		$pages = array(array(
			'numero1' => $numero1 + 1,
			'numero2' => $numero2 + 1,
			'numero3' => $numero3 + 1,
			'pag1' =>  $numero1 *10,
			'pag2' =>  $numero2 *10,
			'pag3' =>  $numero3 *10,
			'ultima' => (int)$ultimapag
		));
		return $pages;
	}
	
	function __destruct(){

		$this->setTpl(array("footer"));
	
	}
	
	
}


 ?>
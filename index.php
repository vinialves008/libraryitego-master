<?php 

	require_once 'vendor/autoload.php';
	use \Slim\Slim;
	use \ViewController\RainTpl;
	use \ViewController\SuperAdmin;
	use \Controller\model\{Usuario, Endereco, Senha, Formacao, Cargo, Area, Editora, Livro, Autor, Livro_has_Autor, Tipo, Curso, Turma_has_Aluno, Aluno, Patrimonio, Valor, Emprestimo, Avaliacao, Funcionario,Turma};
	use \Controller\control\{CrudController,SenhaController, AreaController, EditoraController, LivroController,AutorController, LivroHasAutorController, TipoController, CursoController, TurmaHasAlunoController, AlunoController, CargoController, FormacaoController, PatrimonioController, ValorController, EmprestimoController, AvaliacaoController, FuncionarioController, TurmaController};
	use \Controller\util\Convert;


	$app = new Slim();

	$app->get("/crud/curso/turma/:idcurso/insert",function($idcurso)
	{
		$crud = new TurmaController();
		$rain = new RainTpl();
		$curso = new Curso();
		$tipo = new Tipo();
		$curso->setIdcurso($idcurso);
		$selectCurso = $crud->select($curso, true);
		$tipo = $rain->setTable($selectCurso[0], $tipo);
		$selectCurso[0] = array_merge($selectCurso[0], array(
			'tipo_idtipo' => $tipo
		));
		$curso = $rain->setTable($selectCurso[0], $curso);

		
		$rain->setConteudo(array("cadastro_turma"),
			array(
				'action' => 'insert',
				'title' => 'Cadastrar',
				'idcurso' => $curso->getIdcurso(),
				'nome_curso' => $curso->getNome_curso()

			) 
		);

	});
	$app->get("/crud/curso/turma/insert", function(){

		$rain = new RainTpl();
		$crud = new CursoController();
		$rain->setConteudo(array("busca_curso"), array(

				'tipo' => $crud->select(new Tipo())
		));	
	});
	$app->post("/crud/curso/turma/insert", function(){

		$turma = new Turma();
		$curso = new Curso();
		$tipo = new Tipo();
		$crud = new TurmaController();
		$rain = new RainTpl();

		$curso = $rain->setTable($_POST, $curso);
		$selectCurso = $crud->select($curso, true);
		$tipo = $rain->setTable($selectCurso[0], $tipo);
		$selectCurso[0] = array_merge($selectCurso[0], array(
			'tipo_idtipo' => $tipo
		));
		$curso = $rain->setTable($selectCurso[0], $curso);
		$turma = $rain->setTable($_POST, $turma);

		$turma->setCurso_idcurso($curso);

		$res = $crud->insert($turma);
		if (!empty($res)) {
			$rain->setConteudo(array("mensagem", "cadastro_turma"),
			array(
				'action' => 'insert',
				'title' => 'Cadastrar',
				'mensagem' => 'Turma Cadastrada com sucesso',
				'resultado'  => 'success',
				'idcurso' => $turma->getCurso_idcurso()->getIdcurso(),
				'nome_curso' => $turma->getCurso_idcurso()->getNome_curso()
			));
		}
			else{

			$rain->setConteudo(array("mensagem", "cadastro_turma"),
			array(
				'action' => 'insert',
				'title' => 'Cadastrar',
				'mensagem' => 'Erro ao cadastrar turma',
				'resultado'  => 'danger',
				'idcurso' => $turma->getCurso_idcurso()->getIdcurso(),
				'nome_curso' => $turma->getCurso_idcurso()->getNome_curso()
			));
		}
		

	});

	/*$app->get("/crud/curso/matricula/:idcurso/:idaluno/update", function ($idcurso, $idaluno){
		$rain = new RainTpl();
		$crud = new CursoHasAlunoController();
		$curso_has_aluno = new Curso_has_Aluno();
		$curso = new Curso();
		$tipo = new Tipo();
		$aluno = new Aluno();
		$usuario = new Usuario();
		$endereco = new Endereco();

		$curso->setIdcurso($idcurso);
		$aluno->setIdaluno($idaluno);
		$selectAluno = $crud->select($aluno, true, array($aluno->getUsuario_idusuario()));
		$selectCurso = $crud->select($curso, true, array($curso->getTipo_idtipo()));
		$endereco->setIdendereco($selectAluno[0]['endereco_idendereco']);

		$arrayobjEndereco = array(
			'endereco_idendereco' => $endereco
		);
		$selectAluno[0] = array_merge($selectAluno[0], $arrayobjEndereco);
		
		//var_dump($selectAluno);
		$usuario = $rain->setTable($selectAluno[0], $usuario);

		$arrayobjAluno = array(
			'usuario_idusuario' => $usuario
		);

		$resultAluno = array_merge($selectAluno[0], $arrayobjAluno);
		$aluno = $rain->setTable($resultAluno, $aluno);
		
		$tipo = $rain->setTable($selectCurso[0], $tipo);
		
		$arrayobjCurso = array(
			'tipo_idtipo' => $tipo	
		);	
		$resultCurso = array_merge($selectCurso[0], $arrayobjCurso);
		$curso = $rain->setTable($resultCurso, $curso);

		$curso_has_aluno->setAluno_idaluno($aluno);
		$curso_has_aluno->setCurso_idcurso($curso);
		$matricula = $crud->getMatricula($curso_has_aluno);
		$curso_has_aluno->setMatricula($matricula[0]['matricula']);

	 
		$rain->setConteudo(array("edit_cadastro_curso_has_aluno"),
		array(

				'matricula' => $curso_has_aluno->getMatricula(),
				'aluno' => $crud->select($aluno, false, array($aluno->getUsuario_idusuario())),
				'curso' => $crud->select($curso, false, array($curso->getTipo_idtipo())),
				'idaluno' => $curso_has_aluno->getAluno_idaluno()->getIdaluno(),
				'nome_usuario' => $curso_has_aluno->getAluno_idaluno()->getUsuario_idusuario()->getNome_usuario(),
				'idcurso' => $curso_has_aluno->getCurso_idcurso()->getIdcurso(),
				'action' => 'update',
				'title' => 'Editar'
			)
		);	

	});
	*/
	
	$app->get("/crud/usuario/funcionario/:idfuncionario/update", function ($idfuncionario){
		$rain = new RainTpl();
		$crud = new FuncionarioController();
		$funcionario = new Funcionario();
		$endereco = new Endereco();
		$formacao = new Formacao();
		$cargo = new Cargo();
		$funcionario->setIdfuncionario($idfuncionario);
		$res = $crud->select($funcionario, true);

		
		$selectFuncionario = $crud->select($funcionario, true, array($funcionario->getUsuario_idusuario(), $funcionario->getCargo_idcargo(), $funcionario->getFormacao_idformacao()));

		//$selectFuncionario = $crud->select($funcionario, true, array($funcionario->getUsuario_idusuario()));

		$endereco->setIdendereco($selectFuncionario[0]['endereco_idendereco']);
		$formacao->setIdformacao($selectFuncionario[0]['formacao_idformacao']);
		$cargo->setIdcargo($selectFuncionario[0]['cargo_idcargo']);

		$selectEndereco = $crud->select($endereco, true);
		$formacao = $rain->setTable($selectFuncionario[0], $formacao);
		$cargo = $rain->setTable($selectFuncionario[0], $cargo);

		$funcionario->setFormacao_idformacao($formacao);
		$funcionario->setCargo_idcargo($cargo);
		$endereco = $rain->setTable($selectEndereco[0], $endereco);

		$arrayobj = array(
		
		'endereco_idendereco' => $endereco	
			
		);
		$result = array_merge($selectFuncionario[0], $arrayobj);
		$funcionario->setUsuario_idusuario($rain->setTable($result, $funcionario->getUsuario_idusuario()));
		
		$rain->setConteudo(array("edit_cadastro_funcionario", "scripts_cadastro_usuario"),
			array(
				'idfuncionario' => $funcionario->getIdfuncionario(),
				'idusuario' => $funcionario->getUsuario_idusuario()->getIdusuario(),
				'nome_usuario' => $funcionario->getUsuario_idusuario()->getNome_usuario(),
				'cpf' => $funcionario->getUsuario_idusuario()->getCpf(),
				'email' => $funcionario->getUsuario_idusuario()->getEmail(),
				'telefone_fixo' => $funcionario->getUsuario_idusuario()->getTelefone_fixo(),
				'telefone_celular' => $funcionario->getUsuario_idusuario()->getTelefone_celular(),
				'dtnasc' => Convert::date_to_string($funcionario->getUsuario_idusuario()->getDtnasc()),

				'idendereco' => $funcionario->getUsuario_idusuario()->getEndereco_idendereco()->getIdendereco(),
				'rua' => $funcionario->getUsuario_idusuario()->getEndereco_idendereco()->getRua(),
				'complemento' => $funcionario->getUsuario_idusuario()->getEndereco_idendereco()->getComplemento(),
				'numero' => $funcionario->getUsuario_idusuario()->getEndereco_idendereco()->getNumero(),
				'bairro' =>$funcionario->getUsuario_idusuario()->getEndereco_idendereco()->getBairro(),
				'cep' => $funcionario->getUsuario_idusuario()->getEndereco_idendereco()->getCep(),
				'cidade' => $funcionario->getUsuario_idusuario()->getEndereco_idendereco()->getCidade(),
				'estado' => $funcionario->getUsuario_idusuario()->getEndereco_idendereco()->getEstado(),
				'formacao' => $crud->select(new Formacao()),
				'idformacao' => $funcionario->getFormacao_idformacao()->getIdformacao(),
				'cargo' => $crud->select(new Cargo()),
				'idcargo' => $funcionario->getCargo_idcargo()->getIdcargo(),
				'action' => 'update',
				'title' => 'Editar'
			)
		);	

	});

	/*$app->post("/crud/usuario/update", function ()
	{



	});*/

	$app->get("/crud/usuario/aluno/:idaluno/update",function ($idaluno)
	{	
		$rain = new RainTpl();
		$crud = new AlunoController();
		$aluno = new Aluno();
		$endereco = new Endereco();
		$aluno->setIdaluno($idaluno);
		$res = $crud->select($aluno, true);
		
		$alun = $crud->select($aluno, true, array($aluno->getUsuario_idusuario()));
		$endereco->setIdendereco($alun[0]['endereco_idendereco']);
		$end = $crud->select($endereco, true);
		$endereco = $rain->setTable($end[0], $endereco);
		

		$arrayobj = array(
		
		'endereco_idendereco' => $endereco	
			
		);
		$result = array_merge($alun[0], $arrayobj);
		$aluno->setUsuario_idusuario($rain->setTable($result, $aluno->getUsuario_idusuario()));

		

		$rain->setConteudo(array("edit_cadastro_aluno", "scripts_cadastro_usuario"),
			array(
				'idaluno' => $aluno->getIdaluno(),
				'idusuario' => $aluno->getUsuario_idusuario()->getIdusuario(),
				'nome_usuario' => $aluno->getUsuario_idusuario()->getNome_usuario(),
				'cpf' => $aluno->getUsuario_idusuario()->getCpf(),
				'email' => $aluno->getUsuario_idusuario()->getEmail(),
				'telefone_fixo' => $aluno->getUsuario_idusuario()->getTelefone_fixo(),
				'telefone_celular' => $aluno->getUsuario_idusuario()->getTelefone_celular(),
				'dtnasc' => Convert::date_to_string($aluno->getUsuario_idusuario()->getDtnasc()),
				'idendereco' => $aluno->getUsuario_idusuario()->getEndereco_idendereco()->getIdendereco(),
				'rua' => $aluno->getUsuario_idusuario()->getEndereco_idendereco()->getRua(),
				'complemento' => $aluno->getUsuario_idusuario()->getEndereco_idendereco()->getComplemento(),
				'numero' => $aluno->getUsuario_idusuario()->getEndereco_idendereco()->getNumero(),
				'bairro' =>$aluno->getUsuario_idusuario()->getEndereco_idendereco()->getBairro(),
				'cep' => $aluno->getUsuario_idusuario()->getEndereco_idendereco()->getCep(),
				'cidade' => $aluno->getUsuario_idusuario()->getEndereco_idendereco()->getCidade(),
				'estado' => $aluno->getUsuario_idusuario()->getEndereco_idendereco()->getEstado(),

				'action' => 'update',
				'title' => 'Editar'
			)
		);	
	});



	$app->get("/crud/curso/:idcurso/update",function ($idcurso)
	{	
		$rain = new RainTpl();
		$crud = new CursoController();
		$curso = new Curso();
		$tipo = new Tipo();
		$curso->setIdcurso($idcurso);
		
		$selectCurso = $crud->select($curso, true, array($curso->getTipo_idtipo()));
		$tipo = $rain->setTable($selectCurso[0], $tipo);

		$arrayobj = array(
			'tipo_idtipo' => $tipo
			
		);
		$result = array_merge($selectCurso[0], $arrayobj);
		$curso = $rain->setTable($result, $curso);

		$rain->setConteudo(array("edit_cadastro_curso"),
			array(
				'nome_curso' => $curso->getNome_curso(),
				'idcurso' => $curso->getIdcurso(),
				'tipo' => $crud->select($curso->getTipo_idtipo()),
				'idtipo' => $curso->getTipo_idtipo()->getIdtipo(),
				'action' => 'update',
				'title' => 'Editar'
			)
		);	
	});

	$app->get("/crud/multa/valor/:idvalor/update",function ($idvalor)
	{	
		$rain = new RainTpl();
		$crud = new ValorController();
		$valor = new Valor();
		$valor->setIdvalor($idvalor);
		$selectValor = $crud->select($valor, true);
		$valor->setValor_diario_multa($selectValor[0]['valor_diario_multa']);
		$rain->setConteudo(array("edit_cadastro_valor_multa"),
			array(
				'valor_diario_multa' => $valor->getValor_diario_multa(),
				'idvalor' => $valor->getIdvalor(),
				'action' => 'update',
				'title' => 'Editar'
			)
		);	
	});

	$app->get("/crud/livro/:idlivro/update",function ($idlivro)
	{	
		$rain = new RainTpl();
		$crud = new LivroController();
		$livro = new Livro();
		$editora = new Editora();
		$area = new Area();
		$livro->setIdlivro($idlivro);
		
		$selectLivro = $crud->select($livro, true, array($livro->getEditora_ideditora(),$livro->getArea_idarea()));
		$editora = $rain->setTable($selectLivro[0], $editora);
		$area = $rain->setTable($selectLivro[0], $area);

		$arrayobj = array(
			'editora_ideditora' => $editora,
			'area_idarea' => $area
		);
		$result = array_merge($selectLivro[0], $arrayobj);
		$livro = $rain->setTable($result, $livro);

		$rain->setConteudo(array("edit_cadastro_livro"),
			array(
				'isbn' => $livro->getIsbn(),
				'nome_livro' => $livro->getNome_livro(),
				'ano_livro' => $livro->getAno_livro(),
				'assunto' => $livro->getAssunto(),
				'edicao' => $livro->getEdicao(),
				'idlivro' => $livro->getIdlivro(),
				'area' => $crud->select($livro->getArea_idarea()),
				'editora' => $crud->select($livro->getEditora_ideditora()),
				'ideditora' => $livro->getEditora_ideditora()->getIdeditora(),
				'idarea' => $livro->getArea_idarea()->getIdarea(),
				'action' => 'update',
				'title' => 'Editar'
			)
		);	
	});

	$app->post("/crud/livro/update",function ()
	{	
		$rain = new RainTpl();
		$liv = new Livro();
		$edit = new Editora();
		$are = new Area();

		$livro = $rain->setTable($_POST, $liv);
		$editora = $rain->setTable($_POST, $edit);
		$area = $rain->setTable($_POST, $are);

		$livro->setEditora_ideditora($editora);
		$livro->setArea_idarea($area);
		$livro = $rain->setTable($_POST, $livro);
		$crud = new LivroController();
		$res = $crud->update($livro);
		if (!empty($res)) {
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Livro editado com sucesso!",
				'resultado' => "success"
			) );
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao editar livro",
				'resultado' => "danger"
			) );
			
		}

		
	});

	$app->get("/crud/livro/area/:idarea/update",function ($idarea)
	{	
		$rain = new RainTpl();
		$crud = new CrudController();
		$area = new Area();
		$area->setIdarea($idarea);
		$selectArea = $crud->select($area, true);
		$area->setNome_area($selectArea[0]['nome_area']);
		$rain->setConteudo(array("edit_cadastro_area"),
			array(
				'nome_area' => $area->getNome_area(),
				'idarea' => $area->getIdarea(),
				'action' => 'update',
				'title' => 'Editar'
			)
		);	
	});

	$app->post("/crud/livro/area/update",function ()
	{	
		$rain = new RainTpl();
		$area = new Area();
		$area = $rain->setTable($_POST, $area);
		$crud = new AreaController();
		$res = $crud->update($area);
		if (!empty($res)) {
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Área editada com sucesso!",
				'resultado' => "success"
			) );
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao editar área",
				'resultado' => "danger"
			) );
			
		}

		
	});

	$app->get("/crud/autor/:idautor/update",function ($idautor)
	{	
		$rain = new RainTpl();
		$crud = new CrudController();
		$autor = new Autor();
		$autor->setIdautor($idautor);
		$selectAutor = $crud->select($autor, true);
		$autor->setNome_autor($selectAutor[0]['nome_autor']);
		$rain->setConteudo(array("edit_cadastro_autor"),
			array(
				'nome_autor' => $autor->getNome_autor(),
				'idautor' => $autor->getIdautor(),
				'action' => 'update',
				'title' => 'Editar'
			)
		);	
	});

	$app->post("/crud/autor/update",function ()
	{	
		$rain = new RainTpl();
		$autor = new Autor();
		$autor = $rain->setTable($_POST, $autor);
		$crud = new AutorController();
		$res = $crud->update($autor);
		if (!empty($res)) {
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Autor editado com sucesso!",
				'resultado' => "success"
			) );
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao editar autor",
				'resultado' => "danger"
			) );
			
		}

		
	});

	$app->get("/crud/livro/editora/:ideditora/update",function ($ideditora)
	{	
		$rain = new RainTpl();
		$crud = new CrudController();
		$editora = new Editora();
		$editora->setIdeditora($ideditora);
		$selectEditora = $crud->select($editora, true);
		$editora->setNome_editora($selectEditora[0]['nome_editora']);
		$rain->setConteudo(array("edit_cadastro_editora"),
			array(
				'nome_editora' => $editora->getNome_editora(),
				'ideditora' => $editora->getIdeditora(),
				'action' => 'update',
				'title' => 'Editar'
			)
		);	
	});

	$app->post("/crud/livro/editora/update",function ()
	{	
		$rain = new RainTpl();
		$editora = new Editora();
		$editora = $rain->setTable($_POST, $editora);
		$crud = new EditoraController();
		$res = $crud->update($editora);
		if (!empty($res)) {
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Editora editado com sucesso!",
				'resultado' => "success"
			) );
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao editar editora",
				'resultado' => "danger"
			) );
			
		}

		
	});



	$app->get("/crud/funcionario/cargo/:idcargo/update",function ($idcargo)
	{	
		$rain = new RainTpl();
		$crud = new CrudController();
		$cargo = new Cargo();
		$cargo->setIdcargo($idcargo);
		$selectCargo = $crud->select($cargo, true);
		$cargo->setNome_cargo($selectCargo[0]['nome_cargo']);
		$cargo->setNivel($selectCargo[0]['nivel']);
		$rain->setConteudo(array("edit_cadastro_cargo_funcionario"),
			array(
				'nome_cargo' => $cargo->getNome_cargo(),
				'nivel' => $cargo->getNivel(),
				'idcargo' => $cargo->getIdcargo(),
				'action' => 'update',
				'title' => 'Editar'
			)
		);	
	});

	$app->post("/crud/funcionario/cargo/update",function ()
	{	
		$rain = new RainTpl();
		$cargo = new Cargo();
		$cargo = $rain->setTable($_POST, $cargo);
		$crud = new CargoController();
		$res = $crud->update($cargo);
		if (!empty($res)) {
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Cargo editado com sucesso!",
				'resultado' => "success"
			) );
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao editar cargo",
				'resultado' => "danger"
			) );
			
		}

		
	});

	$app->get("/crud/funcionario/formacao/:idformacao/update",function ($idformacao)
	{	
		$rain = new RainTpl();
		$crud = new CrudController();
		$formacao = new formacao();
		$formacao->setIdformacao($idformacao);
		$selectFormacao = $crud->select($formacao, true);
		$formacao->setNome_formacao($selectFormacao[0]['nome_formacao']);
		$rain->setConteudo(array("edit_cadastro_formacao_funcionario"),
			array(
				'nome_formacao' => $formacao->getNome_formacao(),
				'idformacao' => $formacao->getIdformacao(),
				'action' => 'update',
				'title' => 'Editar'
			)
		);	
	});

	$app->post("/crud/funcionario/formacao/update",function ()
	{	
		$rain = new RainTpl();
		$formacao = new Formacao();
		$formacao = $rain->setTable($_POST, $formacao);
		$crud = new FormacaoController();
		$res = $crud->update($formacao);
		if (!empty($res)) {
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Formacao editado com sucesso!",
				'resultado' => "success"
			) );
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao editar formacao",
				'resultado' => "danger"
			) );
			
		}

		
	});

	
	$app->get("/crud/avaliacao/insert",function ()
	{	
		$rain = new RainTpl();
		$crud = new CrudController();
		$avali = new Avaliacao();
		$avaliacao = $crud->select($avali);
		$emprestimo = new Emprestimo();
		$emprestimo = $crud->select($emprestimo);
		$rain->setConteudo(array("avaliacao"), array(
			'emprestimo' => $emprestimo,
			'action' => 'insert',
			'title' => 'Cadastrar'

			));	
	});

	$app->post("/crud/avaliacao/insert",function ()
	{	
		$rain = new RainTpl();
		$avaliacao =  new Avaliacao();
		$emprestimo = new Emprestimo();
		
		$avaliacao = $rain->setTable($_POST, $avaliacao);
		$emprestimo = $rain->setTable($_POST, $emprestimo);
		
		$avaliacao->setEmprestimo_idemprestimo($emprestimo);

		$crud = new AvaliacaoController();
		$res = $crud->insert($avaliacao);


		if (!empty($res)) {
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Avaliação realizada com sucesso!",
				'resultado' => "success"
			) );
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao realizar avaliação",
				'resultado' => "danger"
			) );
			
		}

	});



	$app->get("/crud/emprestimo/insert",function ()
	{	
		$rain = new RainTpl();
		$crud = new CrudController();
		$patri = new Patrimonio();
		$patrimonio = $crud->select($patri);
		$usr = new Usuario();
		$usuario = $crud->select($usr);
		$rain->setConteudo(array("realizar_emprestimo"), array(
			'patrimonio' => $patrimonio,
			'usuario' => $usuario,
			'action' => 'insert',
			'title' => 'Cadastrar'

			));	
	});

	$app->post("/crud/emprestimo/insert",function ()
	{	
		$rain = new RainTpl();
		$emprestimo = new Emprestimo();
		$patrimonio = new Patrimonio();
		$usuario = new Usuario();
		
		$emprestimo = $rain->setTable($_POST, $emprestimo);
		$patrimonio = $rain->setTable($_POST, $patrimonio);
		$usuario = $rain->setTable($_POST, $usuario);
		
		
		$emprestimo->setPatrimonio_idpatrimonio($patrimonio);
		$emprestimo->setUsuario_idusuario($usuario);
		

		$crud = new EmprestimoController();
		$res = $crud->insert($emprestimo);


		if (!empty($res)) {
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Empréstimo realizado com sucesso!",
				'resultado' => "success"
			) );
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao realizar empréstimo",
				'resultado' => "danger"
			) );
			
		}

	});

	$app->get("/crud/multa/valor/insert",function ()
	{	
		$rain = new RainTpl();
		$rain->setConteudo(array("cadastro_valor_multa"));	
	});

	$app->post("/crud/multa/valor/insert",function ()
	{	
		$rain = new RainTpl();
		$valor = new Valor();
		$valor = $rain->setTable($_POST, $valor);
		$crud = new ValorController();
		$res = $crud->insert($valor);

		if (!empty($res)) {
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Valor fixo diário da multa cadastrado com sucesso!",
				'resultado' => "success",
				'action' => 'insert',
				'title' => 'Cadastrar'
			) );
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao cadastrar valor fixo diário da multa",
				'resultado' => "danger"
			) );
			
		}

	});

	$app->post("/crud/turma/aluno/insert",function (){
		$rain = new RainTpl();
		$crud = new TurmaHasAlunoController();
		$turma = new Turma();
		$aluno = new Aluno();
		$curso = new Curso();

		$resAluno = $crud->getDataToCpf($_POST['cpf']);
		$resTurma = $crud->getDataToIdTurma($_POST['idturma']);

		if (!empty($resAluno) && !empty($resTurma)) {
			

			$rain->setConteudo(array("mensagem","busca_curso_has_aluno","resultado_busca_curso_has_aluno"),array(
					'idaluno' => $resAluno[0]['idaluno'],
					'cpf'=> $resAluno[0]['cpf'],
					'nome_usuario' => $resAluno[0]['nome_usuario'],
					'dtnasc' => Convert::date_to_string($resAluno[0]['dtnasc']),
					'idcurso' => $resTurma[0]['idcurso'],
					'nome_curso' => $resTurma[0]['nome_curso'],
					'nome_tipo' => $resTurma[0]['nome_tipo'],
					'mensagem' => "Dados encontrados com sucesso",
					'resultado' => "success"
			) );

		}
		else{
			if (empty($resAluno)) {
				$mensagem = "Erro ao encontrar CPF ".$_POST['cpf'];
			}else{
				$mensagem = "Erro ao encontrar turma ".$_POST['idturma'];
			}
			$rain->setConteudo(array("mensagem","busca_turma_has_aluno" ),array(
				'mensagem' => $mensagem,
				'resultado' => "danger"
			) );

		}

		//var_dump($aluno);

	});

	$app->get("/crud/turma/matricula/insert",function ()
	{	
		$rain = new RainTpl();
		$rain->setConteudo(array("busca_turma_has_aluno"));
	});

	$app->get("/crud/turma/matricula/:idaluno/:idturma/insert",function ($idaluno,$idturma)
	{	
		$rain = new RainTpl();
		$turma_has_aluno = new Turma_has_Aluno();
		$crud = new TurmaHasAlunoController();
		$turma = new Turma();
		$curso = new Curso();
		$tipo = new Tipo();
		$aluno = new Aluno();
		$usuario = new Usuario();
		$endereco  = new Endereco();

		$aluno->setIdaluno($idaluno);
		$selectAluno = $crud->select($aluno, true, array($aluno->getUsuario_idusuario()));
		
		if (!empty($selectAluno)) {
			$endereco->setIdendereco($selectAluno[0]['endereco_idendereco']);
		$arrayobjEndereco = array(

			'endereco_idendereco' => $endereco
		);
		$selectAluno[0] = array_merge($selectAluno[0], $arrayobjEndereco);

		$usuario = $rain->setTable($selectAluno[0], $usuario);

		$arrayobjUsuario = array(

			'usuario_idusuario' => $usuario
		);
		
		$selectAluno[0] = array_merge($selectAluno[0], $arrayobjUsuario);

		$aluno = $rain->setTable($selectAluno[0], $aluno);

		$turma->setIdturma($idturma);
		
		$selectTurma = $crud->select($turma, true, array($turma->getCurso_idcurso()));
		if (!empty($selectTurma)) {
			$tipo->setIdtipo($selectTurma[0]['tipo_idtipo']);
		$selectTipo = $crud->select($tipo, true);
		$tipo = $rain->setTable($selectTipo[0], $tipo);

		$arrayobjTipo = array(
			'tipo_idtipo' => $tipo

		);

		$selectTurma[0] = array_merge($selectTurma[0], $arrayobjTipo);
		$curso = $rain->setTable($selectTurma[0], $curso);

		$arrayobjCurso = array(
			'curso_idcurso' => $curso

		);

		$selectTurma[0] = array_merge($selectTurma[0], $arrayobjCurso);
		$turma = $rain->setTable($selectTurma[0], $turma);

		$turma_has_aluno->setTurma_idturma($turma);
		$turma_has_aluno->setAluno_idaluno($aluno);

		if (!empty($turma_has_aluno->getTurma_idturma()) && !empty($turma_has_aluno->getAluno_idaluno())) {
			
			$rain->setConteudo(array("cadastro_turma_has_aluno"),array(
				'title' => "Cadastrar",
				'action' => "insert",
				'idturma' => $turma_has_aluno->getTurma_idturma()->getIdturma(),
				'nome_curso' => $turma_has_aluno->getTurma_idturma()->getCurso_idcurso()->getNome_curso(),
				'idcurso' => $turma_has_aluno->getTurma_idturma()->getCurso_idcurso()->getIdCurso(),
				'idaluno' => $turma_has_aluno->getAluno_idaluno()->getIdaluno(),
				'nome_usuario' => $turma_has_aluno->getAluno_idaluno()->getUsuario_idusuario()->getNome_usuario(),
				'cpf' => $turma_has_aluno->getAluno_idaluno()->getUsuario_idusuario()->getCpf(),
				'data_inicio' =>Convert::date_to_string( $turma_has_aluno->getTurma_idturma()->getData_inicio()),
				'data_termino' =>Convert::date_to_string($turma_has_aluno->getTurma_idturma()->getData_termino()),
				'nome_tipo' => $turma_has_aluno->getTurma_idturma()->getCurso_idcurso()->getTipo_idtipo()->getNome_tipo()
				
			) );
		}
		else
		{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao cadastrar matrícula",
				'resultado' => "danger"
			) );
		}
		}
		else{
			$rain->setConteudo(array("mensagem", "busca_turma_has_aluno"),array(
				'mensagem' => "Turma não foi encontrada",
				'resultado' => "danger"
			) );
		}
		}
		else{
			$rain->setConteudo(array("mensagem", "busca_turma_has_aluno"),array(
				'mensagem' => "Aluno não foi encontrado",
				'resultado' => "danger"
			) );
		}

		});
	$app->post("/crud/turma/matricula/insert",function ()
	{	
		$rain = new RainTpl();
		$turma_has_aluno = new Turma_has_Aluno();
		$crud = new TurmaHasAlunoController();
		$turma = new Turma();
		$aluno = new Aluno();

		/*$turma_has_aluno = $rain->setTable($_POST, $turma_has_alun);
		$curso = $rain->setTable($_POST, $curs);
		$aluno = $rain->setTable($_POST, $alu);
	

		$turma_has_aluno->setCurso_idcurso($curso);
		$turma_has_aluno->setAluno_idaluno($aluno);
		

		$crud = new TurmaHasAlunoController();
		$res = $crud->insert($turma_has_aluno);*/
		$aluno->setIdaluno($_POST['idaluno']);
		$selectAluno = $crud->select($aluno, true);
		$turma->setIdturma($_POST['idturma']);
		$selectTurma = $crud->select($turma, true);

		$turma_has_aluno->setMatricula($_POST['matricula']);
		$selectMatricula = $crud->select($turma_has_aluno, true);

		if (!empty($selectAluno) && (!empty($selectTurma))) {
				
				if (empty($selectMatricula)) {
					
					$turma->setIdturma($selectTurma[0]['idturma']);
					$aluno->setIdaluno($selectAluno[0]['idaluno']);
					$turma_has_aluno->setMatricula($_POST['matricula']);

					$turma_has_aluno->setTurma_idturma($turma);
					$turma_has_aluno->setAluno_idaluno($aluno);

					$res = $crud->insert($turma_has_aluno);
					if (!empty($res)) {
						$rain->setConteudo(array("mensagem", "busca_turma_has_aluno"),array(
							'mensagem' => "Matrícula cadastrada com sucesso",
							'resultado' => "success"
						) );
					}
					else
						{
							$rain->setConteudo(array("mensagem", "busca_turma_has_aluno"),array(
								'mensagem' => "Erro ao cadastrar matrícula",
								'resultado' => "danger"
							) );
						}
				}
				else{
					$rain->setConteudo(array("mensagem", "busca_turma_has_aluno"),array(
					'mensagem' => "Matrícula já está cadastrada",
					'resultado' => "danger"
			) );
				}
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao encontrar Curso ou Aluno",
				'resultado' => "danger"
			) );
		}
	
		/*if (!empty($res[0])) {
			
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Matrícula cadastrada com sucesso",
				'resultado' => "success"
			) );
		}
		else
		{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao cadastrar matrícula",
				'resultado' => "danger"
			) );
		}*/

		});


	$app->get("/crud/livro/:idlivro/autor/insert", function($idlivro){
		$rain = new RainTpl();
		$crud = new CrudController();
		$aut = new Autor();
		$autor = $crud->select($aut);
		$rain->setConteudo(array("mensagem","cadastro_livro_has_autor"),array(
				'mensagem' => "Cadastrado com sucesso!",
				'resultado' => "success",
				'idlivro' => $idlivro,
				'autor' => $autor,
				'action' => 'insert',
				'title' => 'Cadastrar'
			) );
	});

	$app->post("/crud/livro/autor/insert",function ()
	{	
		$rain = new RainTpl();
		$livro_has_autor = new Livro_has_Autor();
		$livro = new Livro();
		$autor = new Autor();
		$autor = $rain->setTable($_POST, $autor);
		$livro = $rain->setTable($_POST, $livro);

		$livro_has_autor->setAutor_idautor($autor);
		$livro_has_autor->setLivro_idlivro($livro);


		$crud = new LivroHasAutorController();
		$res = $crud->insert($livro_has_autor);
		
		if (!empty($res)) {
			$caminho = "/crud/livro/".$res[0]['livro_idlivro']."/autor/insert";
			header("Location: $caminho");
			exit();
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao cadastrar autor",
				'resultado' => "danger"
			) );
			
		}
			
	});

	$app->get("/crud/funcionario/cargo/insert",function ()
	{	
		$rain = new RainTpl();
		$rain->setConteudo(array("cadastro_cargo_funcionario"), array(
			'action' => 'insert',
			'title' => 'Cadastrar'

		));	
	});
	$app->post("/crud/funcionario/cargo/insert",function ()
	{	
		$rain = new RainTpl();
		$cargo = new Cargo();
		$cargo = $rain->setTable($_POST, $cargo);
		$crud = new CargoController();
		$res = $crud->insert($cargo);

		if (!empty($res)) {
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Cargo cadastrado com sucesso!",
				'resultado' => "success"
				
			) );
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao cadastrar cargo",
				'resultado' => "danger"
			) );
			
		}

	});

	$app->get("/crud/funcionario/formacao/insert",function ()
	{	
		$rain = new RainTpl();
		$rain->setConteudo(array("cadastro_formacao_funcionario"), array(
			'action' => 'insert',
			'title' => 'Cadastrar'
		));	
	});
	$app->post("/crud/funcionario/formacao/insert",function ()
	{	
		$rain = new RainTpl();
		$formacao = new Formacao();
		$formacao = $rain->setTable($_POST, $formacao);
		$crud = new FormacaoController();
		$res = $crud->insert($formacao);

		if (!empty($res)) {
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Formação cadastrado com sucesso!",
				'resultado' => "success"
			) );
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao cadastrar Formação",
				'resultado' => "danger"
			) );
			
		}

	});

	$app->get("/crud/livro/area/insert",function ()
	{	
		$rain = new RainTpl();
		$rain->setConteudo(array("cadastro_area"), array(
			'action' => 'insert',
			'title' => 'Cadastrar'
		));	
	});

	$app->post("/crud/livro/area/insert",function ()
	{	
		$rain = new RainTpl();
		$area = new Area();
		$area = $rain->setTable($_POST, $area);
		$crud = new AreaController();
		$res = $crud->insert($area);

		if (!empty($res)) {
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Área cadastrada com sucesso!",
				'resultado' => "success"
			) );
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao cadastrar área",
				'resultado' => "danger"
			) );
			
		}

	});

	$app->get("/crud/autor/insert",function ()
	{	
		$rain = new RainTpl();
		$rain->setConteudo(array("cadastro_autor"), array(
			'action' => 'insert',
			'title' => 'Cadastrar'
		));	
	});
	

	$app->post("/crud/autor/insert",function ()
	{	
		$rain = new RainTpl();
		$autor = new Autor();
		$autor = $rain->setTable($_POST, $autor);
		$crud = new AutorController();
		$res = $crud->insert($autor);

		if (!empty($res)) {
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Autor cadastrado com sucesso",
				'resultado' => "success"
			) );
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao cadastrar autor",
				'resultado' => "danger"
			) );
			
		}
	});

	

	$app->get("/crud/livro/editora/insert",function ()
	{	
		$rain = new RainTpl();
		$rain->setConteudo(array("cadastro_editora") ,array(
			'action' => 'insert',
			'title' => 'Cadastrar'

		));	
	});

	$app->post("/crud/livro/editora/insert",function ()
	{	
		$rain = new RainTpl();
		$editora = new Editora();
		$editora = $rain->setTable($_POST, $editora);
		$crud = new EditoraController();
		$res = $crud->insert($editora);

		if (!empty($res)) {
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Editora ".$res[0]['nome_editora']." cadastrada com sucesso!",
				'resultado' => "success"
			) );
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao cadastrar editora",
				'resultado' => "danger"
			) );
			
		}

	});


	/*$app->get("/",function ()
	{
		//echo $_SERVER["DOCUMENT_ROOT"];
		$rain = new RainTpl();
		$rain->draw("index");			
	});*/
	$app->get("/crud/usuario/select",function ()
	{	
		$usr = new Controller\model\Aluno();	
		$crud = new CrudController();
		$res = $crud->select($usr);
		$rain = new RainTpl();
		
		$rain->setConteudo(array("teste"),array(
			'usuario' => $res,
			'action' => 'insert',
			'title' => 'Cadastrar'
		));
	});

	$app->post("/crud/usuario/:action",function($action)
	{
		$tipo = ucfirst($_POST['tipo_usuario']);

		$rain = new RainTpl();
		$class = "Controller\model\\".$tipo;
		$usr = new $class();
		//$usr = new {$class}();
		$usuario = new Usuario();
		$end = new Endereco();
		$senha = new Senha();

		
		$usr = $rain->setTable($_POST, $usr);
		$usuario = $rain->setTable($_POST, $usuario);
		$end = $rain->setTable($_POST, $end);
		$usuario->setEndereco_idendereco($end);
		$senha = $rain->setTable($_POST, $senha);
		
		$usr->setUsuario_idusuario($usuario);

		if (strcmp($_POST['tipo_usuario'], "funcionario") === 0) {
			$formacao = new Formacao();
			$cargo = new Cargo();
			$carg = $rain->setTable($_POST, $cargo);
			$form = $rain->setTable($_POST, $formacao);

			$usr->setFormacao_idformacao($form);
			$usr->setCargo_idcargo($carg);
			
		}

		$classController = "Controller\control\\".$tipo . "Controller";
		$crud = new $classController();
		$res = $crud->{$action}($usr);
	
		if (strcmp($action, "insert") === 0) {	
		
			if (!empty($res)) {
				$usuario->setIdusuario($res[0]['usuario_idusuario']);
				
				$senha->setUsuario_idusuario($usuario);
				$senha->setData_cadastro($res[0]['first_register']);

				$senhaController = new SenhaController();
		
				unset($res);
				$res = $senhaController->insert($senha);
				if (!empty($res)) {
					# code...
				}
				else{
					$rain->setConteudo(array("mensagem", "cadastro"),array(
					'mensagem' => "Erro ao cadastrar Usuário",
					'resultado' => "danger",
					'title' => 'Cadastrar',
					'action' => 'insert'
			) );
				}
			}else{
					$rain->setConteudo(array("mensagem", "cadastro"),array(
					'mensagem' => "Erro ao cadastrar Usuário",
					'resultado' => "danger",
					'title' => 'Cadastrar',
					'action' => 'insert'
				));
			}
		}
		else{
			if (!empty($res)) {
				

				$array_usuario = array(
				
				'idusuario' => $res[0]['idusuario'],
				'nome_usuario' => $res[0]['nome_usuario'],
				'cpf' => $res[0]['cpf'],
				'email' => $res[0]['email'],
				'telefone_fixo' => $res[0]['telefone_fixo'],
				'telefone_celular' => $res[0]['telefone_celular'],
				'dtnasc' => Convert::date_to_string($res[0]['dtnasc']),

				'idendereco' =>$res[0]['idendereco'],
				'rua' => $res[0]['rua'],
				'complemento' => $res[0]['complemento'],
				'numero' => $res[0]['numero'],
				'bairro' =>$res[0]['bairro'],
				'cep' => $res[0]['cep'],
				'cidade' =>$res[0]['cidade'],
				'estado' => $res[0]['estado'],
				
				'action' => 'update',
				'title' => 'Editar'
			);
				if ($tipo === 'Funcionario') {

					$array_usuario_funcionario = array(
						'idfuncionario' => $res[0]['idfuncionario'],
						'formacao' => $crud->select(new Formacao()),
						'idformacao' => $res[0]['formacao_idformacao'],
						'cargo' => $crud->select(new Cargo()),
						'idcargo' => $res[0]['cargo_idcargo']
					);
					$array_usuario_result = array_merge($array_usuario, $array_usuario_funcionario);
				}
				else{
					$array_usuario_aluno = array(
						'idaluno' => $res[0]['idaluno']
						
					);
					$array_usuario_result = array_merge($array_usuario, $array_usuario_aluno);


				}
				$array_usuario_result  = array_merge($array_usuario_result, array(
					'mensagem' => "Usuário editado com sucesso",
					'resultado' => "success",
					'title' => 'Editar',
					'action' => 'update'

				));
				$rain->setConteudo(array("mensagem", "edit_cadastro_".strtolower($tipo), "scripts_cadastro_usuario"), $array_usuario_result);
			}
			else{
				$rain->setConteudo(array("mensagem", "edit_cadastro_".strtolower($tipo), "scripts_cadastro_usuario"),array(
					'mensagem' => "Erro ao editar Usuário",
					'resultado' => "danger",
					'title' => 'Editar',
					'action' => 'update'

				));
			}
		}


		

	});

	$app->get("/crud/usuario/insert",function()
	{
		$crud = new CrudController();
		$formacao = new Formacao();
		$cargo = new Cargo();

		$carg = $crud->select($cargo);
		$form = $crud->select($formacao);
		

		$rain = new RainTpl();
		$rain->setConteudo(array("cadastro","scripts_cadastro_usuario"),
			array(
				'formacao' => $form,
				'cargo' => $carg,
				'action' => 'insert',
				'title' => 'Cadastrar'
			) 
		);

	});
	

	$app->get("/crud/livro/insert",function ()
	{	
		$rain = new RainTpl();
		$crud = new CrudController();
		$edit = new Editora();
		$editora = $crud->select($edit);
		$are = new Area();
		$area = $crud->select($are);


		$rain->setConteudo(array("cadastro_livro"), array(
			'editora' => $editora,
			'area' => $area,
			'action' => 'insert',
			'title' => 'Cadastrar'
		));	
	});

	$app->post("/crud/livro/insert",function ()
	{	
		$rain = new RainTpl();
		$liv = new Livro();
		$edit = new Editora();
		$are = new Area();

		$livro = $rain->setTable($_POST, $liv);
		$editora = $rain->setTable($_POST, $edit);
		$area = $rain->setTable($_POST, $are);

		$livro->setEditora_ideditora($editora);
		$livro->setArea_idarea($area);

		$crud = new LivroController();
		$res = $crud->insert($livro);
		
		if (!empty($res[0])) {
			
			$caminho = "/crud/livro/".$res[0]['idlivro']."/autor/insert";
			header("Location: $caminho");
			exit();
		}
		else
		{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao cadastrar livro",
				'resultado' => "danger"
			) );
		}



	});

	$app->get("/crud/curso/tipo/insert",function ()
	{	
		$rain = new RainTpl();
		$rain->setConteudo(array("cadastro_tipo_curso"), array(
			'action' => 'insert',
			'title' => 'Cadastrar'
		));	
	});

	$app->post("/crud/curso/tipo/insert",function ()
	{	
		$rain = new RainTpl();

		$tipo = new Tipo();
		$tipo = $rain->setTable($_POST, $tipo);
		$crud = new TipoController();
		$res = $crud->insert($tipo);


		if (!empty($res)) {
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Tipo de curso cadastrado com sucesso!",
				'resultado' => "success"
			) );
		}
		else{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao cadastrar o tipo de curso",
				'resultado' => "danger"
			) );
			
		}
			
	});

	$app->get("/crud/curso/insert",function ()
	{	
		$rain = new RainTpl();
		$crud = new CrudController();
		$tip = new Tipo();
		$tipo = $crud->select($tip);
		$rain->setConteudo(array("cadastro_curso"), array(
			'tipo' => $tipo,
			'action' => 'insert',
			'title' => 'Cadastrar'	
			));
	});

	$app->post("/crud/curso/insert",function ()
	{	
		$rain = new RainTpl();
		$curs = new Curso();
		$tip = new Tipo();

		$curso = $rain->setTable($_POST, $curs);
		$tipo = $rain->setTable($_POST, $tip);

		$curso->setTipo_idtipo($tipo);
		//var_dump($_POST);

		$crud = new CursoController();
		$res = $crud->insert($curso);

		
		if (!empty($res[0])) {
			
			$rain->setConteudo(array("mensagem" ,"cadastro_curso"),array(
				'mensagem' => "Curso Cadastrado com sucesso",
				'resultado' => "success",
				'action' => "insert",
				'title' => "Cadastrar"
			) );
		}
		else
		{
			$rain->setConteudo(array("mensagem", "cadastro_curso"),array(
				'mensagem' => "Erro ao cadastrar curso",
				'resultado' => "danger",
				'action' => "insert",
				'title' => "Cadastrar"
			) );
		}



	});

	$app->get("/crud/livro/patrimonio/insert",function()
	{
		$rain = new RainTpl();
		$crud = new PatrimonioController();
		$liv = new Livro();

		$livro = $crud->select($liv);
		
		
		$rain->setConteudo(array("cadastro_patrimonio"),
			array(
				'livro' => $livro,
				'action' => 'insert',
				'title' => 'Cadastrar'
				
			) 
		);
		
	});

	$app->post("/crud/livro/patrimonio/insert",function ()
	{	
		$rain = new RainTpl();
		$patri = new Patrimonio();
		$liv = new Livro();

		$patrimonio = $rain->setTable($_POST, $patri);
		$liv = $rain->setTable($_POST, $liv);

		$patrimonio->setLivro_idlivro($liv);


		$crud = new PatrimonioController();
		$res = $crud->insert($patrimonio);

		
		if (!empty($res[0])) {
			
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Patrimônio Cadastrado com sucesso",
				'resultado' => "success"
			) );
		}
		else
		{
			$rain->setConteudo(array("mensagem"),array(
				'mensagem' => "Erro ao cadastrar Patrimônio",
				'resultado' => "danger"
			) );
		}



	});
	$app->get("/crud/curso/search",function (){
		$tipo = new Tipo();
		$rain = new RainTpl();
		$crud = new CrudController();
		$rain->setConteudo(array("busca_curso"), array(
			'tipo' => $crud->select($tipo)
		));	
	});
	$app->post("/crud/curso/search",function ()
	{	
	
		$crud = new CursoController();
		$tipo = new Tipo();
		$tipo->setIdtipo($_POST['idtipo']);
		$tipo = $crud->select($tipo, true);

		$resultado = $crud->search_curso_like_name($_POST['nome_curso'], $_POST['idtipo']);
		
		$rain = new RainTpl();
		if (!empty($resultado)) {
			$rain->setConteudo(array("busca_curso", "resultado_busca_curso"), array(
			'resultcurso' => $resultado,
			'tipo' => $crud->select(new Tipo())

		));	

		}
		else{
			$rain->setConteudo(array("mensagem", "busca_curso"), array(

			'mensagem' => 'Não foram encontrados cursos com nome '.$_POST['nome_curso'].' e com tipo '.$tipo[0]['nome_tipo'],
			'resultado' => 'danger',

			'tipo' => $crud->select(new Tipo())

		));	

		}
		
	});
	$app->get("/crud/livro/:inicio/:limite/read", function($inicio, $limite){

		$rain = new RainTpl();
		$crud = new LivroController();
		/*$previous = array(
			'previous' => ""
		);
		if ($inicio == 0) {
			$previous = array(
				'previous' => 'disabled'
			);
		}*/
		$list = array(
			'inicio' => $inicio,
			'limite' => $limite,
			'ordem' => 'nome_livro'
		);
		//$list = array_merge($list, $previous);
		$resultadoLivro = $crud->read(new Livro(),$list, array(new Editora(), new Area()));
		

		$rain->setConteudo(array("read_livro", "pagination"), array(

			'resultlivro' => $resultadoLivro, 
			'pages' => $rain->getPagination($resultadoLivro, $inicio,$limite)
		));
		
	});

	$app->get("/",function ()
	{	
		$rain = new RainTpl();
		$rain->setConteudo(array("index"));	
	});

	$app->get("/teste",function ()
	{	
		$turma = new Turma();
		echo $turma->getTableKeyName();
		
	});


	$app->run();


 ?>
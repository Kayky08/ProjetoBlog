<?php
	class rotas{
		private array $rotas = array();
		
		public function get(string $nome, array $dados){
			$this->rotas['GET'][$nome] = $dados;
		}
		public function post(string $nome, array $dados){
			$this->rotas['POST'][$nome] = $dados;
		}
		public function verificar_rota(string $metodo, string $uri){
			if(isset($this->rotas[$metodo][$uri])){
				$dados_rota = $this->rotas[$metodo][$uri];
				$classe = $dados_rota[0];
				$metodo = $dados_rota[1];
				$obj = new $classe();
				return $obj->$metodo();
			}
			else{
				echo "Rota Inválida";
			}
		}
	}

    //Criando a rota
	$route = new Rotas();

    //Inicio
	//$route->get("/", [inicioController::class,"inicio"]);
	
	//Posts
	$route->get("/", [postsController::class,"listar"]);
	$route->get("/inserirPosts", [postsController::class,"inserir"]);
	$route->post("/inserirPosts", [postsController::class,"inserir"]);
	$route->get("/deletarPosts", [postsController::class,"deletar"]);

	//Usuarios
	$route->get("/listarUsuarios", [usuariosController::class,"listar"]);
	$route->get("/inserirUsuarios", [usuariosController::class,"inserir"]);
	$route->post("/inserirUsuarios", [usuariosController::class,"inserir"]);
	$route->get("/alterarUsuarios", [usuariosController::class,"alterar"]);
	$route->post("/alterarUsuarios", [usuariosController::class,"alterar"]);
	$route->get("/deletarUsuarios", [usuariosController::class,"deletar"]);
	//Login/Logout
	$route->get("/login", [usuariosController::class,"login"]);
	$route->post("/login", [usuariosController::class,"login"]);
	$route->get("/logout", [usuariosController::class,"logout"]);
?>
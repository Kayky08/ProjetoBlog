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
	$route->get("/", [inicioController::class,"inicio"]);
	
	//Posts
	$route->get("/listar", [postsController::class,"listar"]);
	$route->get("/inserir", [postsController::class,"inserir"]);
	$route->post("/inserir", [postsController::class,"inserir"]);
	$route->get("/alterar", [postsController::class,"alterar"]);
	$route->post("/alterar", [postsController::class,"alterar"]);
	$route->get("/deletar", [postsController::class,"deletar"]);
?>
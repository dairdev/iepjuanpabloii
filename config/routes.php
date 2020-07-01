<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Slim\Views\PhpRenderer;


return function (App $app) {

	$app->get('/', function (
		ServerRequestInterface $request,
		ResponseInterface $response,
		$args
	) {
		$renderer = new PhpRenderer('./templates');

		//$response->getBody()->write('Hello, Dennis!');

		return $renderer->render($response, "inicio.php", $args);
	});

$app->get('/login', function (
		ServerRequestInterface $request,
		ResponseInterface $response
	) {
		return $response
			->withHeader('Location', '/intranet/')
			->withStatus(302);
	});

	$app->get('/usuarios', function (
		ServerRequestInterface $request,
		ResponseInterface $response
	) {

		$usuarios = array();
		try{
			$pdo = $this->get('PDO');
			$query = $pdo->query('SELECT public_id, login FROM Usuario');
			$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			echo $e->getMessage();
		}
		$response->getBody()->write(json_encode($usuarios));

		return $response;
	});

	$app->group('/api', function( Group $group ) {

		$group->group('/auth', function( Group $group ) {

			$group->get('/test', function (Request $request, Response $response) {
				$response->getBody()->write('Api Test Successfull');
				return $response;
			});

			$group->post('/login', function (Request $request, Response $response) {
				$formData = (array)$request->getParsedBody();
				$pdo = $this->get('PDO');
				$stmt = $pdo->prepare('SELECT public_id, Empleado_id, Alumno_id FROM Usuario WHERE login=:login and pwd=MD5(:pwd)');
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				$stmt->bindParam(':login', $formData['login']);
				$stmt->bindParam(':pwd', $formData['pwd']);
				$stmt->execute();
				$result = $stmt->fetch();
				if( $result != null ){
					if($result['Alumno_id'] != null) {
						$stmtAlumno = $pdo->prepare('SELECT nombre, paterno, materno, dni, Grado_id FROM Alumno WHERE id=:alumno_id');
						$stmtAlumno->setFetchMode(PDO::FETCH_ASSOC);
						$stmtAlumno->bindParam(':alumno_id', $result['Alumno_id']);
						$stmtAlumno->execute();
						$resultAlumno = $stmtAlumno->fetch();
						$result["nombre"] = $resultAlumno["nombre"];
						$result["paterno"] = $resultAlumno["paterno"];
						$result["materno"] = $resultAlumno["materno"];
						$result["dni"] = $resultAlumno["dni"];
						$result["grado"] = $resultAlumno["Grado_id"];
					}else{
						$stmtEmpleado = $pdo->prepare('SELECT nombre, paterno, materno, dni FROM Empleado WHERE id=:empleado_id');
						$stmtEmpleado->setFetchMode(PDO::FETCH_ASSOC);
						$stmtEmpleado->bindParam(':empleado_id', $result['Empleado_id']);
						$stmtEmpleado->execute();
						$resultEmpleado = $stmtEmpleado->fetch();
						$result["nombre"] = $resultEmpleado["nombre"];
						$result["paterno"] = $resultEmpleado["paterno"];
						$result["materno"] = $resultEmpleado["materno"];
					}
				}
				$response->getBody()->write(json_encode($result));
				return $response;
			});

		});


		$group->group('/admin', function( Group $group ) {

			$group->group('/recursos', function( Group $group ) {

				$group->get('/list[/{grado}]', function (Request $request, Response $response, $args) {
					$pdo = $this->get('PDO');
					$sql = 'SELECT id, '
						. ' titulo, '
						. ' publicado_en, '
						. ' tipo, '
						. ' url, '
						. ' grado_descripcion,'
						. ' nivel, '
						. ' grado, '
						. ' modificado_en,'
						. ' modificado_por,'
						. ' Grado_id'
						. ' FROM virtualschool.vwListRecursos ';
						if($args['grado'] > 0){
							$sql = $sql . ' WHERE Grado_id = ' . (int)$args['grado'];
						}
						$sql = $sql . ' ORDER BY publicado_en DESC';
						$stmt = $pdo->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_ASSOC);
					$stmt->execute();
					$result = $stmt->fetchAll();
					$response->getBody()->write(json_encode($result));
					return $response;

				});

				$group->post('/new', function (Request $request, Response $response) {
					try{
						$formData = (array)$request->getParsedBody();
						$usuario_id = 1;
						$pdo = $this->get('PDO');
						$sql = 'INSERT INTO  `virtualschool`.`Recurso`'
							. '(titulo, publicado_en, tipo, url, Grado_id, creado_por, creado_en ) '
							. ' VALUES ('
							. ' :titulo, '
							. ' :publicado_en, '
							. ' :tipo, '
							. ' :url, '
							. ' :grado, '
							. ' :creado_por, '
							. ' CURRENT_TIMESTAMP )';
						$stmt = $pdo->prepare($sql);
						$stmt->bindParam(':titulo', $formData['titulo']);
						$stmt->bindParam(':publicado_en', $formData['publicado_en']);
						$stmt->bindParam(':tipo', $formData['tipo']);
						$stmt->bindParam(':url', $formData['url']);
						$stmt->bindParam(':grado', $formData['grado']);
						$stmt->bindParam(':creado_por', $usuario_id);
						$result = $stmt->execute();
						$response->getBody()->write(json_encode(array("result"=>$result, "params"=> $formData )));
					}catch(Exception $e){
						$response->getBody()->write($e->getMessage());
					}
					return $response;

				});

				$group->put('/update', function (Request $request, Response $response) {
					try{
						$formData = (array)$request->getParsedBody();
						$usuario_id = 1;
						$pdo = $this->get('PDO');
						$sql = 'UPDATE `virtualschool`.`Recurso` SET'
							. ' titulo = :titulo, '
							. ' publicado_en = :publicado_en, '
							. ' tipo = :tipo, '
							. ' url = :url, '
							. ' Grado_id = :grado, '
							. ' modificado_por = :modificado_por, '
							. ' modificado_en = CURRENT_TIMESTAMP '
							. ' WHERE id = :id ';
						$stmt = $pdo->prepare($sql);
						$stmt->bindParam(':titulo', $formData['titulo']);
						$stmt->bindParam(':publicado_en', $formData['publicado_en']);
						$stmt->bindParam(':tipo', $formData['tipo']);
						$stmt->bindParam(':url', $formData['url']);
						$stmt->bindParam(':grado', $formData['grado']);
						$stmt->bindParam(':modificado_por', $formData['usuario_id']);
						$stmt->bindParam(':id', $formData['id']);
						$result = $stmt->execute();
						$response->getBody()->write(json_encode(array("result"=>$result)));
					}catch(Exception $e){
						$response->getBody()->write($e->getMessage());
					}
					return $response;
				});

				$group->delete('/delete', function (Request $request, Response $response) {
					try{
						$formData = (array)$request->getParsedBody();
						$pdo = $this->get('PDO');
						$sql = 'DELETE FROM `virtualschool`.`Recurso` '
							. ' WHERE id = :id ';
						$stmt = $pdo->prepare($sql);
						$stmt->bindParam(':id', $formData['id']);
						$result = $stmt->execute();
						$response->getBody()->write(json_encode(array("result"=>$result)));
					}catch(Exception $e){
						$response->getBody()->write($e->getMessage());
					}
					return $response;
				});

			});

			$group->group('/grado', function( Group $group ) {

				$group->get('/list', function (Request $request, Response $response) {
					$pdo = $this->get('PDO');
					$sql = 'SELECT id, grado, nombre'
						. ' FROM virtualschool.vwListGrados';
					$stmt = $pdo->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_ASSOC);
					$stmt->execute();
					$result = $stmt->fetchAll();
					$response->getBody()->write(json_encode($result));
					return $response;
				});


			});

		});


	});

};

<?php
require_once 'stConexao.php';

class tarefas
{

	public static $instance;
	public static $tabela = 'tarefas';


//--------- function insert($obj) --------------//
	public static function getAutoInc()
	{
		$stmt = Conexao::getInstance()->prepare("SHOW TABLE STATUS LIKE '" . self::$tabela . "'");

		if ($stmt->execute()) {
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$cod_produto = $row->Auto_increment;
				return $cod_produto;
			}
		}
	}


	public static function insert($obj)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("INSERT INTO tarefas 
            (nome_tarefa, id_tipo, palavra_chave, briefing_tarefa, estagio_compra, 
            tipo_cta, referencias, consideracoes_gerais, id_persona, id_projeto, id_equipe) VALUES
            (:nome_tarefa, :id_tipo, :palavra_chave, :briefing_tarefa, :estagio_compra,
            :tipo_cta, :referencias, :consideracoes_gerais, :id_persona, :id_projeto, :id_equipe);");

			$stmt->bindParam(":nome_tarefa", $obj->nome_tarefa);
			$stmt->bindParam(":id_tipo", $obj->id_tipo);
			$stmt->bindParam(":palavra_chave", $obj->palavra_chave);
			$stmt->bindParam(":briefing_tarefa", $obj->briefing_tarefa);
			$stmt->bindParam(":estagio_compra", $obj->estagio_compra);
			$stmt->bindParam(":tipo_cta", $obj->tipo_cta);
			$stmt->bindParam(":referencias", $obj->referencias);
			$stmt->bindParam(":consideracoes_gerais", $obj->consideracoes_gerais);
			$stmt->bindParam(":id_persona", $obj->id_persona);
			$stmt->bindParam(":id_projeto", $obj->id_projeto);
			$stmt->bindParam(":id_equipe", $obj->id_equipe);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
	}


 //------------------ function update($obj)  ---------//

	public static function update($obj)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("UPDATE tarefas SET "
				. " nome_tarefa = :nome_tarefa ,"
				. " id_tipo = :id_tipo ,"
				. " palavra_chave = :palavra_chave ,"
				. " briefing_tarefa = :briefing_tarefa ,"
				. " estagio_compra = :estagio_compra ,"
				. " id_projeto = :id_projeto ,"
				. " tipo_cta = :tipo_cta ,"
				. " referencias = :referencias ,"
				. " consideracoes_gerais = :consideracoes_gerais ,"
				. " id_persona = :id_persona ,"
				. " id_equipe = :id_equipe"
				. " WHERE id_tarefa = :id_tarefa ");

			$stmt->bindParam(":id_tarefa", $obj->id_tarefa);
			$stmt->bindParam(":nome_tarefa", $obj->nome_tarefa);
			$stmt->bindParam(":id_tipo", $obj->id_tipo);
			$stmt->bindParam(":palavra_chave", $obj->palavra_chave);
			$stmt->bindParam(":briefing_tarefa", $obj->briefing_tarefa);
			$stmt->bindParam(":estagio_compra", $obj->estagio_compra);
			$stmt->bindParam(":id_projeto", $obj->id_projeto);
			$stmt->bindParam(":id_equipe", $obj->id_equipe);
			$stmt->bindParam(":tipo_cta", $obj->tipo_cta);
			$stmt->bindParam(":referencias", $obj->referencias);
			$stmt->bindParam(":consideracoes_gerais", $obj->consideracoes_gerais);
			$stmt->bindParam(":id_persona", $obj->id_persona);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			return false;
		}
	}

	public static function classificaConteudo($id, $nota)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("UPDATE tarefas SET "
				. " nota_tarefa = :nota_tarefa"
				. " WHERE id_tarefa = :id_tarefa ");

			$stmt->bindParam(":id_tarefa", $id);
			$stmt->bindParam(":nota_tarefa", $nota);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			return false;
		}
	}

	public static function atualizaLink($id, $link)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("UPDATE tarefas SET "
				. " link_publicado = :link_publicado"
				. " WHERE id_tarefa = :id_tarefa ");

			$stmt->bindParam(":id_tarefa", $id);
			$stmt->bindParam(":link_publicado", $link);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			return false;
		}
	}

	public static function atualizaTitulo($titulo, $id)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("UPDATE tarefas SET "
				. " nome_tarefa = :nome_tarefa"
				. " WHERE id_tarefa = :id_tarefa ");

			$stmt->bindParam(":id_tarefa", $id);
			$stmt->bindParam(":nome_tarefa", $titulo);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			return false;
		}
	}


 //------------------ function select($id)---------//

 public static function getAll()
 {

	 try {
		 $stmt = Conexao::getInstance()->prepare("select tp.nome_tarefa as nome_tipo, t.id_tarefa, t.data_criacao, t.nome_tarefa, t.nota_tarefa, t.id_projeto  from tarefas t inner join tipo_tarefa tp on (t.id_tipo = tp.id_tipo)");

		 $stmt->execute();
		 $colunas = array();
		 while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			 $row->data_criacao = date('d/m/Y', strtotime($row->data_criacao));
			 array_push($colunas, $row);
		 }
		 return $colunas;
	 } catch (PDOException $ex) {
		 //return false;
		 echo $ex->getMessage();
		 die();
	 }
 }

	public static function getById($id)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT lt.*, t.* , tp.nome_tarefa as nome_tipo"
				. " FROM tarefas t"
				. " INNER JOIN log_tarefas lt"
				. " ON(t.id_tarefa = lt.id_tarefa) "
				. " INNER JOIN tipo_tarefa tp on (t.id_tipo = tp.id_tipo)"
				. " WHERE t.id_tarefa = :id and lt.status = 1");

			$stmt->bindParam(":id", $id);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				return $row;
			}
			return false;
		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
	}

	public static function getDateCriacao($id)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT data_criacao"
				. " FROM tarefas "
				. " WHERE id_tarefa = :id");

			$stmt->bindParam(":id", $id);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				return $row->data_criacao;
			}
			return false;
		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
	}

	public static function getUltimasDez($id, $limit)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("select * from tarefas t inner join log_tarefas l on (t.id_tarefa = l.id_tarefa) where t.id_projeto = :id_projeto and l.status = 1 order by t.data_criacao ASC limit $limit");

			$stmt->bindParam(":id_projeto", $id);
			$stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$row->data_criacao = date('d/m/Y', strtotime($row->data_criacao));
				array_push($colunas, $row);
			}
			return $colunas;
		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
	}

	public static function getConteudosDez($id, $limit)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("select tp.nome_tarefa as nome_tipo, t.id_tarefa, t.data_criacao, t.nome_tarefa, t.nota_tarefa, t.id_projeto, l.etapa, l.status, l.data_criacao as criacao_log  from tarefas t inner join log_tarefas l on (t.id_tarefa = l.id_tarefa) inner join tipo_tarefa tp on (t.id_tipo = tp.id_tipo) where (t.id_projeto = :id_projeto and l.status = 1 and l.etapa > 6) order by convert(l.etapa, decimal) ASC limit $limit");

			$stmt->bindParam(":id_projeto", $id);
			$stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$row->data_criacao = date('d/m/Y', strtotime($row->data_criacao));
				array_push($colunas, $row);
			}
			return $colunas;
		} catch (PDOException $ex) {
			return false;
		}
	}

	public static function getPautasDez($id_projeto, $limit, $etapa)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("select tp.nome_tarefa as nome_tipo, t.id_tarefa, t.data_criacao, t.nome_tarefa, t.nota_tarefa, t.id_projeto, l.etapa, l.status, l.data_criacao as criacao_log  from tarefas t inner join log_tarefas l on (t.id_tarefa = l.id_tarefa) inner join tipo_tarefa tp on (t.id_tipo = tp.id_tipo) where t.id_projeto = :id_projeto and l.status = 1 $etapa order by convert(l.etapa, decimal) ASC limit $limit");

			$stmt->bindParam(":id_projeto", $id_projeto);
			$stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($colunas, $row);
			}
			return $colunas;
		} catch (PDOException $ex) {
			// return $ex->getMessage();
			return false;
		}
	}

	public static function getTarefasCalendario($id_projeto)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT log.etapa, tar.data_criacao, tar.nome_tarefa, tar.id_tarefa, tip.cor_tarefa"
				.	" FROM tarefas tar" 
				.	" INNER JOIN tipo_tarefa tip"
				.	" ON(tar.id_tipo = tip.id_tipo)"
				.	" INNER JOIN log_tarefas log"
				.	" ON(tar.id_tarefa = log.id_tarefa)"
				.	" WHERE id_projeto = :id_projeto AND log.status= 1");

			$stmt->bindParam(":id_projeto", $id_projeto);
			$stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($colunas, $row);
			}
			return $colunas;
		} catch (PDOException $ex) {
			return $ex->getMessage();
			// return false;
		}
	}

	public static function countTarefasProjeto($id)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT COUNT(id_tarefa) as cont FROM tarefas WHERE id_projeto =:id_projeto");

			$stmt->bindParam(":id_projeto", $id);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				return $row->cont;
			}
			return false;
		} catch (PDOException $ex) {
			return false;
		}
	}

	public static function countTarefasProjetoEtapa($id, $etapa)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT COUNT(t.id_tarefa) as cont FROM tarefas t inner join "
				. " log_tarefas l ON ( t.id_tarefa = l.id_tarefa) where t.id_projeto =:id_projeto and l.status = 1 and "
				. " ( l.etapa $etapa )");

			$stmt->bindParam(":id_projeto", $id);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				return $row->cont;
			}
			return false;
		} catch (PDOException $ex) {
			return false;
		}
	}

	public static function countTarefasProjetoAtrasadas($id)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT COUNT(t.id_tarefa) as cont FROM tarefas t inner join log_tarefas l ON ( t.id_tarefa = l.id_tarefa) WHERE  t.id_projeto = :id_projeto and l.status = 1 AND l.etapa != 15 AND l.data_prevista < now()");

			$stmt->bindParam(":id_projeto", $id);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				return $row->cont;
			}
			return false;
		} catch (PDOException $ex) {
			return false;
              	//echo $ex->getMessage();
		}
	}

	public static function tarefasProjetoAtrasadas($id)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("select tp.nome_tarefa as nome_tipo, t.id_tarefa, t.data_criacao, t.nome_tarefa, t.nota_tarefa, t.id_projeto, l.etapa, l.status, l.data_criacao as criacao_log FROM tarefas t inner join log_tarefas l ON ( t.id_tarefa = l.id_tarefa) inner join tipo_tarefa tp on (t.id_tipo = tp.id_tipo) WHERE  t.id_projeto = :id_projeto and l.status = 1 AND l.etapa != 15 AND l.data_prevista < now()");

			$stmt->bindParam(":id_projeto", $id);
			$stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($colunas, $row);
			}
			return $colunas;
		} catch (PDOException $ex) {
			return false;
              	//echo $ex->getMessage();
		}
	}

	public static function dataAprovacao($id)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT * FROM log_tarefas where id_tarefa = :id_tarefa AND (etapa = 9 OR etapa = 13) ORDER BY data_criacao LIMIT 1");

			$stmt->bindParam(":id_tarefa", $id);
			$stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				return $row->data_criacao;
			}
			return false;
		} catch (PDOException $ex) {
			return false;
              	//echo $ex->getMessage();
		}
	}


	public static function getRedatoresTarefa($id)
	{

		try {
			$stmt = Conexao::getInstance()->prepare("SELECT DISTINCT(lt.id_usuario), us.nome_usuario as nome_redator  FROM log_tarefas lt INNER JOIN usuarios us ON(lt.id_usuario = us.id_usuario) WHERE lt.id_tarefa = :id_tarefa  AND us.funcao_usuario = 2 ORDER BY lt.id_log  DESC");

			$stmt->bindParam(":id_tarefa", $id);
			$stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($colunas, $row);
			}
			return $colunas;
		} catch (PDOException $ex) {
			return false;
              	//echo $ex->getMessage();
		}
	}

	public static function getTarefasByRedatorConteudo($id, $inicio = null, $fim = null)
	{
		$inicio = (empty($inicio)) ? '' : 'and lt.data_criacao >=  "' . $inicio . ' 00:00:00"';
		$fim = (empty($fim)) ? '' : 'and lt.data_criacao   <= "' . $fim . ' 23:59:59"';
		try {
			$stmt = Conexao::getInstance()->prepare("SELECT max(CAST(lt.etapa AS UNSIGNED)) as etapa, ta.nome_tarefa, tt.nome_tarefa as nome_tipo_tarefa, tt.valor_conteudo_tipo_tarefa, pr.nome_projeto, lt.data_criacao, ta.id_tarefa FROM log_tarefas lt INNER JOIN tarefas ta ON(lt.id_tarefa = ta.id_tarefa) INNER JOIN tipo_tarefa tt ON(tt.id_tipo = ta.id_tipo) INNER JOIN projetos pr on(ta.id_projeto = pr.id_projeto) inner join usuarios u ON (lt.id_usuario = u.id_usuario) where lt.id_usuario IN(SELECT id_usuario FROM log_tarefas WHERE id_usuario = :id_usuario) {$inicio} {$fim} group by lt.id_tarefa order by lt.data_criacao");

			$stmt->bindParam(":id_usuario", $id);
			$stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($colunas, $row);
			}
			return $colunas;
		} catch (PDOException $ex) {
			return false;
				  echo $ex->getMessage();
				  die();
		}
	}
	public static function getTarefasByRedator($id, $inicio = null, $fim = null)
	{
		$inicio = (empty($inicio)) ? '' : 'and ta.data_criacao >=  "' . $inicio . ' 00:00:00"';
		$fim = (empty($fim)) ? '' : 'and ta.data_criacao   <= "' . $fim . ' 23:59:59"';
		try {
			$stmt = Conexao::getInstance()->prepare("SELECT DISTINCT(lt.id_usuario), ta.nome_tarefa, tt.nome_tarefa as nome_tipo_tarefa, tt.valor_pauta_tipo_tarefa, pr.nome_projeto, ta.data_criacao, ta.id_tarefa FROM log_tarefas lt"
			.	" INNER JOIN tarefas ta "
			.	" ON(lt.id_tarefa = ta.id_tarefa) "
			.	" INNER JOIN tipo_tarefa tt "
			.	" ON(tt.id_tipo = ta.id_tipo) "
			.	" INNER JOIN projetos pr "
			.	" on(ta.id_projeto = pr.id_projeto) "
			.	" WHERE lt.id_usuario = :id_usuario {$inicio} {$fim}"
			.	" ORDER BY pr.nome_projeto"
			.	" , ta.data_criacao");

			$stmt->bindParam(":id_usuario", $id);
			$stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($colunas, $row);
			}
			return $colunas;
		} catch (PDOException $ex) {
			return false;
				  //echo $ex->getMessage();
				  //die();
		}
	}

	public static function getTarefasAvaliacao($id_projeto, $inicio = null, $fim = null)
	{
		$inicio = (empty($inicio)) ? '' : 'and t.data_criacao BETWEEN  "' . $inicio . '"';
		$fim = (empty($fim)) ? '' : 'and "' . $fim . '"';
		try {
			$stmt = Conexao::getInstance()->prepare("select tp.nome_tarefa as nome_tipo, t.id_tarefa, t.data_criacao, t.nome_tarefa, t.nota_tarefa, t.id_projeto, l.etapa, l.status, l.data_criacao as criacao_log  from tarefas t inner join log_tarefas l on (t.id_tarefa = l.id_tarefa) inner join tipo_tarefa tp on (t.id_tipo = tp.id_tipo) where t.id_projeto = :id_projeto and l.status = 1 AND l.etapa = 15 {$inicio} {$fim} order by convert(l.etapa, decimal)");
			$stmt->bindParam(":id_projeto", $id_projeto);
			$stmt->execute();
			$colunas = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($colunas, $row);
			}
			return $colunas;
		} catch (PDOException $ex) {
			 return $ex->getMessage();
			//return false;
		}
	}


	public static function checkAccess($tar,$proj)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("SELECT id_tarefa"
				. " FROM tarefas"
				. " WHERE id_tarefa = :id_tarefa AND id_projeto = :id_projeto");

			$stmt->bindParam(":id_tarefa", $tar);
			$stmt->bindParam(":id_projeto", $proj);
			if ($stmt->execute()) {
				while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
					return true;
				}

				return false;
			}
		} catch (PDOException $ex) {
			//echo $ex->getMessage();
			return false;
		}
	}

	public static function tarefasDoLimbo()
	{
		try {
			$stmt = Conexao::getInstance()->prepare("SELECT log_tarefas.id_tarefa, tarefas.nome_tarefa from(SELECT id_tarefa, SUM(CAST(status AS UNSIGNED)) as maximo from log_tarefas GROUP by id_tarefa ORDER BY `log_tarefas`.`id_tarefa` ASC) as novo inner join log_tarefas on(novo.id_tarefa = log_tarefas.id_tarefa) inner join tarefas on(log_tarefas.id_tarefa = tarefas.id_tarefa) where maximo = 0 group by log_tarefas.id_tarefa");
			//$stmt = Conexao::getInstance()->prepare("SELECT *  FROM `log_tarefas` WHERE `id_tarefa` = 714 ORDER BY `log_tarefas`.`id_log`  DESC");

			if ($stmt->execute()) {
				while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
					return true;
				}

				return false;
			}
		} catch (PDOException $ex) {
			//echo $ex->getMessage();
			return false;
		}
	}



 //------------------ function delete($id)---------//



	public static function delete($id)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("DELETE FROM tarefas WHERE id_equipe = :id");

			$stmt->bindParam(":id", $id);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			return false;
		}
	}
	public static function deletaTarefa($id)
	{
		try {
			$stmt = Conexao::getInstance()->prepare("DELETE FROM tarefas WHERE id_tarefa = :id");

			$stmt->bindParam(":id", $id);

			$stmt->execute();
			return true;
		} catch (PDOException $ex) {
			return false;
		}
	}
}
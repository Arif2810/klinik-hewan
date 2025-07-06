<?php

class SSP_Custom {
		static function data_output($columns, $data) {
				$out = array();
				for ($i = 0, $ien = count($data); $i < $ien; $i++) {
						$row = array();
						for ($j = 0, $jen = count($columns); $j < $jen; $j++) {
								$column = $columns[$j];

								$colData = $data[$i][ $column['db'] ];

								if (isset($column['formatter'])) {
										$row[ $column['dt'] ] = $column['formatter']($colData, $data[$i]);
								} else {
										$row[ $column['dt'] ] = $colData;
								}
						}
						$out[] = $row;
				}
				return $out;
		}

		static function db_connect($sql_details) {
				try {
						$pdo = new PDO(
								"mysql:host={$sql_details['host']};dbname={$sql_details['db']}",
								$sql_details['user'],
								$sql_details['pass'],
								array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
						);
						return $pdo;
				} catch (PDOException $e) {
						die("Connection failed: " . $e->getMessage());
				}
		}

		static function limit($request) {
				$limit = "";
				if (isset($request['start']) && $request['length'] != -1) {
						$limit = "LIMIT ".intval($request['start']).", ".intval($request['length']);
				}
				return $limit;
		}

		static function order($request, $columns) {
				$order = "";
				if (isset($request['order']) && count($request['order'])) {
						$orderBy = array();
						$dtColumns = self::pluck($columns, 'dt');
						for ($i = 0, $ien = count($request['order']); $i < $ien; $i++) {
								$columnIdx = intval($request['order'][$i]['column']);
								$requestColumn = $request['columns'][$columnIdx];
								if ($requestColumn['orderable'] == 'true') {
										$columnName = $columns[$columnIdx]['db'];
										$dir = $request['order'][$i]['dir'] === 'asc' ? 'ASC' : 'DESC';
										$orderBy[] = "$columnName $dir";
								}
						}
						if (count($orderBy)) {
								$order = 'ORDER BY ' . implode(', ', $orderBy);
						}
				}
				return $order;
		}

		static function filter($request, $columns, &$bindings) {
				$globalSearch = array();
				$dtColumns = self::pluck($columns, 'dt');

				if (isset($request['search']) && $request['search']['value'] != '') {
						$str = $request['search']['value'];

						for ($i = 0, $ien = count($columns); $i < $ien; $i++) {
								$column = $columns[$i];
								$binding = ':search_' . $i;
								$bindings[$binding] = "%$str%";
								$globalSearch[] = "{$column['db']} LIKE $binding";
						}
				}

				if (count($globalSearch)) {
						return 'WHERE ' . implode(' OR ', $globalSearch);
				}

				return '';
		}

		static function pluck($a, $prop) {
				$out = array();
				for ($i = 0, $len = count($a); $i < $len; $i++) {
						$out[] = $a[$i][$prop];
				}
				return $out;
		}

		static function simple($request, $sql_details, $table, $primaryKey, $columns) {
				$bindings = array();
				$db = self::db_connect($sql_details);

				$limit = self::limit($request);
				$order = self::order($request, $columns);
				$where = self::filter($request, $columns, $bindings);

				$colStr = implode(", ", self::pluck($columns, 'db'));

				$stmt = $db->prepare("SELECT $colStr FROM $table $where $order $limit");

				foreach ($bindings as $key => $val) {
						$stmt->bindValue($key, $val, PDO::PARAM_STR);
				}

				$stmt->execute();
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

				// Total records
				$resTotal = $db->query("SELECT COUNT($primaryKey) FROM $table")->fetchColumn();
				// Total filtered
				$resFilter = $db->prepare("SELECT COUNT($primaryKey) FROM $table $where");
				foreach ($bindings as $key => $val) {
						$resFilter->bindValue($key, $val, PDO::PARAM_STR);
				}
				$resFilter->execute();
				$recordsFiltered = $resFilter->fetchColumn();

				return array(
						"draw" => isset($request['draw']) ? intval($request['draw']) : 0,
						"recordsTotal" => intval($resTotal),
						"recordsFiltered" => intval($recordsFiltered),
						"data" => self::data_output($columns, $data)
				);
		}
}

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Modera test work Sander Vergeles</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="Modera test work Sander Vergeles" />
	<meta name="keywords" content="modera" />
</head>
<body>
<?php

require_once '/kint/Kint.class.php';

	function сategory($file) {

		if (!file_exists($file)) {
			die('error');
		}

		$txt = file_get_contents($file);
		$info = array();
		$rows = explode("\n", $txt);

		echo array_shift($rows) . '<hr />' . "\n";
		foreach($rows as $row => $data)
		{

			$row_data = explode('|', $data);

			$info[$row_data[1]][$row_data[0]] = array(
				'node_id' => $row_data[0],
				'parent_id' => $row_data[1],
				'node_name' => $row_data[2]
			);

        }

Kint::dump( $info );
		return $info;
	}
	
	$cat_arr = сategory('text_file.txt');

	function tree($parent_id, $level) {
		global $cat_arr;
		if (isset($cat_arr[$parent_id])) 
			foreach ($cat_arr[$parent_id] as $val) {

				for($i = 0; $i < $level; $i++) { $line .= '-'; }
				if($level != 0) {
					$tree .= "\n";
				}
				$tree .= '<li>' . $line . '<span>' . $val['node_name'] . '</span>';
					$level = $level + 1;
						$tree .= tree($val['node_id'], $level);
					$level = $level - 1;
				$tree .= '</li>';
				if($level != 0) {
					$tree .= "\n";
				}
				unset($line);
			}

			return $tree ? '<ul>' . $tree . '</ul>' : '';
    }

$tree = tree(0,0);
echo $tree;
?>

</body>
</html>
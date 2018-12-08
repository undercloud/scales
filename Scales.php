<?php
	require __DIR__ . '/Chords.php';
	require __DIR__ . '/Chromatic.php';
	require __DIR__ . '/Relation.php';
	require __DIR__ . '/Modes.php';
	require __DIR__ . '/Progression.php';
	require __DIR__ . '/GuitarNeck.php';
	require __DIR__ . '/Library.php';

	return function ($action,$args) {
		switch($action){
			case 'mode':
				return Undercloud\Scales\Relation::summarize($args[0],$args[1]);

			case 'search':
			case 'search-by':
				if ($action === 'search') {
					$result = Undercloud\Scales\Relation::search($args[0]);
				} else if ($action === 'search-by') {
					$result = Undercloud\Scales\Relation::searchBy($args[0]);
				}

				if (!$result) {
					return false;
				}

				list($mode,$root) = $result;
				
				return Undercloud\Scales\Relation::summarize($mode,$root);
		}
	};
?>
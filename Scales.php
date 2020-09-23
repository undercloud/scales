<?php
	require __DIR__ . '/Chords.php';
	require __DIR__ . '/Chromatic.php';
	require __DIR__ . '/Relation.php';
	require __DIR__ . '/Modes.php';
	require __DIR__ . '/Progression.php';
	require __DIR__ . '/GuitarNeck.php';
	require __DIR__ . '/Parallel.php';
	require __DIR__ . '/Sequence.php';
	require __DIR__ . '/Order.php';

	return function ($action,$args) {
		($args[0]);

		$special = [
			'PENTATONIC-MAJOR',
			'PENTATONIC-MINOR',
			'BLUES-MAJOR',
			'BLUES-MINOR'
		];
		if (in_array($args[0],$special)) {
			Undercloud\Scales\Chords::acceptNonModal();
			Undercloud\Scales\Progression::acceptNonModal();
		}

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

			case 'chord':
				$scale = Undercloud\Scales\Chords::build($args[0],$args[1]);

				return [
					'type'        => $args[0] . $args[1],
					'scale'       => $scale,
					'guitar-neck' => Undercloud\Scales\GuitarNeck::build($scale)
				];
		}
	};
?>
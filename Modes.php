<?php
namespace Undercloud\Scales;

use Exception;

class Modes
{
	private static $natural = [
		'IONIAN'            => ['C','D','E','F','G','A','B'],
		'DORIAN'            => ['D','E','F','G','A','B','C'],
		'PHRYGIAN'          => ['E','F','G','A','B','C','D'],
		'LYDIAN'            => ['F','G','A','B','C','D','E'],
		'MIXOLYDIAN'        => ['G','A','B','C','D','E','F'],
		'AEOLIAN'           => ['A','B','C','D','E','F','G'],
		'LOCRIAN'           => ['B','C','D','E','F','G','A'],
		'PENTATONIC-MAJOR'  => ['C','D','E','G','A'],
		'PENTATONIC-MINOR'  => ['C','D#','F','G','A#'],
		'MELODIC-MINOR'     => ['C','D','D#','F','G','A','B'],
		'HARMONIC-MINOR'    => ['C','D','D#','F','G','G#','B'],
		'BLUES-MAJOR'       => ['C','D','D#','E','G','A'],
		'BLUES-MINOR'       => ['C','D#','F','F#','G','A#'],
		'ARABIAN'           => ['A','B','C','D','D#','F','F#','G#'],
		'PERSIAN'           => ['A','A#','C#','D','D#','F','G#'],
		'BYZANTINE'         => ['A','A#','C#','D','E','F','G#'],
		'EAST'              => ['A','A#','C#','D','D#','F#','G'],
		'GIPSY'             => ['A','B','C','D#','E','F','G#'],
		'ROMANIAN'          => ['A','B','C','D#','E','F#','G'],
		'PHRYGIAN-DOMINANT' => ['E','F','G#','A','B','C','D'],
		'BE-BOOP'           => ['C','D','E','F','G','A','A#','B']
	];

	public static function keys()
	{
		return array_keys(self::$natural);
	}

	public static function get($name, $root)
	{
		if (array_key_exists($name, self::$natural)) {
			$interval = Relation::toInterval(self::$natural[$name]);

			return Chromatic::build($root, $interval);
		}

		throw new Exception('Unknown Mode: ' . $name);
	}
}
?>
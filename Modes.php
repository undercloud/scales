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
		'MIXOLYDIAN-FLAT-6' => ['C','D','E','F','G','G#','A#'],
		'BE-BOOP'           => ['C','D','E','F','G','A','A#','B']
	];

	public static function formula($mode)
	{
		$root = ['1','2b','2','3b','3','4','5b','5','6b','6','7b','7'];
		$with = Relation::toInterval(self::$natural[$mode]);
		$list = [];
		foreach($with as $w){
			$list[] = $root[$w];
		}

		return $list;
	}

	public static function steps()
	{
		$steps = [
			'Tonic'       => null,
			'Supertonic'  => ['I','III'],
			'Madiant'     => null,
			'Subdominant' => ['III','V'],
			'Dominant'    => null,
			'Submediant'  => ['V'],
			'Subtonic'    => ['I']
		]; 
	}

	public static function harmony()
	{
		$harmony = [
			 0 => ['Unison',           'perfect'],
			 1 => ['Minor Second',     'dissonant'],
			 2 => ['Major Second',     'dissonant'],
			 3 => ['Minor Third',      'imperfect'],
		 	 4 => ['Major Third',      'imperfect'],
			 5 => ['Perfect Fourth',   'perfect'],
			 6 => ['Diminished Fifth', 'dissonant'],
			 7 => ['Perfect Fifth',    'perfect'],
			 8 => ['Minor Sixth',      'imperfect'],
			 9 => ['Major Sixth',      'imperfect'],
			10 => ['Minor Seventh',    'dissonant'],
			11 => ['Major Seventh',    'dissonant'],
			12 => ['Octave',           'perfect']
		];
	}

	public static function export()
	{
		return self::$natural;
	}

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
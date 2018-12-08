<?php
namespace Undercloud\Scales;

class Chords
{
	private static $types = [
		'5'     => ['C','G'],
		
		'sus2'  => ['C','D','G'],
		'm'     => ['C','D#','G'],
		'dim'   => ['C','D#','F#'],
		''      => ['C','E','G'],
		'aug'   => ['C','E','G#'],
		'sus4'  => ['C','F','G'],

		'7sus2' => ['C','D','G','A#'],
		'dim7'  => ['C','D#','F#','A'],
		'm7b5'  => ['C','D#','F#','A#'],
		'm6'    => ['C','D#','G','A'],
		'm7'    => ['C','D#','G','A#'],
		'6'     => ['C','E','G','A'],
		'7'     => ['C','E','G','A#'],
		'maj7'  => ['C','E','G','B'],
		'7sus4' => ['C','F','G','A#'],
		
		// nine
		'maj9'  => ['C','D','E','B'],
		'9'     => ['C','D','E','A#'],
		'm9'    => ['C','D','D#','A#']
	];

	public static function names()
	{
		return array_keys(self::$types);
	}

	public static function build($root,$type)
	{
		return Chromatic::build($root, Relation::toInterval(
			self::$types[$type]
		));
	}

	public static function extract($chord)
	{
		if (isset($chord[1]) and in_array($chord[1],['b','#'])) {
			$name = substr($chord, 0, 2);
			$type = (string) substr($chord,2);
		} else {
			$name = $chord[0];
			$type = (string) substr($chord,1);
		}

		return [$name,$type];
	}
}
?>
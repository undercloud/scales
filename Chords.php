<?php
namespace Undercloud\Scales;

class Chords
{
	private static $types = [
		'5'     => ['C','G'],
		''      => ['C','E','G'],
		'm'     => ['C','D#','G'],
		'sus2'  => ['C','D','G'],
		'dim'   => ['C','D#','F#'],
		'aug'   => ['C','E','G#'],
		'sus4'  => ['C','F','G'],

		'qartal'    => ['C','F','A#','D#'],
		'7sus2'     => ['C','D','G','A#'],
		'dim7'      => ['C','D#','F#','A'],
		'm7b5'      => ['C','D#','F#','A#'],
		'm6'        => ['C','D#','G','A'],
		'm7'        => ['C','D#','G','A#'],
		'm7(no5)'   => ['C','D#','A#'],
		'6'         => ['C','E','G','A'],
		'7'         => ['C','E','G','A#'],
		'7(no5)'    => ['C','E','A#'],
		'maj7'      => ['C','E','G','B'],
		'maj7(no5)' => ['C','E','B'],
		'7sus4'     => ['C','F','G','A#'],
		
		// nine
		'maj9'      => ['C','E','G','B','D'],
		'maj9(no5)' => ['C','E','B','D'],
		'9'         => ['C','E','G','A#','D'],
		'9(no5)'    => ['C','E','A#','D'],
		'm9'        => ['C','D#','G','A#','D'],
		'm9(no5)'   => ['C','D#','A#','D']
	];

	private static $nonModal = [
		'(no5)'     => ['C','E'],
		'm(no5)'    => ['C','D#'],
		'(qart)'    => ['C','F'],
		'm7(no5)'   => ['C','D#','A#'],
		'7(no5)'    => ['C','E','A#'],
		'maj7(no5)' => ['C','E','B']
	];

	public static function acceptNonModal()
	{
		self::$types = (
			self::$types + 
			self::$nonModal
		);
	}

	public static function nonModalKeys()
	{
		return array_keys(self::$nonModal);
	}

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
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

		// 7
		'qartal'       => ['C','F','A#','D#'],
		'7sus2'        => ['C','D','G','A#'],
		'dim7'         => ['C','D#','F#','A'],
		'm7b5'         => ['C','D#','F#','A#'],
		'm6'           => ['C','D#','G','A'],
		'm7'           => ['C','D#','G','A#'],
		'm7(no5)'      => ['C','D#','A#'],
		'm7(open-1)'   => ['C','G','A#','D#'],
		'm7(open-2)'   => ['C','G','D#','A#'],
		'm7(open-3)'   => ['C','A#','D#','G'],
		'6'            => ['C','E','G','A'],
		'7'            => ['C','E','G','A#'],
		'7(alt)'       => ['C','A#','D#','E','G#'],
		'7(b5)'        => ['C','E','F#','A#'],
		'7(#5)'        => ['C','E','G#','A#'],
		'7(#5,#9)'     => ['C','E','G#','A#','D#'],
		'7(no5)'       => ['C','E','A#'],
		'7(open-1)'    => ['C','G','A#','E'],
		'7(open-2)'    => ['C','G','E','A#'],
		'7(open-3)'    => ['C','A#','E','G'],
		'6/7/9(A)'     => ['C','E','A','A#','D'],
		'6/7/9(B)'     => ['C','A#','D','E','A'],
		'maj7'         => ['C','E','G','B'],
		'maj7#4'       => ['C','E','F#','G','B'],
		'maj7(b5)'     => ['C','E','F#','B'],
		'maj7(no5)'    => ['C','E','B'],
		'maj7(open-1)' => ['C','G','B','E'],
		'maj7(open-2)' => ['C','G','E','B'],
		'maj7(open-3)' => ['C','B','E','G'],
		'7sus4'        => ['C','F','G','A#'],
		'phrygian'     => ['C','C#','F','G'],
		'atmos'        => ['C','G','D','D#','A#'],
		
		// 9
		'maj9'      => ['C','E','G','B','D'],
		'maj9(b5)'  => ['C','E','F#','B','D'],	
		'maj9(no5)' => ['C','E','B','D'],
		'maj9(B)'   => ['C','B','D','E','G'],
		'9'         => ['C','E','G','A#','D'],
		'9(b9)'     => ['C','E','G','A#','C#'],
		'9(#9)'     => ['C','E','G','A#','D#'],
		'9(no5)'    => ['C','E','A#','D'],
		'9(B)'      => ['C','A#','D','E','G'],
		'm9'        => ['C','D#','G','A#','D'],
		'm9(no5)'   => ['C','D#','A#','D'],
		'm9(B)'     => ['C','A#','D','D#','G'],
		'dim9'      => ['C','D#','F#','A','D'],
		'dim9(b9)'  => ['C','D#','F#','A','C#'],
		'm9b5'      => ['C','D#','F#','A#','D'],
		'6/9'       => ['C','E','G','A','D'],
		'm6/9'      => ['C','D#','G','A','D'],
		'9sus4'     => ['C','F','G','A#','D'],

		// 11
		'maj#11'     => ['C','E','G','B','D','F#'],
		'maj#11(KB)' => ['C','G','D','E','B','F#'],
		'm11'        => ['C','D#','G','A#','D','F'],
		'm11(KB)'    => ['C','G','D','D#','A#','F'],
		'm11(no5)'   => ['C','D#','A#','D','F'],
		'11'         => ['C','E','G','A#','D','F'],
		'11(b9)'     => ['C','E','G','A#','C#','F'],
		'11(#9)'     => ['C','E','G','A#','D#','F'],
		'11(no5)'    => ['C','E','A#','D','F'],
		'11(b9,#11)' => ['C','E','G','A#','C#','F#'],
		'11(#9,#11)' => ['C','E','G','A#','D#','F#'],
		'11(no5,#11)'=> ['C','E','A#','D','F#'],
		'dim11'      => ['C','D#','F#','A','D','F'],
		'dim11(b9)'  => ['C','D#','F#','A','C#','F'],
		'm11b5'      => ['C','D#','F#','A#','D','F']
	];

	private static $nonModal = [
		'(no5)'     => ['C','E'],
		'm(no5)'    => ['C','D#'],
		'(qart)'    => ['C','F']
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

	public static function search(array $scale)
	{
		$root = reset($scale);
		foreach(self::names() as $type){
			if($scale == self::build($root,$type)){
				return [$root,$type];
			}
		}
	}
}
?>
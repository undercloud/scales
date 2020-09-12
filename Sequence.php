<?php
namespace Undercloud\Scales;

class Sequence
{
	private static $reflect = [
		'1'  => 0,
		'1#' => 1,
		'2b' => 1,
		'2'  => 2,
		'2#' => 3,
		'3b' => 3,
		'3'  => 4,
		'4'  => 5,
		'4#' => 6,
		'5b' => 6,
		'5'  => 7,
		'5#' => 8,
		'6b' => 8,
		'6'  => 9,
		'6#' => 10,
		'7b' => 10,
		'7'  => 11,
	];

	public static function parse($token)
	{
		@list($key,$type) = explode('.',$token);

		return [self::$reflect[$key],$type];
	}

	public static function build($key,array $progression)
	{
		$chromatic = Chromatic::toRoot($key);

		$name = $keys = array();

		$sequence = array_map(function ($item) use ($chromatic,&$name,&$keys) {
			list($index,$type) = Sequence::parse($item);
			
			$key    = $chromatic[$index];
			$name[] = $key . $type;
			$chord  = Chords::build($key,$type);
			$keys   = array_unique(array_merge($keys,$chord)); 

			return $chord;
		},$progression);

		return [
			'name'     => implode(' - ',$name),
			'keys'     => $keys,
			'sequence' => $sequence
		];
	}

	public static function extract($name, $root)
	{
		$keys = Modes::get($name,$root);
	
		$sequence = [];
		foreach(self::$progressions as $progression){
			$build = self::build($root,$progression);

			if(count(array_intersect($build['keys'],$keys)) === count($build['keys'])){
				$sequence[] = $build;
			}
		}

		return $sequence;
	}

	private static $progressions = array(
		array('1.m','5.m','4.m','7b'),

		// harmonic minor
		array('1.m','2.m7b5','6b','7.dim'),
		array('1.m','2.m7b5','6b','5'),
		array('1.m','5','6b','4.m'),
		array('1.m','4.m','5','6b'),
		array('1.m','6b','2.dim','5'),
		array('2.dim','1.m'),
		array('1.m','2.dim'),
		array('2.dim','6b'),

		// phrygian
		array('1.m','4.m','6b','1b'),

		// maj
		/*
		array('1','5.7'),
		array('1','4'),
		array('1','4','5.7','1'),
		array('1','6.m','2.m','5.7'),
		array('1','1.dim','5.7','1'),
		array('1','5.dim','5.7','1'),
		array('1','1#.dim','2.m','5.7'),
		array('1','6.m','2.7','5.7'),
		array('1','1.dim','2.m7','5.7'),
		array('1','7'),
		array('1','5.aug'),
		array('1','1.dim','1','2.7','2.m7','5.7'),
		array('1','6.7','2.7','5.7'),
		array('1','2.7','5.7','1'),
		array('1','4','1','5.7'),
		array('1','1.7','4','4.m'),
		array('1','4.m','5.7','1'),
		array('1','4.7'),
		array('1','7b.7'),
		array('1','5.m','6.7','2.7','5.7'),
		array('1','7.7','2.m','5.7'),
		array('1','6.7','2.m','7.7','3.m','1.aug','4'),
		array('1','1.aug','6.m','1#.dim','5.7'),
		array('1','3.7','6.7','2.m'),
		array('1','3b.7','2.m7','5.7'),
		array('1','7.7','3.7','6.7','2.m','5.7'),
		array('1','3.m','6.m','1.7','4.m'),
		array('1','1.aug','6.m','1.7','4.m'),
		array('1','6.m','6b.7','5.7'),
		array('1','2.m','3.m','2.m'),
		array('1','1.7','4.7','1','6b','5.7'),
		array('1','2.m','3.7','6.7','1.m','2.7'),
		array('1','1.7','7.7','7b.7','6.7','2.7'),
		array('1','3b.m','2.m','2b.7'),
		array('1','3b.7','2.7','2b.7'),
		array('1','6b.7','5.7','1'),
		array('1','3.m','6.7','1#.dim','2.m7'),
		array('1','6b.7','2.m','5.7'),
		array('1','6b.7','1','1.dim','2.m7','5.7'),
		// min
		array('1.m','5.7'),
		array('1.m','4'),
		array('1.m','4.m','5.7','1.m'),
		array('1','6b','4.m','5.7'),
		array('1.m','1.dim','5.7','1.m'),
		array('1.m','5.dim','5.7','1.m'),
		array('1.m','1#.dim','4.m','5.7'),
		array('1.m','6b','2.7','5.7'),
		array('1.m','1.dim','4.m','5.7'),
		array('1.m','5.aug'),
		array('1.m','1.dim','1.m','2.7','4.m','5.7'),
		array('1.m','2.7','5.7','1.m'),
		array('1.m','4.m','5.7','1.m'),
		array('1.m','1.7','4.m','1.m'),
		array('1.m','4.7'),
		array('1.m','7b.7'),
		array('1.m','5.m','6b.7','5.7'),
		array('1.m','7b.7','4.m','5.7'),
		array('1.m','6b.7','4.m','7b.7','3b','1.aug','4.m'),
		array('1.m','1.7','4.7','1.m'),
		array('1.m','4.m','3b.7','6b.7'),
		array('1.m','1.7','7.7','7b.7'),
		array('1.m','3b.m','2.m','2b.7'),
		array('1.m','3b.7','2.7','2b.7'),
		array('1.m','6b.7','1.m','1.dim','4.m','5.7'),
		array('1.m','5.m','6b.7','4.m'),
		array('1.m','4.m','2.7','5.7')
		*/
	);
}
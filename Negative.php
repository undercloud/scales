<?php
namespace Undercloud\Scales;

class Negative
{
	private static $reverse = [
		'C'  => 'G',
		'C#' => 'F#',
		'D'  => 'F',
		'D#' => 'E',
		'E'  => 'D#',
		'F'  => 'D',
		'F#' => 'C#',
		'G'  => 'C',
		'G#' => 'B',
		'A'  => 'A#',
		'A#' => 'A',
		'B'  => 'G#'
	];

	public static function tune($root)
	{
		$keys   = array_keys(self::$reverse);
		$values = array_values(self::$reverse);
		$offset = array_search($root, $keys);

		if($offset){
			for($i = 0; $i < $offset; $i++){
				array_push($keys, array_shift($keys));
				array_unshift($values, array_pop($values));
			}
		}

		return array_combine($keys, $values);
	}

	public static function build($root,array $scale)
	{
		$reverse = self::tune($root);
		$scale = array_map(function($key)use($reverse){
			return $reverse[$key];
		},$scale);

		$scale = array_reverse($scale);

		return $scale;
	}
}
<?php
namespace Undercloud\Scales;

class Chromatic
{
	private static $keys = [
		'C','C#',
		'D','D#',
		'E',
		'F','F#',
		'G','G#',
		'A','A#',
		'B'
	];

	private static function transpose($steps)
	{
		$array = self::$keys;
		for($i = 0;$i < $steps;$i++){
			$array[] = array_shift($array);
		}

		return $array;
	}

	public static function sharpToFlat($key)
	{
		$set = ([
			'C#' => 'Db',
			'D#' => 'Eb',
			'F#' => 'Gb',
			'G#' => 'Ab',
			'A#' => 'Bb'
		]);

		return $set[$key];
	}

	public static function flatToSharp($key)
	{
		$set = ([
			'Db' => 'C#',
			'Eb' => 'D#',
			'Gb' => 'F#',
			'Ab' => 'G#',
			'Bb' => 'A#'
		]);

		return $set[$key];
	}

	public static function toRoot($root)
	{
		$steps = array_search($root, self::$keys);

		return self::transpose($steps);
	}

	public static function build($root, array $mode)
	{
		$primary = self::toRoot($root);
		return array_map(function($i)use($primary){
			return $primary[$i];
		},$mode);
	}
}
?>
<?php
namespace Undercloud\Scales;

class Resolve
{
	private static $tones = [
		0 => false,
		1 => array(0,2),
		2 => false,
		3 => array(2,4),
		4 => false,
		5 => array(4),
		6 => array(0)
	];

	public static function search(array $scale,array $keys)
	{
		$stack = [];
		foreach($keys as $key){
			$index = array_search($key, $scale);

			if($move = self::$tones[$index]){
				$stack = array_merge($stack,$move);
			}
		}

		$stack = array_unique($stack);
		$stack = array_map(function($index)use($scale){
			return $scale[$index];
		},$stack);

		$names = Chords::names();

		$resolve = [];
		foreach($scale as $key){
			foreach($names as $name){
				$build = Chords::build($key,$name);

				if(false === (count(array_intersect($scale,$build)) === count($build))){
					continue;
				}

				if(count($stack) <= ($count = count(array_intersect($build, $stack)))){
					$resolve[] = $key . $name;
				}
			}
		}

		return $resolve;
	}
}
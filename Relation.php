<?php
namespace Undercloud\Scales;

class Relation
{
	public static function belongsTo($range,$mode)
	{
		return (
			count($mode) == count(array_intersect($mode,$range))
		);
	}

	public static function isApartOf($part,$mode)
	{
		return (
			count($part) == count(array_intersect($mode,$part))
		);
	}

	public static function getInterval($scale,$key)
	{
		return array_search($key, $scale);
	}

	public static function toInterval(array $mode)
	{
		$scale = Chromatic::toRoot($mode[0]);
		$interval = [];
		foreach($mode as $m){
			$interval[] = array_search($m, $scale); 
		}

		return $interval;
	}

	public static function search(array $keys)
	{
		$root = reset($keys);

		$chromatic = Chromatic::toRoot($root);
		usort($keys,function($a,$b)use($chromatic){
			$ai = array_search($a, $chromatic);
			$bi = array_search($b, $chromatic);

			return ($ai > $bi) ? 1 : -1;
		});

		$keys = array_unique($keys);

		foreach(Modes::keys() as $k){
			$mode = Modes::get($k,$root);

			if(self::belongsTo($keys,$mode)) {
				return [$k, $root];
			}
		}

		return false;
	}

	public static function searchBy(array $chords)
	{
		$keys = [];
		$numerals = [];
		foreach ($chords as $c) {
			list($name,$type) = Chords::extract($c);

			$keys = array_merge(
				$keys,
				Chords::build(
					$name,
					$type
				)
			);
		}

		$keys = array_unique($keys);
		
		return self::search($keys);
	}

	public static function summarize($mode, $root, $tune = 'EADGBE')
	{
		$chords = Progression::build($mode,$root,'chord');
		$scale  = Modes::get($mode,$root); 

		return [
			'type'        => $mode . ' in ' . $root,
			'scale'       => $scale,
			'chords'      => $chords,
			'guitar-neck' => GuitarNeck::build($scale,$tune),
			'library'     => Library::build($mode,$chords[1],$chords[0])
		];
	}
}
?>
<?php
namespace Undercloud\Scales;

class Order
{
	private static $order = [
		0,7,5,
		9,4,3,
		8,2,11,
		1,10,6
	];

	public static function build($root,$scale)
	{
		$chromatic = Chromatic::toRoot($root);
		$chromatic = array_replace(array_flip(self::$order),$chromatic);

		return array_intersect($chromatic,$scale);
	}

	public static function getRole($index)
	{
		if(0 === $index) return 'root';
		if(in_array($index,[7,5,9,4,3,8])) return 'first';
		if(in_array($index,[2,11,1,10])) return 'second';

		return 'third';
	}
}
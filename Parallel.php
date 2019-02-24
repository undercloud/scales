<?php
namespace Undercloud\Scales;

class Parallel
{
	public static function build($name = 'IONIAN',$key = 'C')
	{
		$modes = Modes::export();
		$main = Modes::get($name,$key);
		unset($modes[$name]);

		$modes = array_filter($modes,function($item)use($main){
			return count($item) === count($main);
		});

		$push = [$name . ' ' . $key];
		foreach($modes as $m => $set){
			foreach($main as $s){
				$with = Modes::get($m,$s);
				if(Relation::belongsTo($with,$main)){
					$push[] = $m . ' ' . $s;
				}
			}
		}

		return $push;
	}
}
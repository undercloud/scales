<?php
namespace Undercloud\Scales;

class GuitarNeck
{
	public static function build(array $scale,$tune = 'EADGBE')
	{
		$strings = array_reverse(str_split($tune));

		$echo = '';
		$frets = 25;
		foreach($strings as $start){
			$echo .= '|';

			$chromatic = array_merge(
				Chromatic::toRoot($start),
				Chromatic::toRoot($start),
				array($start)
			);

			for ($i = 0; $i < $frets; $i++) {
				$echo .= '|';
				if(in_array($chromatic[$i],$scale)){
					if($scale[0] === $chromatic[$i]){
						$echo .= 'R';
					}else{
						$echo .= 'x';
					}
				}else{
					$echo .= $i === 0 ? ' ' : '-'; 
				}

				if ($i === 0) {
					$echo .= '|';
				}
			}
			$echo .= '|' . PHP_EOL;
		}

		$echo .= '  0      3   5   7   9     12    15  17  19  21    24';

		return $echo;
	}
}
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
			$echo .= '<div class="neck__string">';

			$chromatic = array_merge(
				Chromatic::toRoot($start),
				Chromatic::toRoot($start),
				array($start)
			);

			for ($i = 0; $i < $frets; $i++) {
				if ($i === 0) {
					$echo .= '<span class="neck__bar"></span>';
				}

				if(in_array($chromatic[$i],$scale)){
					if($scale[0] === $chromatic[$i]){
						$echo .= (
							'<span 
								class="neck__root" 
								with-key="' . $chromatic[$i] . '"></span>'
						);
					}else{
						$echo .= (
							'<span 
								class="neck__scale"
								with-key="' . $chromatic[$i] . '"></span>'
						);
					}
				}else{
					$echo .= '<span class="neck__empty"></span>'; 
				}

				if ($i === 0) {
					$echo .= '<span class="neck__bar"></span>';
				}
			}
			$echo .= '</div>';
		}

		$echo .= '<div class="neck__marker__wrap">';
		for ($i = 0; $i < $frets; $i++) {
			$echo .= '<span class="neck__marker">';
			if(in_array($i + 1,[3,5,7,9,12,15,17,19,21,24])){
				$echo .= $i + 1;
			}
			$echo .= '</span>';
		}

		$echo .= '</div>';

		return $echo;
	}
}
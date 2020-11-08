<?php
namespace Undercloud\Scales;

class Progression
{
	private static $extra = []; 

	private static function getFormula($type)
	{
		if('all' === $type){
			return Chords::names();
		}

		$types = [];

		$types['chord']  = array_merge(
			['','m','dim','aug','5'],
			self::$extra
		);

		$types['chord7'] = array_merge(
			$types['chord'],['maj7','m7','7','m7b5','dim7'],
			self::$extra
		);

		$types['chord9'] = array_merge(
			$types['chord7'],['maj9','m9','9'],
			self::$extra
		);

		return $types[$type];
	}

	private static $roman = [
		'I','bII','II','bIII','III',
		'IV','bV','V',
		'bVI','VI','bVII','VII'
	];

	private static $alt = [
		'm'    => '',
		'aug'  => '+',
		'dim'  => '&#xb0;',
		'dim7' => '&#xb0;7',
		'm7b5' => '&#xf8;'
	];

	public static function acceptNonModal()
	{
		self::$extra = Chords::nonModalKeys();
	}

	public static function view($interval,$chord)
	{
		$roman = self::$roman[$interval];
		if (false === in_array($chord,['','5','maj7','7','maj9','9'])){
			$roman = strtolower($roman);
		}

		if (isset(self::$alt[$chord])) {
			$chord = self::$alt[$chord];
		}

		return $roman . $chord;
	}

	public static function build($mode, $root, $formula)
	{
		$scale = Modes::get($mode, $root);

		$chords = [];
		foreach ($scale as $s) {
			foreach (self::getFormula($formula) as $c) {
				$chord = Chords::build($s,$c);

				if (Relation::isApartOf($chord,$scale)){
					$interval = array_search(
						$s,
						Chromatic::toRoot($root)
					);
					$chords[$s][] = (
						'<b class="prog__title" data-chord-name="' . $s . $c . '">' . $s . $c . '</b>' . 
						' (' . self::view($interval,$c) . ') ' . 
						PHP_EOL .
						"<span class='prog__play' onclick=\"ChordsPlayer.play(['" . implode("','",$chord) . "']);Resolver.resolve('{$mode}','{$root}',['" . implode("','",$chord) . "'],'" . $s . $c . "')\">" . 
							implode($chord) .
						"</span>"
					);
				}
			}
		}

		return $chords;
	}
}
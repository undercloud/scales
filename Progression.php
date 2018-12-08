<?php
namespace Undercloud\Scales;

class Progression
{
	private static $formula = [
		'chord'  => ['','m','dim','aug'],
		'chord7' => ['maj7','m7','7','m7b5','dim7','','m','dim','aug'],
		'chord9' => ['maj9','m9','9','m7b5','dim7','maj7','m7','7']
	];

	private static $roman = [
		'I','II','III','IV',
		'V','VI','VII','VIII'
	];

	private static $alt = [
		'm'    => '',
		'aug'  => '+',
		'dim'  => 'o',
		'dim7' => 'o7',
		'm7b5' => 'ø'
	];

	public static function view($interval,$chord)
	{
		$roman = self::$roman[$interval];
		if (false === in_array($chord,['','maj7','7','maj9'])){
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
		$numerals = [];
		foreach ($scale as $s) {
			foreach (self::$formula[$formula] as $c) {
				$chord = Chords::build($s,$c);

				if (Relation::isApartOf($chord,$scale)){
					$chords[]   = $s . $c;

					$interval   = Relation::getInterval($scale,$s);
					$numerals[] = self::view($interval,$c);

					break;
				}
			}
		}

		return [$chords, $numerals];
	}
}
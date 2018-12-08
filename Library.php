<?php
namespace Undercloud\Scales;

class Library
{
	public static $map = [
		'IONIAN' => [
			['I','IV','vi','V'],
			['I','ii','IV','V'],
			['I','V','vi','IV'],
			['I','iii','vi','V']
		],
		'DORIAN' => [
			['i','IV','i','VII'],
			['i','VII','i','VII'],
			['i','IV','ii','v','VII'],
			['i','III','IV','i','VII']
		],
		'PHRYGIAN' => [
			['i','II','III'],
			['i','V','i','II'],
			['i','iv','i','II'],
			['i','III','vii']
		],
		'LYDIAN' => [
			['I','II'],
			['I','II','I','II','iv','V','iv','V'],
			['I','vi','II','V'],
			['I','V','I','II']
		],
		'MIXOLYDIAN' => [ 
			['I','VII','I','VII'],
			['I','vi','IV','V','VII'],
			['I','IV','I','VII'],
			['I','ii','IV','VII']
		],
		'AEOLIAN' => [
			['i','VI','VII'],
			['i','iv','v'],
			['i','VII','VI','VII'],
			['i','VI','III','VII'],
			['i','III','i','VII']
		],
		'LOCRIAN' => [
			['io','V','io','V'],
			['io','iii','io','II'],
			['io','iii','vii'],
			['io','vii','io','vii']
		]
	];

	public static function build($name,$progression,$chords)
	{
		if (isset(self::$map[$name])) {
			$set = [];
			foreach(self::$map[$name] as $pro){
				$real = [];
				foreach($pro as $p){
					$index = array_search($p,$progression);
					$real[] = $chords[$index];
				}

				$set[] = [$pro,$real];
			}

			return $set;
		}

		return false;
	}
}
?>
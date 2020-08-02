
var ChordsPlayer = {
	root: '',
	instrument: '',
	strum: false,
	audio: [],
	notes: {
		'C1':  'C','C#1': 'C#','D1' : 'D','D#1': 'D#','E1' : 'E','F1' : 'F','F#1': 'F#',
		'G1' : 'G','G#1': 'G#','A1' : 'A','A#1': 'A#','B1' : 'B',
		'C2':  'C','C#2': 'C#','D2' : 'D','D#2': 'D#','E2' : 'E','F2' : 'F','F#2': 'F#',
		'G2' : 'G','G#2': 'G#','A2' : 'A','A#2': 'A#','B2' : 'B',
		'C3':  'C','C#3': 'C#','D3' : 'D','D#3': 'D#','E3' : 'E','F3' : 'F','F#3': 'F#',
		'G3' : 'G','G#3': 'G#','A3' : 'A','A#3': 'A#','B3' : 'B'
	},

	tune: function (chord) {
		var tune = []
		var compare = chord.shift();
		for(var x in ChordsPlayer.notes){
			if(ChordsPlayer.notes.hasOwnProperty(x)){
				if(compare === ChordsPlayer.notes[x]){
					tune.push(x)

					if(chord.length === 0){
						break;
					}

					compare = chord.shift()
				}
			}
		}

		return tune
	},

	stop: function () {
		ChordsPlayer.audio.forEach(function(audio){
			audio.stop()
		})

		ChordsPlayer.audio.length = 0;
	},

	play: function (chord) {
		ChordsPlayer.stop()

		ChordsPlayer.tune(chord).forEach(function(note,index){
			setTimeout(function(){
				var audio = new Audio()
				audio.src = ChordsPlayer.root + '/' + ChordsPlayer.instrument + '/' + escape(note) + '.mp3'
				audio.play()
			},ChordsPlayer.strum ? index * ChordsPlayer.strum : 0)
		})
	}
}
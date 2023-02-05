
var ChordsPlayer = {
	interval: null,
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
		var tuned = chord.slice(0)

		var tune = []
		var compare = tuned.shift();
		for(var x in ChordsPlayer.notes){
			if(ChordsPlayer.notes.hasOwnProperty(x)){
				if(compare === ChordsPlayer.notes[x]){
					tune.push(x)

					if(tuned.length === 0){
						break;
					}

					compare = tuned.shift()
				}
			}
		}

		return tune
	},

	stop: function () {
		ChordsPlayer.audio.forEach(function(audio){
			audio.pause()
		})

		ChordsPlayer.audio.length = 0
	},

	note: function (name) {
		var key = document.getElementById('piano-key-' + name)

		key && key.classList.add('piano-key-active');

		var audio = new Audio()
		audio.src = ChordsPlayer.root + '/' + ChordsPlayer.instrument + '/' + escape(name) + '.mp3'
		audio.onended = function () {
			key && key.classList.remove('piano-key-active');
		}

		audio.onerror = function () {
			console.error(audio.src)
		}

		audio.addEventListener("canplaythrough",function(event){
			audio.play()
		})

		ChordsPlayer.audio.push(audio)
	},

	play: function (chord) {
		ChordsPlayer.stop()

		ChordsPlayer.tune(chord).forEach(function(note,index){
			setTimeout(function(){
				ChordsPlayer.note(note)
			},ChordsPlayer.strum ? index * ChordsPlayer.strum : 0)
		})
	},

	start: function (sequence) {
		this.cancel()

		var bpm = document.getElementById('bpm')
		var delay = 60 / parseInt(bpm.value) * 1000

		var beat = 0;
		this.interval = setInterval(function(){
			if(beat++ % 4 === 0){
				var chord = sequence.shift()
				sequence.push(chord)
				ChordsPlayer.play(chord.slice())
			}
		},delay)

		bpm.disabled = true
	},

	cancel: function () {
		clearInterval(this.interval)
		document.getElementById('bpm').disabled = false
	}
}
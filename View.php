<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link href="//fonts.googleapis.com/css?family=Fira+Sans:300normal,300italic,400normal,400italic,500normal,500italic,700normal,700italic|Open+Sans:400normal|Roboto:400normal|Lato:400normal|Oswald:400normal|Source+Sans+Pro:400normal|Montserrat:400normal|Raleway:400normal|Open+Sans+Condensed:300normal|PT+Sans:400normal|Roboto+Condensed:400normal&amp;subset=all" rel="stylesheet" type="text/css">
</head>
<body>
	<style>
		form {
			display: flex;
			margin: 20px 0;
		}

		input:not([type="range"]),
		button,
		select {
			color: #ecf0f1;
		    background: #34495e;
		    font-family: inherit;
		    outline: none;
		    border: none;
		    padding: 20px;
		    flex-grow: 1;
		    vertical-align: middle;
		    line-height: 18px;
		}

		button {
			flex-grow: 0;
		    background: #2c3e50;
		    font-weight: bold;
		    cursor: pointer;
		}

		button:hover {
			background: #28323c;
		}

		.page {
			width: 800px;
			margin: 50px auto;
			font-family: "Fira Sans";
			font-weight: normal;
			color: #2c3e50;
		}

		.neck__bar {
			background-color: #8e44ad;
			vertical-align: middle;
			position: relative;
			display: inline-block;
			width: 3px;
			height: 26px;
		}

		.neck__empty,
		.neck__scale,
		.neck__root {
			vertical-align: middle;
			position: relative;
			display: inline-block;
			width: 26px;
			height: 26px;
			border-right: 2px solid #2c3e50;
			background-color: #34495e;
			text-align: center;
		}

		.neck__empty:before,
		.neck__scale:before,
		.neck__root:before {
		    z-index: 0;
		    content: '';
		    background-color: #3498db;
		    height: 1px;
		    width: calc(100% + 2px);
		    display: inline-block;
		    top: 12px;
		    left: 0;
		    position: absolute;
		}

		.neck__scale:after,
		.neck__root:after {
			content: attr(with-key);
		    display: inline-block;
		    text-align: center;
		    width: 16px;
		    height: 16px;
		    color: #fff;
		    margin-top: 5px;
		    font-family: monospace;
		    border-radius: 50%;
		    z-index: 1;
		    position: relative;
		    font-size: 10px;
		    font-weight: bold;
    		line-height: 16px;
		}

		.neck__scale:after {
			background-color: #2980b9;
		}

		.neck__root:after {
			background-color: #e74c3c;
		}

		.neck .neck__string:last-child {
			display: none;
		}

		.neck__marker__wrap {
			font-size: 0;
			padding-left: 32px;
		}

		.neck__marker {
			display: inline-block;
			vertical-align: middle;
			width: 28px;
			min-height: 1px;
			text-align: center;
			font-weight: bold;
			color: #2c3e50;
			font-size: 14px;
			font-family: monospace;
		}

		.prog {
			margin: 1px 0;
			border-bottom: 1px solid #ececec;
		}

		.prog__key {
			width: 35px;
			display: inline-block;
			vertical-align: middle;
			font-size: 24px;
		}

		.prog__item {
			width: auto;
			display: inline-block;
			border-left: 1px solid #ececec;
			padding: 5px 0 5px 10px;
			vertical-align: middle;
			margin-bottom: 1px;
			white-space: pre;
			font-size: 15px;
			width: 20%;
			overflow: hidden;
		}

		.prog__play {
			cursor: pointer;
    		border-bottom: 1px dashed;
    		display: inline-block;
		}

		.prog__resolve {
			background-color: #8e44ad;
			color: #fff;
			font-size: 20px;
			padding: 5px;
			margin: 3px 0;
			display: inline-block;
			border-radius: 3px;
		}

		.prog__resolve-toggle {
			position: sticky;
			top: 0;
			left: 0;
			width: 150px;
			padding: 10px;
			z-index: 2;
			background: #34495e;
			color: #ffffff;
		}

		.roll__board {
			width: 365px;
   			margin: 50px auto;
		}

		.order {
			margin: 20px 0;
			font-size: 35px;
		}

		.order-role-root { color: #9b59b6;  }
		.order-role-first { color: #2ecc71; }
		.order-role-second { color: #3498db; }
		.order-role-third { color: #e74c3c; }

		.piano-wrap {
			font-size: 0;
			position: relative;
			border: 10px solid;
			border-radius: 10px;
			display: inline-block;
			margin: 20px 0;
		}

		.piano-key {
			border: 1px solid #ddd;
			display: inline-block;
			padding: 80px 16px;
			vertical-align: top;
			position: relative;
		}

		.piano-key-sharp {
			background: #34495e;
			padding: 50px 16px;
			margin-left: -16px;
			position: absolute;
			z-index: 1;
		}

		.piano-key:active,
		.piano-key-sharp:active,
		.piano-key-active {
			background: #e74c3c;
		}

		.piano-order:before {
			content: '';
			position: absolute;
			width: 10px;
			height: 10px;
			border-radius: 50%;
			bottom: 5px;
			left: 0;
			right: 0;
			margin: auto;
		}

		.piano-order-root:before   { background: #9b59b6; }
		.piano-order-first:before  { background: #2ecc71; }
		.piano-order-second:before { background: #3498db; }
		.piano-order-third:before  { background: #e74c3c; }
	</style>
<div class="page">
	<?php if (is_null($info)): ?>
		<form action="/scales/">
			<input type="hidden" name="action" value="mode">
			<select name="args[]">
				<?php foreach(Undercloud\Scales\Modes::keys() as $k): ?>
					<option value="<?= $k ?>"><?= str_replace(array('♯','♭','♮'),array('&#x266f;','&#x266d;','&#x266e;'),$k) ?></option>
				<?php endforeach; ?>
			</select>
			<select name="args[]">
				<?php foreach(Undercloud\Scales\Chromatic::toRoot('C') as $k): ?>
					<option><?= $k ?></option>
				<?php endforeach; ?>
			</select>
			<button>GO</button>
		</form>

		<form action="/scales/">
			<input type="hidden" name="action" value="search">
			<input name="args[]" placeholder="C D E F G A B" />
			<button>GO</button>
		</form>

		<form action="/scales/">
			<input type="hidden" name="action" value="search-by">
			<input name="args[]" placeholder="C F G" />
			<button>GO</button>
		</form>

		<form action="/scales/">
			<input type="hidden" name="action" value="chord">
			
			<select name="args[]">
				<?php foreach(Undercloud\Scales\Chromatic::toRoot('C') as $k): ?>
					<option><?= $k ?></option>
				<?php endforeach; ?>
			</select>

			<select name="args[]">
				<?php foreach(Undercloud\Scales\Chords::names() as $n): ?>
					<option><?= $n ?></option>
				<?php endforeach; ?>
			</select>

			<button>GO</button>
		</form>

		<form action="/scales/">
			<input type="hidden" name="action" value="negative">

			<select name="args[]">
				<?php foreach(Undercloud\Scales\Chromatic::toRoot('C') as $k): ?>
					<option><?= $k ?></option>
				<?php endforeach; ?>
			</select>

			<select name="args[]">
				<?php foreach(Undercloud\Scales\Chords::names() as $n): ?>
					<option><?= $n ?></option>
				<?php endforeach; ?>
			</select>

			<select name="args[]">
				<?php foreach(Undercloud\Scales\Chromatic::toRoot('C') as $k): ?>
					<option><?= $k ?></option>
				<?php endforeach; ?>
			</select>

			<button>GO</button>
		</form>
	<?php elseif (false === $info): ?>
		<b>Nothing Found... :(</b>
	<?php else: ?>
			<div class="prog__resolve-toggle">
				<label>
					<input id="resolve-toggler" type="checkbox" onchange="Resolver.isOn = this.checked" /> Resolve
				</label>
				<div id="resolve-pin"></div>
			</div>

		<script type="text/javascript" src="audio/audio.js"></script>

		<script type="text/javascript">
			ChordsPlayer.instrument = 'piano'
			ChordsPlayer.strum = 75
			ChordsPlayer.root = 'audio/samples'

			Resolver = {
				isOn: false,
				pin: function (label,chord) {
					document.querySelector('#resolve-pin').innerHTML = (
						'<span class="prog__play" onclick="ChordsPlayer.play([\'' + chord.join("','") + '\'])">' + 
							label + 
						'</span>'
					)
				},
				resolve: function (mode,root,chord,label) {
					if(this.isOn){
						this.isOn = false
						document.querySelector('#resolve-toggler').checked = false
						this.pin(label,chord)

						var query = ''

						query += '&args[0]=' + mode;
						query += '&args[1]=' + root;

						chord.forEach(function(note,index){
							query += '&args[2][' + index + ']=' + escape(note)
						})

						fetch('?action=resolve' + query)
  							.then(function(response){ return response.json() })
  							.then(function(response){
  								document.querySelectorAll('.prog__resolve').forEach(function(item){
  									item.classList.remove('prog__resolve')
  								})

  								if(response && response.resolve){
  									response.resolve.forEach(function(chord){
  										document
  											.querySelector('.prog__title[data-chord-name="' + chord + '"]')
  											.classList
  											.add('prog__resolve')
  									})
  								}
  							})
					}
				}
			}
		</script>

		<h1><?= str_replace(array('♯','♭','♮'),array('&#x266f;','&#x266d;','&#x266e;'),$info['type']) ?></h1>

		<div style="font-family: monospace;font-size: 20px;" <?php 
			if($_GET['action'] === 'chord'):?>
				class="prog__play" 
				onclick="ChordsPlayer.play(['<?php echo implode("','",$info['scale']);?>'])"
			<?php endif;?> 
		><br/>
			<?= implode(' ',$info['scale']) ?>	
		</div>
		
		<?php if(isset($info['negative'])): ?>
			<h1><?= $info['negative'][0] ?> (negative)</h1>
			<div style="font-family: monospace;font-size: 20px;"
				class="prog__play" 
				onclick="ChordsPlayer.play(['<?php echo implode("','",$info['negative'][1]);?>'])"
			><br/>
				<?= implode(' ',$info['negative'][1]) ?>
			</div>
		<? endif; ?>

		<?php if(isset($info['formula'])): ?>
			<div style="font-family: monospace;font-size:20px;"><?= implode('	',$info['formula']) ?></div>
		<?php endif; ?>

		<?php if(isset($info['order'])): ?>
			<div class="order">
				<?php foreach($info['order'] as $index => $key): ?>
					<span class="order-role-<?= Undercloud\Scales\Order::getRole($index) ?>">
						<?= $key ?>
					</span>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php require __DIR__ . '/Sequence.View.php'; ?>

		<?php if(isset($info['chords'])): ?>
			<?php foreach($info['chords'] as $key => $val): ?>
				<div class="prog"><b class="prog__key"><?= $key ?></b>
					<ul>
					<?= 
					implode(array_map(function($v){
						return '<li class="prog__item">' . $v . '</li>'; 
					},$val)) 
					?>
					</ul>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>

		<div style="margin-top: 20px"><?= ($info['guitar-neck']) ?></div>
	<?php endif; ?>
</div>
</body>
</html>
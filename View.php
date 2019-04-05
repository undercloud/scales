<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="//fonts.googleapis.com/css?family=Fira+Sans:300normal,300italic,400normal,400italic,500normal,500italic,700normal,700italic|Open+Sans:400normal|Roboto:400normal|Lato:400normal|Oswald:400normal|Source+Sans+Pro:400normal|Montserrat:400normal|Raleway:400normal|Open+Sans+Condensed:300normal|PT+Sans:400normal|Roboto+Condensed:400normal&amp;subset=all" rel="stylesheet" type="text/css">
</head>
<body>
	<style>
		form {
			display: flex;
			margin: 20px 0;
		}

		input,
		button,
		select {
			color: #ecf0f1;
		    background: #34495e;
		    font-family: inherit;
		    border: none;
		    padding: 20px;
		    flex-grow: 1;
		}

		button {
			flex-grow: 0;
		    background: #2c3e50;
		    font-weight: bold;
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
		}

		.prog__item {
			width: 120px;
			display: inline-block;
			border-left: 1px solid #ececec;
			padding: 5px 0 5px 10px;
			vertical-align: middle;
			margin-bottom: 1px;
			white-space: pre;
			font-size: 15px;
		}
	</style>
<div class="page">
	<?php if (is_null($info)): ?>
		<form action="/scales/">
			<input type="hidden" name="action" value="mode">
			<select name="args[]">
				<?php foreach(Undercloud\Scales\Modes::keys() as $k): ?>
					<option><?= $k ?></option>
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
	<?php elseif (false === $info): ?>
		<b>Nothing Found... :(</b>
	<?php else: ?>
		<h1><?= $info['type'] ?></h1>

		<div><?= implode(' ',$info['scale']) ?></div>
		
		<?php if(isset($info['formula'])): ?>
			<div><?= implode('	',$info['formula']) ?></div>
		<?php endif; ?>

		<?php if(isset($info['chords'])): ?>
			<?php foreach($info['chords'] as $key => $val): ?>
				<div class="prog"><b class="prog__key"><?= $key ?></b>	<?= 
					implode(array_map(function($v){
						return '<span class="prog__item">' . $v . '</span>'; 
					},$val)) 
				?></div>
			<?php endforeach; ?>
		<?php endif; ?>

		<div style="margin-top: 20px"><?= ($info['guitar-neck']) ?></div>
	<?php endif; ?>
</div>
</body>
</html>
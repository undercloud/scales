<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="//fonts.googleapis.com/css?family=Fira+Sans:300normal,300italic,400normal,400italic,500normal,500italic,700normal,700italic|Open+Sans:400normal|Roboto:400normal|Lato:400normal|Oswald:400normal|Source+Sans+Pro:400normal|Montserrat:400normal|Raleway:400normal|Open+Sans+Condensed:300normal|PT+Sans:400normal|Roboto+Condensed:400normal&amp;subset=all" rel="stylesheet" type="text/css">
</head>
<body>
	<style>
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
		}

		.neck__scale:after {
			content: '';
			background-color: #2980b9;
		}

		.neck__root:after {
			content: 'R';
			background-color: #e74c3c;
			font-size: 12px;
			line-height: 16px;
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
	</style>

	<?php 
		function neckify($inline){
			$inline = (
				'<div class="neck__string">' .
					str_replace(PHP_EOL, '</div><div class="neck__string">', $inline) .
				'</div>'
			);

			$inline = str_replace('|| ||', '<span class="neck__bar"></span><span class="neck__empty"></span><span class="neck__bar"></span>', $inline);
			$inline = str_replace('||', '<span class="neck__bar"></span>', $inline);
			$inline = str_replace('|', '', $inline);
			$inline = str_replace('-', '<span class="neck__empty"></span>', $inline);
			$inline = str_replace('x', '<span class="neck__scale"></span>', $inline);
			$inline = str_replace('R', '<span class="neck__root"></span>', $inline);

			return (
				'<div class="neck">' . $inline . '</div>
				<div class="neck__marker__wrap">
					<span class="neck__marker"></span>
					<span class="neck__marker"></span>
					<span class="neck__marker">3</span>
					<span class="neck__marker"></span>
					<span class="neck__marker">5</span>
					<span class="neck__marker"></span>
					<span class="neck__marker">7</span>
					<span class="neck__marker"></span>
					<span class="neck__marker">9</span>
					<span class="neck__marker"></span>
					<span class="neck__marker"></span>
					<span class="neck__marker">12</span>
					<span class="neck__marker"></span>
					<span class="neck__marker"></span>
					<span class="neck__marker">15</span>
					<span class="neck__marker"></span>
					<span class="neck__marker">17</span>
					<span class="neck__marker"></span>
					<span class="neck__marker">19</span>
					<span class="neck__marker"></span>
					<span class="neck__marker">21</span>
					<span class="neck__marker"></span>
					<span class="neck__marker"></span>
					<span class="neck__marker">24</span>
				</div>'
			);
		}
	?>
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
			<input name="args[]" />
			<button>GO</button>
		</form>

		<form action="/scales/">
			<input type="hidden" name="action" value="search-by">
			<input name="args[]" />
			<button>GO</button>
		</form>
	<?php elseif (false === $info): ?>
		<b>Nothing Found... :(</b>
	<?php else: ?>
		<h1><?= $info['type'] ?></h1>

		<div><?= implode(' ',$info['scale']) ?></div>

		<div><pre><?= implode('	| ',$info['chords'][0]) ?></pre></div>
		<div><pre><?= implode('	| ',$info['chords'][1]) ?></pre></div>

		<div><?= neckify($info['guitar-neck']) ?></div>

		<div>
			<?php if ($info['library']): ?>
				<?php foreach($info['library'] as $lib): ?>
					<div><pre><?= implode('	| ',$lib[0]) ?></pre></div>
					<div><pre><?= implode('	| ',$lib[1]) ?></pre></div>
					<hr />
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
</body>
</html>
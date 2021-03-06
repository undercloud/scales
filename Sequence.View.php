<div style="margin: 20px 0;">
	<select 
		style="width:25%"
		onchange="ChordsPlayer.instrument = this.value">
		<option value="piano">Piano</option>
		<option value="rhodes">Rhodes</option>
		<option value="organ">Organ</option>
		<option value="guitar">Guitar</option>
	</select><!--
 --><select style="width:25%" id="sequence">
<?php
if($info['sequence']){
	foreach($info['sequence'] as $item){
		echo "<option value='" . json_encode($item['sequence']) . "'>{$item['name']}</option>";
	}
}
?>
</select><!--
--><button onclick="ChordsPlayer.start(JSON.parse(document.getElementById('sequence').value))" style="width:10%">play</button><!--
--><button onclick="ChordsPlayer.cancel()" style="width:10%">stop</button><!--
--><input 
	id="bpm"
	value="120" 
	style="width:20%;margin:0" 
	type="range" 
	min="60" 
	max="200" 
	step="2" 
	oninput="document.getElementById('bpm-label').innerText = this.value + ' BPM'" /><!--
 --><span id="bpm-label" style="display:inline-block;width:10%;text-align:center">120 BPM</span>
</div>

<?php $chromatic = Undercloud\Scales\Chromatic::toRoot('C'); ?>
<?php $piano = [$chromatic,$chromatic,$chromatic]; ?>

<div class="piano-wrap">
<?php foreach($piano as $octave => $notes): ?>
	<?php foreach($notes as $note): ?>
		<div 
			id="piano-key-<?= $note . ($octave + 1) ?>" 
			onclick="ChordsPlayer.note('<?= $note . ($octave + 1) ?>')" 
			class="piano-key <?= strpos($note,'#') ? 'piano-key-sharp' : '' ?> <?php if(in_array($note,$info['order'])): ?>
			piano-order piano-order-<?= Undercloud\Scales\Order::getRole(array_search($note,$info['order'])) ?>
			<?php endif;?>"></div>
	<?php endforeach; ?>
<? endforeach; ?>
</div>
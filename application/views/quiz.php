<p class="direction">Please rate the following on a scale from most liberal (1) to most conservative (7).</p>
<?php foreach( $politicians as $politician ): ?>
<ul>
	<li><?php echo $politician->name; ?></li>
</ul>
<?php endforeach; ?>
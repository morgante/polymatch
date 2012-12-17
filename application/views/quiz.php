<section id="forms">
	<div class="page-header">
		<h1>PolyMatch Political Identification</h1>
	</div>

	<form name="polymatch-quiz" id="polymatch-quiz" method="post">

		<input type="hidden" name="polymatch-form" value="complete" id="polymatch-form">

		<div class="clearfix">
			<p class="direction">Please rate each of the following on a scale from liberal (1) to conservative (7).</p>
			<table>
				<tbody>
				<?php foreach( $politicians as $politician ): ?>
					<tr>
						<th class="politician"><?php echo $politician->name; ?></th>
						<th class="scale liberal"><span class="help-block">Liberal</span></th>
						<td><input type="radio" checked="" name="rate-<?php echo $politician->id; ?>" value="1"></td>
						<td><input type="radio" checked="" name="rate-<?php echo $politician->id; ?>" value="2"></td>
						<td><input type="radio" checked="" name="rate-<?php echo $politician->id; ?>" value="3"></td>
						<td><input type="radio" checked="" name="rate-<?php echo $politician->id; ?>" value="4"></td>
						<td><input type="radio" checked="" name="rate-<?php echo $politician->id; ?>" value="5"></td>
						<td><input type="radio" checked="" name="rate-<?php echo $politician->id; ?>" value="6"></td>
						<td><input type="radio" checked="" name="rate-<?php echo $politician->id; ?>" value="7"></td>		
						<th class="scale conservative"><span class="help-block">Conservative</span></th>
					</tr>
				<?php endforeach ;?>
				</tbody>
			</table>
		</div><!-- /clearfix -->

		<div class="actions">
			<input type="submit" class="btn primary" value="Submit">
		</div>
		
	</form>

</section>

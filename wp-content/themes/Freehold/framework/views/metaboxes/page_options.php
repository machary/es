<div class='pyre_metabox'>
	<?php
	$types = get_terms('portfolio_type', 'hide_empty=0');
	if($types) {
		foreach($types as $type) {
			$types_array[$type->term_id] = $type->name;
		}
	$this->select(	'portfolio_type',
					'Portfolio Type',
					$types_array,
					'Choose what portfolio type you want to display on this page.  <strong>Note</strong>:  Only works with portfolio templates.'
				);
	}
	?>
</div>
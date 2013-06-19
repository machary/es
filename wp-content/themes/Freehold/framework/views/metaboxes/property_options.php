<?php
$this->textarea(	'full_address',
				'Google Maps Full Address',
				'Paste full address for google maps location.   Ex: 1457 Golf Course Dr, Windsor, CA 95492'
			);
$this->text(	'address',
			'Address',
			'Paste in  your street number and street.  Ex: 1457 Golf Course Dr'
			);
$this->text(	'city',
			'City',
			'Paste in your city.  Ex:  Windsor'
			);
$this->text(	'state',
			'State',
			'Paste in your state.  Ex:  Ca'
			);
$this->text(	'zip',
			'Zip Code',
			'Paste in your zip code.  Ex. 95492'
			);
$this->text(	'price',
			'Price',
			'Type price in using only numbers.'
			);
$this->select(	'status',
			'Property Status',
			array('For Rent' => 'For Rent', 'For Sale' => 'For Sale', 'Open House' => 'Open House', 'Call For Price' => 'Call For Price'),
			''
			);
$this->text(	'open',
			'Open House',
			'Choose an open house date and time.  Ex. Fri 2/18, 2pm - 4pm'
			);
$this->text(	'bedrooms',
			'Bedrooms',
			'Type number of bedrooms in using only numbers'
			);
$this->text(	'bathrooms',
			'Bathrooms',
			'Type number of bathrooms in using only numbers'
			);
$this->text(	'garage',
			'Number of Car Garage',
			'Type number of car garage in using only numbers'
			);
$this->text(	'size',
			'Size (in sqft)',
			'Type number of sqft using only numbers'
			);
$this->text(	'lot',
			'Lot (in sqft)',
			'Type number of sqft using only numbers'
			);
$this->text(	'built',
			'Year Built',
			'Type year using only numbers'
			);
$agents = freehold_all_authors();
$this->select(	'agent',
			'Select Agent',
			$agents,
			''
			);

			$this->text(	'no_agent',
						'Disable Agent',
						'Type True to disable the agent for this specific listing.'
						);
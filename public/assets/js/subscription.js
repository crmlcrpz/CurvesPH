$(document).ready(function() {
				$('#subscriptionsform').bootstrapValidator({
					fields: {
						end_date: {
							validators: {
								notEmpty: {
									message: 'The end date is required and can\'t be empty'
								}
							}
						},
					}
				});
			});
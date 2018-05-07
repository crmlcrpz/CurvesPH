<div class="row">
	<div class="col-md-12">
		<div class="panel no-border">
			<div class="panel-title">
				<div class="panel-head font-size-20">Enter details of the payment</div>
			</div>

			<div class="panel-body">
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							{!! Form::label('payment_amount','Amount Received') !!}
							<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-inr"></i></div>
							{!! Form::text('payment_amount',null,['class'=>'form-control', 'id' => 'payment_amount', 'data-amounttotal' => '0']) !!}
							</div>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="form-group">
							{!! Form::label('payment_amount_pending','Amount Pending') !!}
							<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-inr"></i></div>
							{!! Form::text('payment_amount_pending',null,['class'=>'form-control', 'id' => 'payment_amount_pending', 'readonly']) !!}
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
							{!! Form::label('mode','Mode') !!}
							{!! Form::select('mode',array('1' => 'Cash', '0' => 'Card'),1,['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'mode']) !!}
						</div>
					</div>
				</div> <!-- /Row -->

			</div> <!-- /Panel-body -->

		</div> <!-- /Panel-no-border -->
	</div> <!-- /Main Column -->
</div> <!-- /Main Row -->
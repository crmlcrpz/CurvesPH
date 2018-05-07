<div class="panel-body">								 
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<?php  $invoiceList = App\Invoice::lists('invoice_number', 'id'); ?>
				{!! Form::label('invoice_id','Invoice Number') !!}
				{!! Form::select('invoice_id',$invoiceList,(isset($invoice) ? $invoice->id : null),['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'invoice_id', 'data-live-search'=> 'true']) !!}							
			</div>							
		</div>
	</div>	

	
				
	<div class="row">						
		<div class="col-sm-6">
			<div class="form-group">
				{!! Form::label('payment_amount','Amount') !!}
				<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-inr"></i></div>
				{!! Form::text('payment_amount',(isset($invoice) ? $invoice->pending_amount : null),['class'=>'form-control', 'id' => 'payment_amount']) !!}			
				</div>							
			</div>							
	    </div>
    </div>

    <div class="row">
		<div class="col-sm-6">
			<div class="form-group">
			{!! Form::label('mode','Mode') !!}
			{!! Form::select('mode',array('1' => 'Cash', '0' => 'Card'),(isset($payment_detail) ? $payment_detail->mode : null),['class'=>'form-control selectpicker show-tick show-menu-arrow', 'id' => 'mode']) !!}
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6">
	 		<div class="form-group">
				 {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary pull-right']) !!}
	 		</div>
		</div>
	</div>
</div>

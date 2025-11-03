<form style="position: relative;overflow: hidden;" id="inputSerialFrm">
  {{ csrf_field() }}
  
  	@if($brands->count() > 1)
    <div class="col-md-12 form-group">
          {{Form::label('Select Brand',null,array('class' => 'control-label'))}}
          {{Form::select('brand_id',$brands,$brandId,array('onchange'=>"generatePreSerial(this)",'class' => 'form-control'))}}
    </div>
    @php
		$preSerial = 'DIIL/' . $brands[$item->brand_id]. '/' . $size . '/';
		@endphp
    @else
    	 @php
    		$preSerial = 'DIIL/' . $brands[$item->brand_id]. '/' . $size . '/';
		@endphp
    @endif
    @if($item)
    	{{Form::hidden('item_id',$item->id,array('id'=>'itemId'))}}
    @endif
	{{Form::hidden('preSerial',$preSerial,array('id'=>'hidden-preserial-id'))}}
	{{Form::hidden('requestFrom','freeze_assign')}}
	<div class="input-group">
		<span class="input-group-addon" id="pre-serial">{{$preSerial}}</span>
        {{Form::text('serial',null,array('required','class' => 'form-control max-length','oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength'=>8))}}
	</div>
   	<p class="text-danger" id="error"></p>
    <div class="col-md-4 form-group">
        <button type="button" class="btn btn-success" id="confirm-btn" onclick="addSerial()">Submit</button>
    </div>
</form>
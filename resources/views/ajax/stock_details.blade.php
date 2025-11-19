<table class="table table-condensed">
	@if ($stocks->supplier)
		<tr>
			<th>Supplier</th>
			<td>{{ $stocks->supplier->name ?? '' }}</td>
		</tr>
	@endif
	@if ($stocks->country)
		<tr>
			<th>Origin</th>
			<td>{{ $stocks->country->country_name ?? '' }}</td>
		</tr>
	@endif
	<tr>
		<th>Invoice No.</th>
		<td>{{ $stocks->invoice_no ?? '' }}</td>
	</tr>
	<tr>
		<th>Invoice Date</th>
		<td>
		@if ($stocks->invoice_date)
			{{ Carbon\Carbon::parse($stocks->invoice_date)->format('d-M-Y') }}
		@endif
		</td>
	</tr>
	<tr>
		<th>LC No.</th>
		<td>{{ $stocks->lc_no ?? '' }}</td>
	</tr>
	<tr>
		<th>LC Date</th>
		<td>
		@if ($stocks->invoice_date)
			{{ Carbon\Carbon::parse($stocks->lc_date)->format('d-M-Y') }}
		@endif
		</td>
	</tr>
	<tr>
		<th>No of Type</th>
		<td>{{ $stocks->no_of_type ?? '0' }}</td>
	</tr>
	<tr>
		<th>Total Item</th>
		<td>{{ $stocks->total_item ?? '0' }}</td>
	</tr>
	<tr>
		<th>Currency</th>
		<td>{{ $stocks->currency ?? '' }}</td>
	</tr>
	<tr>
		<th>Is Opening</th>
		<td>{{ config('myconfig.boolArr')[$stocks->is_opening]}}</td>
	</tr>
	<tr>
		<th>Receive Date</th>
		<td>{{ Carbon\Carbon::parse($stocks->created_at)->format('d-M-Y') }}</td>
	</tr>
</table>
@if ($stocks->stock_details)
<h4 class="text-center"><span class="bb-sm">Stock Detail Informations</span></h4>
<table class="table table-condensed">
	<thead>
		<tr>
			<th>Brand</th>
			<th>Size</th>
			<th>Quantity</th>
			<th>Receive Qty</th>
			<th>Unit Price</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($stocks->stock_details as $ele)
			<tr>
				<td>
					@if ($ele->brand)
						{{ $ele->brand->short_code ?? '' }}
					@endif
				</td>
				<td>
					@if ($ele->size)
						{{ $ele->size->name ?? '' }}
					@endif
				</td>
				<td>{{ $ele->qty ?? '0' }}</td>
				<td>{{ $ele->receive_qty ?? '0' }}</td>
				<td>{{ $ele->unit_price ?? '0' }}</td>
			</tr>
		@endforeach

	</tbody>
</table>
@endif
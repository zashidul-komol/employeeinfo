<table class="table table-condensed">
	<tr>
		<th>Invoice</th>
		<td>{{ $allocations->stock->invoice_no ?? '' }}</td>
	</tr>
	<tr>
		<th>Depot</th>
		<td>{{ $allocations->depot->name ?? '' }}</td>
	</tr>
	<tr>
		<th>Number of Item</th>
		<td>{{ $allocations->no_of_item ?? '0' }}</td>
	</tr>
	<tr>
		<th>Total Quantity</th>
		<td>{{ $allocations->total_qty ?? '0' }}</td>
	</tr>
	<tr>
		<th>Status</th>
		<td>{{ $allocations->status ?? '' }}</td>
	</tr>
	<tr>
		<th>Allocation Time</th>
		<td>
		{{ Carbon\Carbon::parse($allocations->created_at)->format('d-M-Y') }}
		</td>
	</tr>
</table>
@if ($allocations->allocation_details)
<h4 class="text-center"><span class="bb-sm">Stock Detail Informations</span></h4>
<table class="table table-condensed">
	<thead>
		<tr>
			<th>Brand</th>
			<th>Size</th>
			<th>Quantity</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($allocations->allocation_details as $ele)
			<tr>
				<td>
					@if ($ele->stock_detail->brand)
						{{ $ele->stock_detail->brand->short_code ?? '' }}
					@endif
				</td>
				<td>
					@if ($ele->stock_detail->size)
						{{ $ele->stock_detail->size->name ?? '' }}
					@endif
				</td>
				<td>{{ $ele->qty ?? '0' }}</td>
			</tr>
		@endforeach

	</tbody>
</table>
@endif
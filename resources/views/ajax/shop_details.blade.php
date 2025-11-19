<table class="table table-condensed">
	<tr>
		<th>Outlet Name </th>
		<td>{{ $shop->outlet_name ?? '' }}</td>
	</tr>
	<tr>
		<th>Proprietor Name</th>
		<td>{{ $shop->proprietor_name ?? '' }}</td>
	</tr>
	@if ($shop->distributor)
		<tr>
			<th>Distributor</th>
			<td>{{ $shop->distributor->outlet_name ?? '' }}</td>
		</tr>
	@endif
	<tr>
		<th>Mobile</th>
		<td>{{ $shop->mobile ?? '' }}</td>
	</tr>
	<tr>
		<th>NID</th>
		<td>{{ $shop->nid ?? '' }}</td>
	</tr>
	<tr>
		<th>Trade Lincense</th>
		<td>{{ $shop->trade_license ?? '' }}</td>
	</tr>
	<tr>
		<th>Shop Address</th>
		<td>{{ $shop->address ?? '' }}</td>
	</tr>
	<tr>
		<th>Shop Location</th>
		<td>{{ $shop->thana->name ?? '' }},{{ $shop->district->name ?? '' }},{{ $shop->division->name ?? '' }}</td>
	</tr>
	<tr>
		<th>Shop Zone</th>
		<td>
		@if ($shop->area)
			{{ $shop->area->name ?? '' }},
		@endif
			{{ $shop->region->name ?? '' }}
		</td>
	</tr>
	<tr>
		<th>Depot</th>
		<td>{{ $shop->depot->name ?? '' }}</td>
	</tr>
	<tr>
		<th>Present Address</th>
		<td>{{ $shop->present_address ?? '' }}</td>
	</tr>
	<tr>
		<th>Permanent Address</th>
		<td>{{ $shop->parmanent_address ?? '' }}</td>
	</tr>
	<tr>
		<th>Shop Created</th>
		<td>{{ $shop->created_at ?? '' }}</td>
	</tr>
	<tr>
		<th>Status</th>
		<td class="text-capitalize">{{ $shop->status ?? '' }}</td>
	</tr>
	@if($shop->items->count())
		<tr class="bg-info">
    		<th>DF List</th>
    		<td>&nbsp;</td>
    	</tr>
    	@foreach($shop->items as $item)
    	<tr>
    		<td>{{$item->serial_no}}</td>
    		<td>{{mystudy_case($item->freeze_status)}}</td>
    	</tr>
    	@endforeach
	@endif
</table>
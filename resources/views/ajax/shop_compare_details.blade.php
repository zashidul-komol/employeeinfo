<table class="table table-condensed">
	<tr>
		<th>&nbsp;</th>
		<th>From Shop</td>
		<th>To Shop</td>
	</tr>
	<tr>
		<th>Outlet Name </th>
		<td>{{ $fromShop->outlet_name ?? '' }}</td>
		<td>{{ $toShop->outlet_name ?? '' }}</td>
	</tr>
	<tr>
		<th>Proprietor Name</th>
		<td>{{ $fromShop->proprietor_name ?? '' }}</td>
		<td>{{ $toShop->proprietor_name ?? '' }}</td>
	</tr>
	<tr>
		<th>Distributor</th>
		<td>
			@if ($fromShop->distributor)
			{{ $fromShop->distributor->outlet_name ?? '' }}
			@endif
		</td>
		<td>
			@if ($toShop->distributor)
			{{ $toShop->distributor->outlet_name ?? '' }}
			@endif
		</td>
	</tr>
	<tr>
		<th>Mobile</th>
		<td>{{ $fromShop->mobile ?? '' }}</td>
		<td>{{ $toShop->mobile ?? '' }}</td>
	</tr>
	<tr>
		<th>NID</th>
		<td>{{ $fromShop->nid ?? '' }}</td>
		<td>{{ $toShop->nid ?? '' }}</td>
	</tr>
	<tr>
		<th>Trade Lincense</th>
		<td>{{ $fromShop->trade_license ?? '' }}</td>
		<td>{{ $toShop->trade_license ?? '' }}</td>
	</tr>
	<tr>
		<th>Shop Address</th>
		<td>{{ $fromShop->address ?? '' }}</td>
		<td>{{ $toShop->address ?? '' }}</td>
	</tr>
	<tr>
		<th>Shop Location</th>
		<td>{{ $fromShop->thana->name ?? '' }},{{ $fromShop->district->name ?? '' }},{{ $fromShop->division->name ?? '' }}</td>
		<td>{{ $toShop->thana->name ?? '' }},{{ $toShop->district->name ?? '' }},{{ $toShop->division->name ?? '' }}</td>
	</tr>
	<tr>
		<th>Shop Zone</th>
		<td>
		@if ($fromShop->area)
			{{ $fromShop->area->name ?? '' }},
		@endif
			{{ $fromShop->region->name ?? '' }}
		</td>
		<td>
		@if ($toShop->area)
			{{ $toShop->area->name ?? '' }},
		@endif
			{{ $toShop->region->name ?? '' }}
		</td>
	</tr>
	<tr>
		<th>Depot</th>
		<td>{{ $fromShop->depot->name ?? '' }}</td>
		<td>{{ $toShop->depot->name ?? '' }}</td>
	</tr>
	<tr>
		<th>Present Address</th>
		<td>{{ $fromShop->present_address ?? '' }}</td>
		<td>{{ $toShop->present_address ?? '' }}</td>
	</tr>
	<tr>
		<th>Permanent Address</th>
		<td>{{ $fromShop->parmanent_address ?? '' }}</td>
		<td>{{ $toShop->parmanent_address ?? '' }}</td>
	</tr>
	<tr>
		<th>Shop Created</th>
		<td>{{ $fromShop->created_at ?? '' }}</td>
		<td>{{ $toShop->created_at ?? '' }}</td>
	</tr>
	<tr>
		<th>Status</th>
		<td class="text-capitalize">{{ $fromShop->status ?? '' }}</td>
		<td class="text-capitalize">{{ $toShop->status ?? '' }}</td>
	</tr>
</table>
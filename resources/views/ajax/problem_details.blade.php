<table class="table table-condensed">
	<tr>
		<th>Problem Type </th>
		<td>{{ $dfproblems->df_problem }}</td>
	</tr>
	<tr>
		<th>Token </th>
		<td>{{ $dfproblems->token ?? '' }}</td>
	</tr>
	<tr>
		<th>Daily Serial</th>
		<td>{{ $dfproblems->daily_serial ?? '' }}</td>
	</tr>
	<tr>
		<th>DF Code</th>
		<td class="text-capitalize">{{ $dfproblems->df_code ?? '' }}</td>
	</tr>
	<tr>
		<th>DF Size</th>
		<td>{{ $dfproblems->df_size ?? '' }}</td>
	</tr>
	<tr>
		<th>Region</th>
		<td>{{ $dfproblems->region->name ?? '' }}</td>
	</tr>
	<tr>
		<th>Depot</th>
		<td>{{ $dfproblems->depot->name ?? '' }}</td>
	</tr>
	<tr>
		<th>Distributor</th>
		<td>{{ $dfproblems->distributor->outlet_name ?? '' }}</td>
	</tr>
	<tr>
		<th>Outlet</th>
		<td>{{ $dfproblems->outlet_name ?? '' }}</td>
	</tr>
	<tr>
		<th>Proprietor</th>
		<td>{{ $dfproblems->proprietor_name ?? '' }}</td>
	</tr>
	<tr>
		<th>Outlet Mobile</th>
		<td>{{ $dfproblems->mobile ?? '' }}</td>
	</tr>
	@if ($dfproblems->technician)
		<tr>
			<th>Technician</th>
			<td>{{ $dfproblems->technician->name ?? '' }}</td>
		</tr>
		<tr>
			<th>Technician Mobile</th>
			<td>{{ $dfproblems->technician->mobile ?? '' }}</td>
		</tr>
	@endif
	<tr>
		<th>Address</th>
		<td>{{ $dfproblems->address ?? '' }}</td>
	</tr>
	<tr>
		<th>Received Date</th>
		<td>{{ $dfproblems->created_at->format('l jS \\of F Y h:i:s A') }}</td>
	</tr>
	@if ($dfproblems->attain_date)
		<tr>
			<th>Attain Date</th>
			<td>{{ $dfproblems->attain_date->format('l jS \\of F Y h:i:s A') }}</td>
		</tr>

	@endif

	@if ($dfproblems->status !='pending')
	<tr>
		<th>Pull Status</th>
		@php
			if ($dfproblems->pull==1){$pull='Need Pull';}elseif($dfproblems->pull==2){$pull='<span class="text-danger">Pulled</span>';}elseif($dfproblems->pull==3){$pull='Back to Retailer';}else{$pull='Not Needed';}
		@endphp
		<td>{!! $pull !!}</td>
	</tr>
	<tr>
		<th>Support Status</th>
		@php
			if ($dfproblems->support==1){$support='Need Support';}elseif($dfproblems->support==2){$support='<span class="text-danger">Supported</span>';}elseif($dfproblems->support==3){$support='Retured to Depot';}else{$support='Not Needed';}
		@endphp
		<td>{!! $support !!} @if ($dfproblems->supportdf), Support DF Code :: <span class="text-danger">{{ $dfproblems->supportdf->serial_no }}</span>@endif</td>
	</tr>
	@endif

	@if ($dfproblems->done_date)
		<tr>
			<th>Done Date</th>
			<td>{{ $dfproblems->done_date->format('l jS \\of F Y h:i:s A') }}</td>
		</tr>
		<tr>
			<th>Work Description</th>
			<td>{{ $dfproblems->work_description ?? '' }}</td>
		</tr>
	@endif

	@if ($dfproblems->delivery_date)
	<tr>
		<th>Dalivery Date</th>
		<td>{{ $dfproblems->delivery_date->format('l jS \\of F Y h:i:s A') }}</td>
	</tr>
	@endif
	<tr>
		<th>Status</th>
		<td class="text-capitalize">{{ mystudy_case($dfproblems->status) }}</td>
	</tr>
	<tr>
		<th>Comments</th>
		<td>{{ $dfproblems->comments ?? '' }}</td>
	</tr>
</table>
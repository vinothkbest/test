<div>
	<table class="table table-striped table-bordered w-100" id="employees">
	    <thead>
		    <tr>
		    	@foreach($columns as $column)
			    	<th scope="col">{{ $column }}</th>
			    @endforeach
		    </tr>
	    </thead>
	    <tbody>
	    </tbody>
	</table>
</div>
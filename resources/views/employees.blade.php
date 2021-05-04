@extends('layout')
@section('contents')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
	<div class="card col-md-12">
        <div class="card-header bg-info text-light d-flex justify-content-between">
        	<div class="report">
        		<a href="{{ route('report') }}">
        			<button class="btn btn-dark">Report</button>
        		</a>
        	</div>
        	<div class="welcome">
        		Welcome {{ Auth::user()->name ?? '' }}
        	</div>
        	<div class="logout">
        		<a href="{{ route('logout') }}">
        			<button class="btn btn-danger">Logout</button>
        		</a>
        	</div>
        </div>
        <div class="card-body">
        	<div class="mb-4">
        		<h5 class="mb-4">Employees</h5>
        		<x-data-table :columns="['S.No', 'Name', 'DoB', 'Email', 'Mobile', 'Salary', 'Role', 'Address']"></x-data-table>
        	</div>
        </div> 
    </div>

@endsection

@section('js_after')
<script>
	$(document).ready( function () {
		let i = 0;
	    $('#employees').DataTable({
	       "columnDefs": [{ "width": "15%", "targets": 2 }],
	       "processing": true,
	       "serverSide": false,
	       "ajax" : `{{ url("/ajax-data") }}`,
	       "columns" : [
	            { data : null,
	              render: function () {

	                    i = i+1;

	                    return i
	                  }
	            },
	            { data : 'name'},
	            { data : 'dob'},
	            { data : 'email'},
	            { data : 'mobile'},
	            { data : 'salary'},
	            { data : 'role'},
	            { data : 'address'},
	        ],

    	});
	} );
</script>
<script>
    @if(session('success'))
        swal({ title: "Admin",
            text: `{{ session('success') }}`,
            icon: "success",
        });
    @endif
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<style>
	.dataTables_filter{
		text-align: right;
	}
	label{
		display:inline-flex;
	}
	.pagination{
		justify-content: flex-end;
	}
</style>
	
@endsection

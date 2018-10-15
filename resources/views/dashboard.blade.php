@extends('app')

@section('content')

	<div id="myRecords" class="row">
		<div class="col-xs-12">
			<h1 class="page-header">CRUD laravel and VUEjs with Axios</h1>
		</div>
		<div class="col-sm-8">			
			<a href="#" name="New Record" class="btn btn-primary pull-right mynewrecord" v-on:click.prevent="preCreate()"><span class="glyphicon glyphicon-certificate" aria-hidden="true"></span>&nbsp;New Record</a>			
			<table class="table table-hover table-striped">
				<thead>
					<th>UUID</th>
					<th>Name</th>
					<th>Description</th>
					<th>Code</th>
					<th>status</th>
					<th colspan="2">
						&nbsp;
					</th>
				</thead>
				<tbody>
					<tr v-for="record in records">
						<td>@{{ record.uuid }}</td>
						<td>@{{ record.name }}</td>
						<td>@{{ record.description }}</td>
						<td>@{{ record.code }}</td>
						<td>@{{ record.status }}</td>
						<td width="10px">
							<a href="#" class="btn btn-warning btn-sm" 
							v-on:click.prevent="editRecord(record)">
									<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Edit
							</a>
						</td>
						<td width="10px">
							<a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteRecord(record)">
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;Delete
							</a>
						</td>
					</tr>					
				</tbody>
			</table>

			<nav class="text-center">
				<ul class="pagination">
					<li v-if="pagination.current_page >1">
						<a href="#" @click.prevent="changePage(pagination.current_page - 1)">
							<span>Previous</span>
						</a>
					</li>
					<li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
						<a href="#" @click.prevent="changePage(page)">
							<span>@{{ page }}</span>
						</a>
					</li>
					<li v-if="pagination.current_page < pagination.lastPage">
						<a href="#" @click.prevent="changePage(pagination.current_page + 1)">
							<span>Next</span>
						</a>
					</li>
				</ul>
			</nav>

			@include('modals.create')
			@include('modals.edit')
		</div>
		<div class="col-sm-4">
			<pre>
				@{{ $data }}
			</pre>			
		</div>
	</div>

@endsection
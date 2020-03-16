@extends('admin.template.main')

@section('title', 'Change Template')

<style type="text/css">
.active{
		padding: 10px 20px;
	}
.inactive{
	padding: 10px 20px;
}
</style>
@section('content')
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							@if( Session::has('success'))
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-check-circle"></i> {{Session::get('success')}}
							</div>
							@endif
							<h3 class="panel-title">Change Template</h3>
						</div>
						<div class="panel-body">
							<table class="table table-hover" style="font-size: 18px;">
								<thead>
									<tr>
										<th>ID</th>
										<th>Template Name</th>
										<th>Folder Location</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($templates as $template)
									<tr>
										<td>{{ $template->id }}</td>
										<td>{{ $template->name }}</td>
										<td>{{ $template->folder }}</td>
										<td>{{ $template->selected }}</td>
										<td>
											<span style="display: none">{{ $active = $template->selected }}</span>
											<form action="/dashboard/changetemplate/{{$template->id}}" method="post">
												@csrf
												<input type="hidden" name="selected" value="{{ $active }}">
												@if( $active == '1')
												<button type="submit" class="btn btn-success" id="aktif active">Active</button>
												@else
												<button type="submit" class="btn btn-danger inactive">Inactive</button>
												@endif
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
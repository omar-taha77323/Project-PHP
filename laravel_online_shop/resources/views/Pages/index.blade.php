@extends('dsadmin.layouts.app')

@section('content')

    {{-- <div class="content-wrapper"> --}}
				<!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Pages</h1>
							</div>
							<div class="col-sm-6 text-right">
								{{-- <a href="#" class="btn btn-primary">New Page</a> --}}
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
						<div class="card">
							<div class="card-header">
								<div class="card-tools">
									<div class="input-group input-group" style="width: 250px;">
										<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
					
										<div class="input-group-append">
										  <button type="submit" class="btn btn-default">
											<i class="fas fa-search"></i>
										  </button>
										</div>
									  </div>
								</div>
							</div>
							<div class="card-body table-responsive p-0">								
								<table class="table table-hover text-nowrap">
									<thead>
										<tr>
											<th width="60">ID</th>
											<th>Name</th>
											<th>Slug</th>
											{{-- <th width="100">Status</th>
											<th width="100">Action</th> --}}
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>About Us</td>
											<td>about-us</td>
											<td>
												{{-- <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
													<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
												</svg> --}}
											</td>
											 <td>
											</td>
										</tr>
										<tr>
											<td>2</td>
											<td>Terms & Conditions</td>
											<td>terms-and-conditions</td>
											<td>
											</td>
											<td>
											</td>
										</tr>
										<tr>
											<td>3</td>
											<td>Privacy Policy</td>
											<td>privacy-policy</td>
											<td>
											</td>
											<td>
											</td>
										</tr>
										<tr>
											<td>4</td>
											<td>Refund Policy</td>
											<td>refund-policy</td>
											<td>
											</td>
											<td>
											</td>
										</tr>										
									</tbody>
								</table>										
							</div>
							<div class="card-footer clearfix">
								<ul class="pagination pagination m-0 float-right">
								  <li class="page-item"><a class="page-link" href="#">«</a></li>
								  <li class="page-item"><a class="page-link" href="#">1</a></li>
								  <li class="page-item"><a class="page-link" href="#">2</a></li>
								  <li class="page-item"><a class="page-link" href="#">3</a></li>
								  <li class="page-item"><a class="page-link" href="#">»</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /.card -->
				</section>
				<!-- /.content -->
		
@endsection
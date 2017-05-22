@extends('layouts.master')
@section('content')

<!DOCTYPE html>
<html>
<head>
	<title>Invoice View</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/bulma.css">
	<style>		
		.pagination li{	
			padding: 5px;			        
		    border : 1px solid #54ddad;
		    display: block;			   	     
		    height:30px; 
		}
	</style>
</head>

<div class="tabs is-toggle">
  <ul>
    <li>
      <a href="{{ url('/') }}">
        <span class="icon is-small"><i class="fa fa-image"></i></span>
        <span>New INVOICE</span>
      </a>
    </li>
    <li class="is-active">
      <a href="#">
        <span class="icon is-small"><i class="fa fa-music"></i></span>
        <span>INVOICE LISTING</span>
      </a>
    </li>    
  </ul>
</div>

<body>
	<div class="container">			
		
			<form method="get" action='<?= URL::to("SearchInvoice/{{SearchInvoice}}") ?>'>					 
				 <label>Invoice Name : </label><input type="text" v-model="SearchInvoice" name="SearchInvoice" placeholder="Invoice Name">
				 <button type="submit" class="button is-primary" style='height:30px;'>Search</button>
				 <button type="button" class="button is-primary" onclick="window.location='{{ url("/") }}'" style='height:30px;float:right;'>New Invoice</button>
				 <br>
				 <br>
			</form>
		<div class="box">
			<table class="table">
				<thread>
					<tr>						
						<th>Invoice Name</th>
						<th># of Items</th>
						<th>Total</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thread>
				
				<tbody>
					<?php foreach ($invoices as $invoice) :?>
						<tr>							
							<td><a href="#">{{ $invoice->invoicename }}</a></td>
							<td>{{ $invoice->totalitem }}</td>
							<td>{{ $invoice->subtotal }}</td>
							<td><a href='{{ url("ShowInvoice/PDF/{$invoice->id}") }}'>PDF</a></td>
							<td><a href='{{ url("ShowInvoice/Edit/{$invoice->id}")}}'>Edit</a></td>
							<td><a href='{{ url("ShowInvoice/Delete/{$invoice->id}") }}'>Delete</a></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="pagination">  				
			{{ $invoices->appends(request()->input())->links() }}		
		</div>				
	</div>
</body>
</html>
@endsection
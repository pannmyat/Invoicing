@extends('layouts.master')
@section('content')

<!DOCTYPE html>
<html>
<head>	
	<title>New Invoice</title>		
</head>

<div class="tabs is-toggle">
  <ul>
    <li class="is-active">
      <a href="#">
        <span class="icon is-small"><i class="fa fa-image"></i></span>
        <span>UPDATE INVOICE</span>
      </a>
    </li>
    <li>
      <a href="{{ url('ShowInvoice') }}">
        <span class="icon is-small"><i class="fa fa-music"></i></span>
        <span>INVOICE LISTING</span>
      </a>
    </li>    
  </ul>
</div>

<body id="app">
	<div class="container">
		<form method="POST" action="{{ url('ShowInvoice/Edit') }}/@{{Invoiceno}}">
			 {{ csrf_field() }}
			 <label>Invoice Name : </label><input type="text" name="InvoiceName" placeholder="Invoice Name" v-model="Invoicename">
			 <input type="hidden" name="InvoiceNo" v-model='Invoiceno'>
			 <button type="button" class="button is-primary" onclick="window.location='{{ url("/") }}'" style='height:30px;float:right;'>New Invoice</button>
			 <br>
			 <br>
			 <div class="box">
				 <ul>			
					<li>
						<label style="padding-right:70px;">Item Name</label>
						<label style="padding-right:80px;"># of items</label>
						<label style="padding-right:120px;">Price</label>
						<label style="padding-right:0px;">Total</label>				
					</li>	
				</ul>				
				
				<ul v-show="listStatus">
					<li v-for="(key, item) in Item">
						<input type="hidden" name="id[]" v-model="item.id">					
						<input type="text" name="Item[]" v-model="item.Item" placeholder="Item Name">
						<input type="number" name="quantity[]"  v-model="item.quantity" placeholder="quantity">
						<input type="number" name="price[]" v-model="item.price" placeholder="price">
						<input type="number" name="amount[]" v-model="item.amount" placeholder="amount" value="@{{ item.quantity * item.price }}" readonly>
						<button type="button" class="button is-success" v-on:click="optionClick" style='height:30px;'>Add</button>
						<button type="button" class="button is-danger" v-on:click="removeElement(key,item.id)" style='height:30px;'>Del</button>										
					</li>
				</ul>
					
				<hr>
				<ul>					
					<li><label style="padding-left:400px;">SubTotal:</label><input type="number" name="subtotal"  placeholder="Sub Total" value='@{{ subtotal }}' readonly></li>
				 	<li><label style="padding-left:439px;">Tax:</label><input type="number" name="tax" placeholder="Tax" v-model="tax">%</li>
				 	<li><label style="padding-left:427px;">Total:</label><input type="number" name="total" placeholder="Total" value='@{{ subtotal  + ((subtotal/100)*tax) }}' readonly></li>
				 				  		 			 			  
				</ul>				
			</div>
					
			<button type="submit" class="button is-primary">Update</button>


			<!-- delete List -->
			<ul>
				<li v-for="(key, delitem) in List" style='text_decoration:none;'>
					<input type="hidden" name="delid[]" v-model="delitem.id">						
				</li>	
			</ul>			

		</form>
		<br>
		<br>		

		@include("layouts.error")
		
	</div>	
	
	<script type="text/javascript" src="{{url('/')}}/js/vue.js"></script>
	<script>
		new Vue({
		    el: '#app',
		    data: {	
		    	 List:[],		         
		         Item: {!! $items !!},
		         listResult: '',
		         tax:'{{ $Invocie[0]->tax }}',
		         Invoicename:'{{ $Invocie[0]->invoicename }}',
		         Invoiceno:'{{ $Invocie[0]->id }}',
		    },
		    computed: {		    	 	
			    listStatus: function () {
			      return (this.Item.length > 0) ? true : false; 
			    },
			    amount:function(){
			    	return this.Item.item.quantity * this.Item.item.price;
			    },
			   	subtotal: function(){
				        return this.Item.reduce(function(amount, item){
				        return amount + (item.quantity * item.price);
		          },0);
		        }		        		        
	        },			
		    methods: {
		    	optionClick: function() {
		    		this.Item.push({
		    			id:'',
		    			item: '',
		    			quantity: '',
		    			price: '',
		    			amount:'',
		    		});
		    	},

		    	removeElement: function (index,id) {
				    this.Item.splice(index, 1);
				    this.List.push({
		    			id:id,		    			
		    		});				   	   			    
				},
	    	
		    }
		})
	</script>
</body>
</html>
@endsection
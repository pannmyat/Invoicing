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
        <span>New INVOICE</span>
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
		<form method="POST" action="{{ url('CreateInvoice') }}">
			 {{ csrf_field() }}
			 <label>Invoice Name : </label><input type="text" name="InvoiceNo" placeholder="Invoice Name">
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
				<ul>			
					<li>
						<input type="text" name="Item[]" placeholder="Item Name">
						<input type="number" name="quantity[]"  v-model="quantity" placeholder="quantity">
						<input type="number" name="price[]" placeholder="price"  v-model="price">
						<input type="number" name="amount[]" placeholder="amount"  v-model="amount" value="@{{ quantity * price }}" readonly>						
						<button type="button" class="button is-success" v-on:click="optionClick" style='height:30px;'>Add</button>
						<button type="button" class="button is-danger" style='height:30px;'>Del</button>				
					</li>	
				</ul>			
				<ul v-show="listStatus">
					<li v-for="(key, item) in list">					
						<input type="text" name="Item[]" v-model="item.item" placeholder="Item Name">
						<input type="number" name="quantity[]"  v-model="item.quantity" placeholder="quantity">
						<input type="number" name="price[]" v-model="item.price" placeholder="price">
						<input type="number" name="amount[]" v-model="item.amount" placeholder="amount" value="@{{ item.quantity * item.price }}" readonly>
						<button type="button" class="button is-success" v-on:click="optionClick" style='height:30px;'>Add</button>
						<button type="button" class="button is-danger" v-on:click="removeElement(key)" style='height:30px;'>Del</button>										
					</li>
				</ul>
				<hr>
				<ul>					
					<li><label style="padding-left:400px;">SubTotal:</label><input type="number" name="subtotal"  placeholder="Sub Total" value='@{{ subtotal + (quantity * price) }}' readonly></li>
				 	<li><label style="padding-left:439px;">Tax:</label><input type="number" name="tax" placeholder="Tax" value=0 v-model="tax">%</li>
				 	<li><label style="padding-left:427px;">Total:</label><input type="number" name="total" placeholder="Total" value='@{{ subtotal + (quantity * price) + ((subtotal/100)*tax) + (((quantity * price)/100)*tax) }}' readonly></li>
				 				  		 			 			  
				</ul>				
			</div>
					
			<button type="submit" class="button is-primary">Save</button>		
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
		         list: [],
		         listResult: '',
		    },
		    computed: {
			    listStatus: function () {
			      return (this.list.length > 0) ? true : false; 
			    },
			    amount:function(){
			    	return this.list.item.quantity * this.list.item.price;
			    },
			    
				subtotal: function(){
				        return this.list.reduce(function(amount, item){
				        return amount + (item.quantity * item.price);
		          },0);
		        }
	        },			
		    methods: {
		    	optionClick: function() {
		    		this.list.push({
		    			item: '',
		    			quantity: '',
		    			price: '',
		    			amount:'',
		    		});
		    	},

		    	removeElement: function (index) {
				    this.list.splice(index, 1);
				}	    	
		    }
		})
	</script>
</body>
</html>
@endsection
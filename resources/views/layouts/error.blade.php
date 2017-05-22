<style type="text/css">
	.errors
	{
		border : 1px solid #54ddad;
		color : red;
		padding: 10px;
		border-radius: 5px;
	}
</style>
<div class="form-group">
	@if (count($errors))
		<div class ="errors">
	     	<ul>
	     		@foreach($errors->all() as $err)
	     			<li>{{ $err }}</li>
	     		@endforeach
	     	</ul>
	    </div>
	@endif
</div>

<?php

	namespace App;
	use Illuminate\Database\Eloquent\Model;
	use App\GreateInvoiceHeader;

	class CreateInvoice extends Model
	{
		protected $fillable = ['Item','quantity','price','amount','Invoiceid'];	

		public function CreateInvoiceHeader()
		{
			return $this->belongsTo(CreateInvoiceHeader::class);
		}   
	}
?>
<?php

	namespace App;
	use Illuminate\Database\Eloquent\Model;
	use App\GreateInvoice;

	class CreateInvoiceHeader extends Model
	{
	   	protected $fillable = ['invoicename','totalitem','subtotal','tax','total'];

	   	public function CreateInvoice()
		{
			return $this->hasMany(CreateInvoice::class , 'Invoiceid');
		}   
	}
?>
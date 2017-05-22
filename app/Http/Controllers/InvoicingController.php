<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\CreateInvoice;
use App\CreateInvoiceHeader;

class InvoicingController extends Controller
{
  // Create Invoice //
  public function index()
  {
    return view('CreateInvoice');
  }
  
  // Show Invoice Search //
  public function Search(Request $request)
  {    
    $invoices = CreateInvoiceHeader::Where('InvoiceName', 'like', '%' . $request->get('SearchInvoice') . '%')->orderBy('id', 'desc')->paginate(10);
     return view('ViewInvoice',compact('invoices'));
  }
  
   // Show Invoice //
  public function show()
  {
     $invoices = CreateInvoiceHeader::orderBy('id', 'desc')->paginate(10);
     return view('ViewInvoice',compact('invoices'));    
  }

   // Save Invoice //
  public function create(Request $request)
  {
 		 $this->validate($request, [
 			    'InvoiceNo' => 'required',          
          'subtotal' => 'required|numeric',
          'tax' => 'required|numeric',
          'total' => 'required|numeric',
      ]);      

      $count = 0;
      for($i = 0; $i < count($request->get('quantity')); $i++)
      {  
        if ($request->get('quantity')[$i] != null)
        {
          $count = $count + 1;
        }
      } 
      
      CreateInvoiceHeader::insert([
        'InvoiceName' => $request->get('InvoiceNo'),
        'totalitem' => $count,
        'subtotal' => $request->get('subtotal'),
        'tax' => $request->get('tax'),
        'total' => $request->get('total'),
      ]);

      $id = CreateInvoiceHeader::orderBy('id', 'desc')->first()->id;      

      for($i=0; $i<count($request->get('Item'));$i++)
      {
        if($request->get('quantity')[$i] != null)
        {          
          $data[$i]['Invoiceid'] = $id;
          $data[$i]['Item'] = $request->get('Item')[$i];
          $data[$i]['quantity'] = $request->get('quantity')[$i];
          $data[$i]['price'] = $request->get('price')[$i];
          $data[$i]['amount'] = $request->get('quantity')[$i] * $request->get('price')[$i];          
        }         		
  	   } 

      CreateInvoice::insert($data);

      return view('CreateInvoice');    
        
   }

    // Invoice Delete from Show Invoice //
   public function InvoiceDelete($id)
   {
      CreateInvoiceHeader::where('id', '=', $id)->delete(); 
      CreateInvoice::where('Invoiceid', '=', $id)->delete();            
      return redirect('ShowInvoice');
   }

   // Invoice Edit from Show Invoice //
   public function InvoiceEdit($id)
   {
      $items = CreateInvoice::where('Invoiceid', '=', $id)->get();
      $Invocie = CreateInvoiceHeader::where('id', '=', $id)->get();     
      return view('UpdateInvoice',compact('items','Invocie'));
   }

   // Invoice Update //
   public function InvoiceUpdate(Request $request,$id)
   {
      $this->validate($request, [
         'InvoiceNo' => 'required',          
          'subtotal' => 'required|numeric',
          'tax' => 'required|numeric',
          'total' => 'required|numeric',
      ]);


      // delete item //
      for($i = 0; $i < count($request->get('delid')); $i++)
      {         
          CreateInvoice::where('id', '=', $request->get('delid')[$i])->delete(); 
      }

      // Inset and Update item //
      for($i = 0; $i < count($request->get('Item')); $i++)
      { 

          if($request->get('quantity')[$i] != null)
          {            
           CreateInvoice::updateOrCreate(
                            [
                              'id' => $request->get('id')[$i],
                              'Invoiceid' => $id,
                            ],
                            ['Item' => $request->get('Item')[$i],
                              'quantity' => $request->get('quantity')[$i],
                              'price' => $request->get('price')[$i],
                              'amount' => $request->get('amount')[$i],
                            ]); 
          }    
        }      

      // Header Update //
       $count = 0;
        for($i = 0; $i < count($request->get('quantity')); $i++)
        {  
          if ($request->get('quantity')[$i] != null)
          {
            $count = $count + 1;
          }
        } 

      CreateInvoiceHeader::updateOrCreate(
                              [                               
                                'id' => $id,
                              ],
                              [ 'invoicename' => $request->get('InvoiceName'),
                                'totalitem' => $count,
                                'subtotal' => $request->get('subtotal'),
                                'tax' => $request->get('tax'),
                                'total' => $request->get('total'),
                              ]);        
      
     return redirect('ShowInvoice');
     
     
   }

   // Invoice PDF from Show Invoice //
   public function ShowPDF($id)
   {
      $items = CreateInvoice::where('Invoiceid', '=', $id)->get();    
      $Invoice = CreateInvoiceHeader::where('id', '=', $id)->get();     
      return view('PrintInvoice',compact('items','Invoice')); 
   
   }
}
?>
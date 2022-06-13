<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Dompdf\Dompdf;
use App\Http\Requests\StoreCustomerRequest;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_customers = Customer::orderBy('id', 'desc')->get();
        $customers = Customer::orderBy('id', 'desc')->paginate(3);
        
        // return $all_customers;

        return view('customers.index',compact('customers','all_customers'));
    }

    public function find(Request $request){

        $start_date = Carbon::parse($request->input('start_date'))->startOfDay();
        $end_date = Carbon::parse($request->input('end_date'))->endOfDay();
        // return $start_date;

        $all_customers = Customer::whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'desc')->get();
        $customers = Customer::whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'desc')->paginate(3);

        // return $all_customers;

        return view('customers.index',compact('customers','all_customers'));

    }


    public function downloadpdf (Request $request){
        // instantiate and use the dompdf class
        $all_payments = session('all_payments');
        $payments = $all_payments;

        // return view('payments.pdf',compact('payments','all_payments'));


        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('payments.pdf',compact('payments','all_payments')));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {

        Customer::create([
            'name' => $request->input('name'),
            'phone_no' => $request->input('phone_no'),
            'address' => $request->input('address')
        ]);

        return redirect()->route('customers.index');
       

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_no' => ['required', 'numeric', 'digits:17'],
            'address' => ['required'],
        ]);


        $customer->update([
            'name' => $request->input('name'),
            'phone_no' => $request->input('phone_no'),
            'address' => $request->input('address')
        ]);

        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer, Payment $payment)
    {
        $customer->delete();
        
        $customer->payments()->where('customer_id', $customer->id)->delete();
        return redirect()->route('customers.index');

    }

   
}

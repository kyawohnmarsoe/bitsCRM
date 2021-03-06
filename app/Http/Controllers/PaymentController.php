<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Dompdf\Dompdf;
use App\Http\Requests\StorePaymentRequest;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function today(Request $request)
    {
        // $all_payments = Payment::orderBy('id', 'desc')->with('customer')->get();
        $all_payments = Payment::whereDate('payment_date', Carbon::today())->orderBy('id', 'desc')->with('customer')->get();
        $payments = Payment::whereDate('payment_date', Carbon::today())->orderBy('id', 'desc')->with('customer')->paginate(3);

        $total = $all_payments->sum('amount');
        $request->session()->put('all_payments', $all_payments);

        return view('dashboard',compact('payments','all_payments','total'));
    }


    public function index(Request $request)
    {
        $all_payments = Payment::orderBy('id', 'desc')->with('customer')->get();
        $payments = Payment::orderBy('id', 'desc')->paginate(3);

        $request->session()->put('all_payments', $all_payments);
        
        // return session('all_payments');

        return view('payments.index',compact('payments','all_payments'));
    }

    public function find(Request $request){

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $all_payments = Payment::whereBetween('payment_date', [$start_date, $end_date])->orderBy('id', 'desc')->with('customer')->get();
        $payments = Payment::whereBetween('payment_date', [$start_date, $end_date])->orderBy('id', 'desc')->with('customer')->paginate(3);
        $request->session()->put('all_payments', $all_payments);

        // return $all_payments;

        return view('payments.index',compact('payments','all_payments'));

    }
    
    // public function find(Request $request){

    //     $start_date = Carbon::parse($request->input('start_date'))->startOfDay();
    //     $end_date = Carbon::parse($request->input('end_date'))->endOfDay();

    //     $all_payments = Payment::whereBetween('payment_date', [$start_date, $end_date])->orderBy('id', 'desc')->with('customer')->get();
    //     $payments = Payment::whereBetween('payment_date', [$start_date, $end_date])->orderBy('id', 'desc')->with('customer')->paginate(3);
    //     $request->session()->put('all_payments', $all_payments);

    //     return $all_payments;

    //     return view('payments.index',compact('payments','all_payments'));

    // }


    public function downloadpdf (){
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

    public function new($id)
    {
        $customers = [Customer::where('id', $id)->first()];
        // return $customers;
        return view('payments.create',compact('customers'));
    }


    public function create()
    {   
        $customers = Customer::orderBy('name', 'asc')->get();
        return view('payments.create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
       

        Payment::create([
            'customer_id' => $request->input('customer_id'),
            'amount' => $request->input('amount'),
            'payment_date' => $request->input('payment_date'),
            'comment' => $request->input('comment'),
            'status' => $request->input('status')
        ]);

        return redirect()->route('payments.index');
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

    public function edit(Payment $payment)
    {
        $customers = Customer::orderBy('name', 'asc')->get();
        return view('payments.edit',compact('payment','customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    { 

        
        $payment->update([
            'customer_id' => $request->input('customer_id'),
            'amount' => $request->input('amount'),
            'payment_date' => $request->input('payment_date'),
            'comment' => $request->input('comment'),
            'status' => $request->input('status')
        ]);

    return redirect()->route('payments.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index');
    }
}

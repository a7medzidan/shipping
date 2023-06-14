<?php

namespace App\Http\Controllers\Customer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function __construct()
    {
       // $this->middleware('permission:??? ??????? ??????', ['only' => ['index']]);
       // $this->middleware('permission:????? ????? ????', ['only' => ['create','store']]);
       //$this->middleware('permission:????? ????? ????', ['only' => ['edit','update']]);
       // $this->middleware('permission:??? ??????? ??????', ['only' => ['destroy']]);
    }
    public function index()
    {
     if(Auth::guard('admin')->check())
     {
        echo Auth::user(); 
        
        //echo auth()->guard('admin')->user()->name;
     }
    
    elseif(Auth::guard('customer')->check())
    {
      //  echo Auth::user();
        echo Auth::guard('customer')->user()->email; 
        
    }else{
        echo "hello";
    }
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('customers.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $data = $request->validate([
            'email' => 'required|email|exists:customers',
            'password' => 'required|min:6'
        ]);
        
        if (customer()->attempt($data))
        
            return response()->json(200);
            return response()->json(405);
           // print_r(customer()->attempt($data));
        
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogActivityTrait;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DeliveryConvertedOrderController extends Controller
{
    use LogActivityTrait;


    function __construct()
    {
       $this->middleware('permission:عرض الطلبات', ['only' => ['index']]);
       $this->middleware('permission:العمليات علي الطلبات', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {

        if ($request->ajax()) {
            $admins = Order::query()->with(['province', 'trader', 'delivery'])->where('status', 'converted_to_delivery')->orderBy('updated_at', 'desc');
            return DataTables::of($admins)
                ->addColumn('action', function ($row) {

                    $edit = '';
                    $delete = '';

                    if(!auth()->user()->can('العمليات علي الطلبات'))
                        $edit='hidden';
                    if(!auth()->user()->can('العمليات علي الطلبات'))
                        $delete='hidden';


                    return '

                            <button ' . $delete . '  class="btn rounded-pill btn-danger waves-effect waves-light delete"
                                    data-id="' . $row->id . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </span>
                            </button>
                       ';


                })

                ->editColumn('province_id', function ($row) {
                    return $row->province->title ?? '';
                })

                ->editColumn('status', function ($row) {

                    $status='';
                    if(!auth()->user()->can('العمليات علي الطلبات'))
                        $status='hidden';


                    return "<button $status  data-id='$row->id' class='btn btn-success changeStatusData'>تغير حالة الطلب</button>";



//                    $option1 = '';
//                    $option2 = '';
//                    $option3 = '';
//                    $option4 = '';
//                    if ($row->status == 'converted_to_delivery')
//                        $option1 = 'selected';
//                    elseif ($row->status == 'total_delivery_to_customer')
//                        $option2 = 'selected';
//                    elseif ($row->status == 'partial_delivery_to_customer')
//                        $option3 = 'selected';
//                    elseif ($row->status == 'not_delivery') {
//                        $option4 = 'selected';
//                    } else {
//
//                    }
//                    $status = "<select name='status' data-id='$row->id' class='form-control changeStatus'>
//                       <option selected disabled> اختر  الحالة</option>
//                       <option $option1 value='converted_to_delivery'>تم التحويل التاجر  </option>
//                       <option $option2 value='total_delivery_to_customer'>تم التسليم الكلي للعميل </option>
//                       <option $option3 value='partial_delivery_to_customer'>  تم التسليم الجزئي للعميل  </option>
//                       <option $option4 value='not_delivery'>  لم يتم التسليم </option>
//
//                     </select>";
//
//                    return $status;

                })

                ->editColumn('trader_id', function ($row) {
                    return $row->trader->name ?? '';
                })
                ->editColumn('created_at', function ($admin) {
                    return date('Y/m/d', strtotime($admin->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        } else {
            $this->add_log_activity(null, auth('admin')->user(), "تم عرض  الطلبات المحولة للمناديب");

        }
        return view('Admin.CRUDS.Orders.deliveryConvertedOrders.index');
    }


    public function create(Request $request)
    {
        $status=$request->status;
        $order=Order::findOrFail($request->id);

        return view('Admin.CRUDS.Orders.deliveryConvertedOrders.parts.reason',compact('order','status'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status'=>'required',
            'refused_reason'=>'required',

        ]);

        $order=Order::findOrFail($request->order_id);
        $old=$order;

        $order->update([
            'status'=>$request->status,
            'refused_reason'=>$request->refused_reason,
        ]);

        $this->add_log_activity($old,auth('admin')->user(),"  تم تعديل حالة طلب برقم $order->id ");


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }


    public function destroy( $id)
    {
        $order=Order::findOrFail($id);
        $old = $order;
        $order->delete();

        $this->add_log_activity($old, auth('admin')->user(), " تم   حذف بيانات الطلب    $old->id ");


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }//end fun


    public function changeStatusForOrder($id){
        $order=Order::findOrFail($id);

        return view('Admin.CRUDS.Orders.deliveryConvertedOrders.parts.status',compact('order'));

    }

    public function changeStatusForOrder_store(Request $request,$id){
        $order=Order::findOrFail($id);

        $data = $request->validate([
            'status' => 'required|in:not_delivery,partial_delivery_to_customer,total_delivery_to_customer',
            'refused_reason'=>'nullable',

        ]);
        $order->update($data);

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
            ]);


    }

}

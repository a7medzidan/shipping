<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogActivityTrait;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NotDeliveryOrderController extends Controller
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
            $admins = Order::query()->with(['province', 'trader', 'delivery'])->where('status', 'not_delivery')->orderBy('updated_at', 'desc');
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

                ->editColumn('address', function ($data) {
                    $link = "https://www.google.com/maps/search/?api=1&query=".$data->latitude.",".$data->longitude;
                    return '<a target="_blank" class="btn btn-pill btn-info" href="'.$link.'"> عرض <i class="fa fa-map-marker-alt text-white"></i>  </a>';
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
            $this->add_log_activity(null, auth('admin')->user(), "تم عرض  الطلبات    الغير مسلمة");

        }
        return view('Admin.CRUDS.Orders.notDeliveryOrders.index');
    }

    public function destroy($id )
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
}

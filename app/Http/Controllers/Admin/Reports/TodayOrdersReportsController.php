<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogActivityTrait;
use App\Models\Order;
use App\Models\Trader;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TodayOrdersReportsController extends Controller
{
    use LogActivityTrait;

    function __construct()
    {
        $this->middleware('permission:عرض التقارير', ['only' => ['index']]);
    }


    public function index(Request $request)
    {

        $traders=Trader::get();

        $shipment_pieces_number=0;

        if ($request->ajax()) {
            $start=date('Y-m-d').' '.'00:00:00';
            $end=date('Y-m-d').' '.'23:59:59';

            $rows = Order::query()->latest()->where('delivery_time','>=',$start)->where('delivery_time','<=',$end)->with(['province','trader','delivery']);




            $dataTable= DataTables::of($rows)



                ->editColumn('province_id', function ($row) {
                    return $row->province->title??'';
                })


                ->editColumn('delivery_id', function ($row) {
                    return $row->delivery->name??'';
                })
                ->addColumn('orderDetails', function ($row) {
                    $url=route('admin.orderDetails',$row->id);
                    return "<a href='$url' class='btn btn-outline-dark'>تفاصيل الطلب</a>";
                })


                ->editColumn('status', function ($row) {

                    $status='';
                    if ($row->status=='new')
                        $status= 'طلب جديد';
                    elseif ($row->status=='converted_to_delivery')
                        $status='طلب محول الي المندوب';
                    elseif ($row->status=='total_delivery_to_customer')
                        $status='طلب مسلم كليا';
                    elseif ($row->status=='partial_delivery_to_customer')
                        $status='طلب مسلم جزئيا';
                    elseif ($row->status=='not_delivery')
                        $status='طلب لم يسلم';
                    else
                        $status='لم يحدد';

                    return $status;

                })

                ->editColumn('address', function ($data) {
                    $link = "https://www.google.com/maps/search/?api=1&query=".$data->latitude.",".$data->longitude;
                    return '<a target="_blank" class="btn btn-pill btn-info" href="'.$link.'"> عرض <i class="fa fa-map-marker-alt text-white"></i>  </a>';
                })
                ->editColumn('trader_id', function ($row) {
                    return  $row->trader->name??'';
                })




                ->editColumn('created_at', function ($admin) {
                    return date('Y/m/d', strtotime($admin->created_at));
                })
                ->escapeColumns([])
                ->make(true);


            return  $dataTable ;

        }
        else{
            $this->add_log_activity(null, auth('admin')->user(), "تم عرض  تقارير يومية الطلبات  ");

        }

        return view('Admin.reports.todayOrders.index',compact('request','traders','shipment_pieces_number'));

    }

}

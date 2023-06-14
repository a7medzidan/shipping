@extends('Admin.layouts.inc.app')
@section('title')
    تقارير يومية الطلبات
@endsection
@section('css')
@endsection
@section('content')


    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1">   تقارير يومية الطلبات</h5>


        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                   style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>الحالة</th>
                    <th>المندوب</th>
                    <th>اسم العميل</th>
                    <th>المحافظة</th>
                    <th>عنوان العميل</th>
                    <th>رقم تليفون العميل</th>
                    <th>وقت التسليم</th>
                    <th>التاجر</th>
                    <th>عدد القطع داخل الشحنة</th>
                    <th>قيمة الشحنة</th>
                    <th>قيمة التوصيل</th>
                    <th>نسبة المندوب</th>
                    <th>الاجمالي</th>
                    <th>  تفاصيل الطلب</th>
                </tr>
                </thead>

            </table>
        </div>
    </div>


@endsection
@section('js')
    <script>
        var columns = [
            {data: 'id', name: 'id'},
            {data: 'status', name: 'status'},
            {data: 'delivery_id', name: 'delivery_id'},
            {data: 'customer_name', name: 'customer_name'},
            {data: 'province.title', name: 'province.title'},
            {data: 'customer_address', name: 'customer_address'},
            {data: 'customer_phone', name: 'customer_phone'},
            {data: 'delivery_time', name: 'delivery_time'},
            {data: 'trader.name', name: 'trader.name'},
            {data: 'shipment_pieces_number', name: 'shipment_pieces_number'},
            {data: 'shipment_value', name: 'shipment_value'},
            {data: 'delivery_value', name: 'delivery_value'},
            {data: 'delivery_ratio', name: 'delivery_ratio'},
            {data: 'total_value', name: 'total_value'},
            {data: 'orderDetails', name: 'orderDetails'},
        ];
    </script>
    @include('Admin.layouts.inc.ajax',['url'=>'todayOrdersReports'])


@endsection

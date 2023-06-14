@extends('Admin.layouts.inc.app')
@section('title')
    تقارير التجار
@endsection
@section('css')
@endsection
@section('content')

    <form action="{{route('tradersReports.index')}}">

        <div class="row mb-3">
            <div class="col-md-2 ">
                <label for="fromDate" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                    <span class="required mr-1"> تاريخ البداية    </span>

                </label>
                <input type="date" id="fromDate" @isset($request['fromDate']) value="{{$request['fromDate']}}"
                       @endisset name="fromDate"
                       class="showBonds form-control">

            </div>
            <div class="col-md-2">
                <label for="toDate" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                    <span class="required mr-1">   تاريخ النهاية    </span>

                </label>
                <input type="date" id="toDate" @isset($request['toDate']) value="{{$request['toDate']}}"
                       @endisset name="toDate"
                       class="showBonds form-control">
            </div>
            <div class="col-md-2">
                <label for="trader_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                    <span class="required mr-1">     التاجر    </span>

                </label>

                <select id="trader_id" class="form-control showBonds" name="trader_id">
                    <option selected disabled>اختر</option>
                    @foreach($traders as $trader)
                        <option @isset($request['trader_id']) @if($request['trader_id']==$trader->id) selected
                                @endif   @endisset value="{{$trader->id}}">{{$trader->name}}</option>
                    @endforeach
                </select>


            </div>

            <div class="col-md-2">
                <label for="order_status" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                    <span class="required mr-1">     الحالة    </span>

                </label>

                <select id="order_status" class="form-control showBonds" name="status">
                    <option selected disabled>اختر</option>
                    <option @isset($request['status']) @if($request['status']=='new') selected
                            @endif   @endisset value="new">جديد
                    </option>
                    <option @isset($request['status']) @if($request['status']=='converted_to_delivery') selected
                            @endif   @endisset value="converted_to_delivery">محول الي مندوب
                    </option>
                    <option @isset($request['status']) @if($request['status']=='total_delivery_to_customer') selected
                            @endif   @endisset value="total_delivery_to_customer">مسلم كليا
                    </option>
                    <option @isset($request['status']) @if($request['status']=='partial_delivery_to_customer') selected
                            @endif   @endisset value="partial_delivery_to_customer">مسلم جزئيا
                    </option>
                    <option @isset($request['status']) @if($request['status']=='not_delivery') selected
                            @endif   @endisset value="not_delivery">لم يسلم
                    </option>

                </select>


            </div>
            <div class="col-md-2">
                <button class="btn btn-primary my-4">بحث</button>
            </div>
        </div>

    </form>

    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1"> تقارير التجار</h5>


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
                    <th> تفاصيل الطلب</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>المجموع</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>   {{$shipment_pieces_number}}</th>
                    <th>{{$shipment_value}}</th>
                    <th>{{$delivery_value}}</th>
                    <th>{{$delivery_ratio_val}}</th>
                    <th>{{$total_value}}</th>
                    <th></th>
                    <th></th>
                </tr>
                </tfoot>
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
    @include('Admin.layouts.inc.ajax',['url'=>'tradersReports'])

    <script>

        $(document).on('change', '.showBonds', function () {
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var trader_id = $('#trader_id').val();
            var status = $('#order_status').val();

            var url = "{{route('tradersReports.index')}}";
            url = url + "?-=-";
            if (fromDate != null) {
                url = url + "&&fromDate=" + fromDate;
            }
            if (toDate != null) {
                url = url + "&&toDate=" + toDate;
            }
            if (trader_id != null) {
                url = url + "&&trader_id=" + trader_id;
            }
            if (status != null) {
                url = url + "&&status=" + status;
            }
            // window.location.href = url;
        })
    </script>

@endsection

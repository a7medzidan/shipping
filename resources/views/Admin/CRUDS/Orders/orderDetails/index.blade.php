@extends('Admin.layouts.inc.app')
@section('title')
     تفاصيل الطلب
@endsection
@section('css')
@endsection
@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1">  تفاصيل الطلب</h5>



        </div>


    </div>


    <div class="row g-4">


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="trader_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">التاجر</span>
            </label>
            <!--end::Label-->
            <select disabled class="form-control" name="trader_id" id="trader_id">
                <option selected disabled>اختر التاجر</option>
                @foreach($traders as $trader)
                    <option @if($order->trader_id == $trader->id) selected  @endif value="{{$trader->id}}">{{$trader->name}}</option>
                @endforeach
            </select>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="province_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">المحافظة</span>
            </label>
            <!--end::Label-->
            <select disabled class="form-control" name="province_id" id="province_id">
                <option selected disabled>اختر المحافظة</option>
                @foreach($provinces as $province)
                    <option @if($order->province_id==$province->id) selected  @endif value="{{$province->id}}">{{$province->title}}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="customer_name" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">اسم العميل</span>
            </label>
            <!--end::Label-->
            <input disabled type="text" id="customer_name" name="customer_name" class="form-control" value="{{$order->customer_name}}">
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="customer_phone" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">هاتف العميل</span>
            </label>
            <!--end::Label-->
            <input disabled type="number" id="customer_phone" name="customer_phone" class="form-control" value="{{$order->customer_phone}}">
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="delivery_time" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> وقت التسليم</span>
            </label>
            <!--end::Label-->
            <input disabled type="datetime-local" id="delivery_time" name="delivery_time" class="form-control" value="{{$order->delivery_time}}">
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="shipment_pieces_number" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> عدد القطع داخل الشحنة</span>
            </label>
            <!--end::Label-->
            <input disabled type="number" min="1" id="shipment_pieces_number" name="shipment_pieces_number" class="form-control" value="{{$order->shipment_pieces_number}}">
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="shipment_value" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">    قيمة الشحنة</span>
            </label>
            <!--end::Label-->
            <input disabled type="number" min="0" id="shipment_value" name="shipment_value" class="form-control" value="{{$order->shipment_value}}">
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="delivery_value" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">    قيمة التوصيل</span>
            </label>
            <!--end::Label-->
            <input disabled type="number" min="0" id="delivery_value" name="delivery_value" class="form-control" value="{{$order->delivery_value}}">
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="delivery_ratio" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">     نسبة المندوب</span>
            </label>
            <!--end::Label-->
            <input disabled type="number" min="0" max="100" id="delivery_ratio" name="delivery_ratio" class="form-control" value="{{$order->delivery_ratio}}">
        </div>



        <div class="d-flex flex-column mb-7 fv-row col-sm-12">
            <!--begin::Label-->
            <label for="customer_address" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">عنوان العميل</span>
            </label>
            <textarea disabled  name="customer_address" id="customer_address" rows="5" class="form-control"
                       placeholder=" اكتب هنا ">{{$order->customer_address}}</textarea>
        </div>




    </div>


    <div class="row g-4" id="details-container">

        @foreach(\App\Models\OrderDetails::where('order_id',$order->id)->get() as $details)

            <div id="{{$details->id}}" class="d-flex justify-content-between">

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 mt-2">
                    <!--begin::Label-->
                    <label for="product_name-{{$details->id}}" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1">اسم المنتج</span>
                    </label>
                    <!--end::Label-->
                    <input disabled id="product_name-{{$details->id}}" required type="text" class="form-control form-control-solid" placeholder=" " name="product_name[]" value="{{$details->product_name}}"/>
                </div>


                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 mt-2">
                    <!--begin::Label-->
                    <label for="count-{{$details->id}}" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1"> الكمية</span>
                    </label>
                    <!--end::Label-->
                    <input disabled id="count-{{$details->id}}" required type="number" class="form-control form-control-solid" placeholder=" " name="count[]" value="{{$details->count}}"/>
                </div>


                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 mt-2">
                    <!--begin::Label-->
                    <label for="weight-{{$details->id}}" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1"> الوزن </span>
                    </label>
                    <!--end::Label-->
                    <input disabled id="weight-{{$details->id}}" required type="number" class="form-control form-control-solid" placeholder=" " name="weight[]" value="{{$details->weight}}"/>
                </div>






                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-2 mt-2">
                    <!--begin::Label-->
                    <label for="details-{{$details->id}}" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required mr-1"> التفاصيل</span>
                    </label>
                    <!--end::Label-->
                    <input disabled id="details-{{$details->id}}" required type="text" class="form-control form-control-solid" placeholder=" " name="details[]" value="{{$details->details}}"/>
                </div>




{{--                <div style="cursor: pointer" data-id="{{$details->id}}" class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-2 mt-2 deleteRow">--}}

{{--                    x--}}

{{--                </div>--}}

            </div>



        @endforeach

    </div>
        <!--end::Modal dialog-->

@endsection
@section('js')


@endsection

@extends('Admin.layouts.inc.app')
@section('title')
     الطلبات
@endsection
@section('css')
@endsection
@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1">  الطلبات</h5>

                <div>
                    <a href="{{route('orders.create')}}"  class="btn btn-primary">اضافة طلب</a>
                </div>

        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                   style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
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
                    <th> تاريخ الانشاء</th>
                    <th>العمليات</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-fullscreen mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content" id="modalContent">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2><span id="operationType"></span> طلب </h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <button class="btn btn-sm btn-icon btn-active-color-primary" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                    <!--end::Close-->
                </div>
                <!--begin::Modal body-->
                <div class="modal-body py-4" id="form-load">

                </div>
                <!--end::Modal body-->
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="reset" data-bs-dismiss="modal" aria-label="Close" class="btn btn-light me-2">
                            الغاء
                        </button>
                        <button form="form" type="submit" id="submit" class="btn btn-primary">
                            <span class="indicator-label">اتمام</span>
                        </button>
                    </div>
                </div>
            </div>

            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>


    <div class="modal fade" id="Modal-delivery" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-lg mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content" id="modalContent-delivery">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2> التسليم الي المندوب </h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <button class="btn btn-sm btn-icon btn-active-color-primary" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                    <!--end::Close-->
                </div>
                <!--begin::Modal body-->
                <div class="modal-body py-4" id="form-load-delivery">

                </div>
                <!--end::Modal body-->
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="reset" data-bs-dismiss="modal" aria-label="Close" class="btn btn-light me-2">
                            الغاء
                        </button>
                        <button form="form-delivery" type="submit" id="submit-delivery" class="btn btn-primary">
                            <span class="indicator-label">اتمام</span>
                        </button>
                    </div>
                </div>
            </div>

            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
@endsection
@section('js')
    <script>
        var columns = [
            {data: 'id', name: 'id'},
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
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
    </script>
    @include('Admin.layouts.inc.ajax',['url'=>'orders'])

    <script>
        $(document).on('click','#addDetails',function (e){

            e.preventDefault();

            $.ajax({
                type: 'GET',
                url: "{{route('admin.getOrderDetails')}}",

                success: function (res) {

                    $('#details-container').append(res.html);

                },
                error: function (data) {
                    // location.reload();
                }
            });



        })


        $(document).on('click','.deleteRow',function (){
            var id=$(this).attr('data-id');

            $(`#${id}`).remove();


        })
    </script>

    <script>
        $(document).on('change','.changeDelivery',function (){
            var id=$(this).attr('data-id');
            var delivery_id=$(this).val();

            $.ajax({
                type: 'GET',
                url: "{{route('admin.changeDelivery')}}",
                data:{
                    id:id,
                    delivery_id:delivery_id,
                },

                success: function (res) {

                    toastr.success('تمت العملية بنجاح');


                    $('#table').DataTable().ajax.reload(null, false);


                },
                error: function (data) {
                    // location.reload();
                }
            });

        })
    </script>

    <script>
        $(document).on('click','.insertDelivery',function (){
            var id=$(this).attr('data-id');

            var route="{{route('admin.getDeliveryForOrder',':id')}}";

            route=route.replace(':id',id);

            $('#form-load-delivery').html(loader_form)

            $('#Modal-delivery').modal('show')

            setTimeout(function (){
                $('#form-load-delivery').load(route)
            },1000)
        })
    </script>
    <script>
        $(document).on('submit',"#form-delivery",function (e) {
            e.preventDefault();

            var id=$('#order_id_delivery').val();

            var route="{{route('admin.insertingDeliveryForOrder',':id')}}";
            route=route.replace(':id',id);

            var formData = new FormData(this);

            var url = $('#form-delivery > form').attr('action');
           $.ajax({
                url: route,
                type: 'POST',
                data: formData,
                beforeSend: function () {


                    $('#submit-delivery').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                        ' ></span> <span style="margin-left: 4px;">{{trans('admin.working')}}</span>').attr('disabled', true);
                    $('#form-load-delivery').append(loader_form)
                    $('#form-load-delivery > form').hide()
                },
                complete: function () {
                },
                success: function (data) {

                    window.setTimeout(function () {
                        $('#submit-delivery').html('{{trans('admin.submit')}}').attr('disabled', false);

                        if (data.code == 200) {
                            toastr.success(data.message)
                            $('#Modal-delivery').modal('hide')
                            $('#form-load-delivery > form').remove()
                            $('#table').DataTable().ajax.reload(null, false);
                        }else {
                            $('#form-load-delivery > .linear-background').hide(loader_form)
                            $('#form-load-delivery > form').show()
                            toastr.error(data.message)
                        }
                    }, 1000);



                },
                error: function (data) {
                    $('#form-load-delivery > .linear-background').hide(loader_form)
                    $('#submit-delivery').html('{{trans('admin.submit')}}').attr('disabled', false);
                    $('#form-load-delivery > form').show()
                    if (data.status === 500) {
                        toastr.error('{{trans('admin.error')}}')
                    }
                    if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);

                        $.each(errors, function (key, value) {
                            if ($.isPlainObject(value)) {
                                $.each(value, function (key, value) {
                                    toastr.error(value)
                                });

                            } else {

                            }
                        });
                    }
                    if (data.status == 421){
                        toastr.error(data.message)
                    }

                },//end error method

                cache: false,
                contentType: false,
                processData: false
            });
        });

    </script>

@endsection

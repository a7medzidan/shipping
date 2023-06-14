@extends('Admin.layouts.inc.app')
@section('title')
    اضافة طلب
@endsection
@section('css')

    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet"/>
    <style>

        .my-div {
            position: relative;
        }

        .my-div i {
            position: absolute;
            top: 10px; /* adjust as needed */
            right: 10px; /* adjust as needed */
        }
    </style>
@endsection

@section('page-title')
    اضافة طلب
@endsection



@section('content')

    <div class="card">
        <div class="card-header ">



            <form id="form" enctype="multipart/form-data" method="POST" action="{{route('repository.update',$user->id)}}">
                @csrf
               
                @method('PUT')

                <div id="container-data">
                <div id="tr-1" class="card mt-2 my-div">
                    <i data-id="1" style="color: red" class="fas fa-trash deleteRow"></i> <!-- Font Awesome user icon -->

                    <div class="card-body">
                      






                           





                          

                            <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                                <!--begin::Label-->
                                <label for="customer_name-1"
                                       class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                    <span class="required mr-1">الاسم</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" value="{{$user->customer_name}}" id="customer_name-1" name="customer_name" class="form-control"
                                       value="">
                            </div>


                            <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                                <!--begin::Label-->
                                <label for="shipment_pieces_number-1"
                                       class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                    <span class="required mr-1"> العمر</span>
                                </label>
                                <!--end::Label-->
                                <input type="number" min="1" required="" value="{{$user->age}}" id="shipment_pieces_number-1" name="age"
                                       class="form-control" value="">
                            </div>

                            <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                                <!--begin::Label-->
                                <label for="shipment_value-1"
                                       class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                    <span class="required mr-1">     الخبره</span>
                                </label>
                                <!--end::Label-->
                                <input type="number" min="0" required="" id="shipment_value-1" name="experience"
                                       class="form-control" value="{{$user->experience}}">
                            </div>


                            <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                                <!--begin::Label-->
                                <label for="delivery_value-1"
                                       class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                    <span class="required mr-1">   الدرجه</span>
                                </label>
                                <!--end::Label-->
                                <input type="number" min="0"  required="" id="delivery_value-1" name="degree"
                                       class="form-control" value="{{$user->degree}}">
                            </div>


                           






                <div class="my-4">
                    <button type="submit" id="submit" class="btn btn-success"> حفظ</button>
                </div>
            </form>


        </div>
    </div>

@endsection

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>





    <script>
        var loader_form = ` <div class="linear-background">
                            <div class="inter-crop"></div>
                            <div class="inter-right--top"></div>
                            <div class="inter-right--bottom"></div>
                        </div>
        `;

    </script>
    <script>
        $(document).on('submit', "form#form2", function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            var url = $('#form').attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                beforeSend: function () {


                    $('#submit').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                        ' ></span> <span style="margin-left: 4px;">{{trans('admin.working')}}</span>').attr('disabled', true);

                },

                complete: function () {
                },
                success: function (data) {

                    window.setTimeout(function () {

// $('#product-model').modal('hide')
                        if (data.code == 200) {
                            toastr.success(data.message)
                            setTimeout(reloading, 1000);
                        } else {
                            toastr.error(data.message)
                            $('#submit').html('{{trans('admin.submit')}}').attr('disabled', false);

                        }
                    }, 1000);


                },
                error: function (data) {
                    $('#submit').html('{{trans('admin.submit')}}').attr('disabled', false);

                    if (data.status === 500) {
                        toastr.error('there is an error')

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
                    if (data.status == 421) {
                        toastr.error(data.message)

                    }

                },//end error method

                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>

    <script>
        $(document).on('click','.deleteRow',function (){
            var id=$(this).attr('data-id');
            $(`#tr-${id}`).remove();
        })
    </script>
    <script>
        $(document).on('click','#addNewOrderBtn',function (e){
            e.preventDefault();
            let x = Math.floor((Math.random() * 9999999999999999) + 1);

            var order=`
                            <div id="tr-${x}" class="card mt-2 my-div">
                    <i data-id="${x}" style="color: red" class="fas fa-trash deleteRow"></i> <!-- Font Awesome user icon -->

                    <div class="card-body">
                        <div class="row  g-4">

        {{--                    <div class="d-flex flex-column mb-7 fv-row col-sm-2">--}}
        {{--                        <!--begin::Label-->--}}
        {{--                        <label for="delivery_id-${x}" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">--}}
        {{--                            <span class="required mr-1">المندوب</span>--}}
        {{--                        </label>--}}
        {{--                        <!--end::Label-->--}}
        {{--                        <select class="form-control" name="delivery_id[]" id="delivery_id-${x}">--}}
        {{--                            <option selected ></option>--}}
        {{--                            @foreach($delivers as $delivery)--}}
        {{--    <option value="{{$delivery->id}}">{{$delivery->name}}</option>--}}
        {{--                            @endforeach--}}
        {{--    </select>--}}
        {{--</div>  --}}

                  <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                                <!--begin::Label-->
                                <label for="delivery_id-${x}" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                    <span class="required mr-1">   المندوب</span>
                                </label>
                                <select id='delivery_id-${x}' name="delivery_id[]" style='width: 200px;'>
                                    <option selected value="0">- ابحث عن مندوب</option>
                                </select>
                            </div>




{{--        <div class="d-flex flex-column mb-7 fv-row col-sm-3">--}}
{{--            <!--begin::Label-->--}}
{{--            <label for="province_id-${x}" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">--}}
{{--                <span class="required mr-1">المحافظة</span>--}}
{{--            </label>--}}
{{--            <!--end::Label-->--}}
{{--            <select class="form-control" name="province_id[]" id="province_id-${x}">--}}
{{--                <option selected ></option>--}}
{{--@foreach($provinces as $province)--}}
{{--            <option value="{{$province->id}}">{{$province->title}}</option>--}}
{{--                                    @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}



            <div class="d-flex flex-column mb-7 fv-row col-sm-3">
                <!--begin::Label-->
                <label for="province_id-${x}" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                    <span class="required mr-1">   المدن</span>
                </label>
                <select id='province_id-${x}' name="province_id[]" style='width: 200px;'>
                    <option selected disabled>- ابحث عن مدينة</option>
                </select>
            </div>





<div class="d-flex flex-column mb-7 fv-row col-sm-3">
<!--begin::Label-->
<label for="customer_phone-${x}"
                   class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">هاتف العميل</span>
            </label>
            <!--end::Label-->
            <input type="number" id="customer_phone-${x}" name="customer_phone[]" class="form-control"
                   value="">
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-3">
            <!--begin::Label-->
            <label for="delivery_time-${x}"
                   class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> وقت التسليم</span>
            </label>
            <!--end::Label-->
            <input type="datetime-local" id="delivery_time-${x}" name="delivery_time[]"
                   class="form-control" value="">
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-3">
            <!--begin::Label-->
            <label for="customer_name-${x}"
                   class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">اسم العميل</span>
            </label>
            <!--end::Label-->
            <input type="text" id="customer_name-${x}" name="customer_name[]" class="form-control"
                   value="">
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-3">
            <!--begin::Label-->
            <label for="shipment_pieces_number-${x}"
                   class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> عدد القطع داخل الشحنة</span>
            </label>
            <!--end::Label-->
            <input type="number" min="1" id="shipment_pieces_number-${x}" name="shipment_pieces_number[]"
                   class="form-control" value="">
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-3">
            <!--begin::Label-->
            <label for="shipment_value-${x}"
                   class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">    قيمة الشحنة</span>
            </label>
            <!--end::Label-->
            <input type="number" min="0" id="shipment_value-${x}" name="shipment_value[]"
                   class="form-control" value="">
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-3">
            <!--begin::Label-->
            <label for="delivery_value-${x}"
                   class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">    قيمة التوصيل</span>
            </label>
            <!--end::Label-->
            <input type="number" min="0" id="delivery_value-${x}" name="delivery_value[]"
                   class="form-control" value="">
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-3">
            <!--begin::Label-->
            <label for="delivery_ratio-${x}"
                   class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">     نسبة المندوب</span>
            </label>
            <!--end::Label-->
            <input type="number" min="0" max="100" id="delivery_ratio-${x}" name="delivery_ratio[]"
                   class="form-control" value="">
        </div>




        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="customer_address-${x}"
                   class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> عنوان العميل</span>
            </label>
            <!--end::Label-->
            <input type="text" id="customer_address-${x}" name="customer_address[]" class="form-control"
                   value="">
        </div>




    </div>
</div>
</div>

`;

            $(document).find('#container-data').append(order);
            $("html, body").animate({ scrollTop: $(document).height() }, 1000);

            loadScript(x);
        })
    </script>

    <script>
        function reloading(){
            var route="{{route('orders.index')}}";
            window.location.href=route;
        }
    </script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

        (function () {

            $("#trader_id").select2({
                placeholder: 'Channel...',
                // width: '350px',
                allowClear: true,
                ajax: {
                    url: '{{route('admin.getTraders')}}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                    cache: true
                }
            });
        })();

    </script>





    <script>

        (function () {

            $("#delivery_id").select2({
                placeholder: 'Channel...',
                // width: '350px',
                allowClear: true,
                ajax: {
                    url: '{{route('admin.getDeliveries')}}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                    cache: true
                }
            });
        })();

    </script>


    <script>

        (function () {

            $("#province_id").select2({
                placeholder: 'Channel...',
                // width: '350px',
                allowClear: true,
                ajax: {
                    url: '{{route('admin.getGovernorates')}}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                    cache: true
                }
            });
        })();

    </script>


    <script>
        function loadScript(id) {
            $(`#province_id-${id}`).select2({
                placeholder: 'searching For Supplier...',
                // width: '350px',
                allowClear: true,
                ajax: {
                    url: '{{route('admin.getGovernorates')}}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                    cache: true
                }
            });



            $(`#delivery_id-${id}`).select2({
                placeholder: 'searching For Supplier...',
                // width: '350px',
                allowClear: true,
                ajax: {
                    url: '{{route('admin.getDeliveries')}}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                    cache: true
                }
            });

        }
    </script>


@endsection

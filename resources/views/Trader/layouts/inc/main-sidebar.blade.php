<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <!-- App Search-->
            <ul class="metismenu list-unstyled">
                <li> <form class="app-search d-none d-lg-block">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="position-relative">
                            <input type="text" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="ابحث هنا ..." onchange="SearchP($(this))">
                            <span class="fa fa-search"></span>
                        </div>
                    </form></li>
            </ul>
            <ul class="metismenu list-unstyled " id="side-menu">

                <!-- <div id="SearchArea">-->
{{--              @can('عرض الرئيسية')--}}
                <li>
                    <a href="{{ route('trader.index') }}" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>الرئيسية</span>
                    </a>
                </li>

{{--                <li>--}}
{{--                    <a href="{{ route('myOrders.index') }}" class="waves-effect">--}}
{{--                        <i class="fas fa-shipping-fast"></i>--}}
{{--                        <span>طلباتي</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @endcan--}}




                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-shipping-fast"></i>
                        <span>  طلباتي </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('myOrders.index')}}?status=new"><i class="mdi mdi-album"></i>
                                <span> الطلبات الجديدة</span></a></li>
                        <li><a href="{{route('myOrders.index')}}?status=converted_to_delivery"><i class="mdi mdi-album"></i>
                                <span>    الطلبات المحولة  للمناديب </span></a></li>
                        <li><a href="{{route('myOrders.index')}}?status=total_delivery_to_customer"><i class="mdi mdi-album"></i> <span>   طلبات مسلمة كليا </span></a>
                        </li>
                        <li><a href="{{route('myOrders.index')}}?status=partial_delivery_to_customer"><i class="mdi mdi-album"></i> <span>   طلبات مسلمة جزئيا </span></a>
                        </li>
                        <li><a href="{{route('myOrders.index')}}?status=not_delivery"><i class="mdi mdi-album"></i> <span>   طلبات  غير مسلمة  </span></a>
                        </li>


                    </ul>
                </li>


                <!--</div>-->
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

<script>
    function myFunction() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("side-menu");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>

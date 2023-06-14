<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <!-- App Search-->
            <ul class="metismenu list-unstyled">
                <li>
                    <form class="app-search d-none d-lg-block">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="position-relative">
                            <input type="text" id="myInput" onkeyup="myFunction()" class="form-control"
                                   placeholder="ابحث هنا ..." onchange="SearchP($(this))">
                            <span class="fa fa-search"></span>
                        </div>
                    </form>
                </li>
            </ul>
            <ul class="metismenu list-unstyled " id="side-menu">

                <!-- <div id="SearchArea">-->
                {{--              @can('عرض الرئيسية')--}}
                <li>
                    <a href="{{ route('admin.index') }}" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>الرئيسية</span>
                    </a>
                </li>
                {{--                @endcan--}}
                
                {{--              @can('عرض الرئيسية')--}}

                    <li>
                        <a href="{{ route('admins.index') }}" class="waves-effect">
                            <i class="mdi mdi-ufo"></i>
                            <span>المستخدمين</span>
                        </a>
                    </li>
                    
                    {{--                @endcan--}}
                    
                     {{--              @can('عرض الرئيسية')--}}
               
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('roles.index')}}">
                        <i class="fa fa-tasks"></i>
                        <span>الادوار</span>
                    </a>
                </li>
                {{--                @endcan--}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('categories.index')}}">
                            <i class="fa fa-list"></i>
                            <span>تصنيفات التجار</span>
                        </a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('delivers.index')}}">
                            <i class="fa fa-shipping-fast"></i>
                            <span>المناديب</span>
                        </a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('traders.index')}}">
                            <i class="fa fa-industry"></i>
                            <span>التجار</span>
                        </a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('settings.index')}}">
                            <i class="fa fa-cog"></i>
                            <span>الاعدادات العامة</span>
                        </a>
                    </li>
               
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-buffer"></i>
                            <span> اعدادات المناطق </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('countries.index')}}"><i class="mdi mdi-album"></i>
                                    <span> المحافظات</span></a></li>
                            <li><a href="{{route('provinces.index')}}"><i class="mdi mdi-album"></i> <span>المدن </span></a>
                            </li>


                        </ul>
                    </li>
                
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fa fa-shipping-fast"></i>
                            <span>  الطلبات </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('orders.index')}}"><i class="mdi mdi-album"></i>
                                    <span> الطلبات الجديدة</span></a></li>
                            <li><a href="{{route('deliveryConvertedOrders.index')}}"><i class="mdi mdi-album"></i>
                                    <span>    الطلبات المحولة  للمناديب </span></a></li>
                            <li><a href="{{route('totalDeliveryOrders.index')}}"><i class="mdi mdi-album"></i> <span>   طلبات مسلمة كليا </span></a>
                            </li>
                            <li><a href="{{route('partialDeliveryOrders.index')}}"><i class="mdi mdi-album"></i> <span>   طلبات مسلمة جزئيا </span></a>
                            </li>
                            <li><a href="{{route('notDeliveryOrders.index')}}"><i class="mdi mdi-album"></i> <span>   طلبات  غير مسلمة  </span></a>

                            </li>


                        </ul>
                    </li>

                

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('activities.index')}}">
                            <i class="fa fa-history"></i>
                            <span> سجل عمليات النظام</span>
                        </a>
                    </li>
                

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fa fa-file"></i>
                            <span>  التقارير </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('deliversReports.index')}}"><i class="mdi mdi-album"></i> <span>  تقارير المناديب</span></a>
                            </li>
                            <li><a href="{{route('tradersReports.index')}}"><i class="mdi mdi-album"></i> <span>  تقارير التجار</span></a>
                            </li>
                            <li><a href="{{route('todayOrdersReports.index')}}"><i class="mdi mdi-album"></i> <span>   يومية الطلبات</span></a>
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

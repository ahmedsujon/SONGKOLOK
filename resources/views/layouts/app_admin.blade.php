<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Admin | Eplanet') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/img/logo/logo3.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminAsset/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminAsset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminAsset/dist/css/adminlte.min.css') }}">

    <!-- Select css -->
    <link rel="stylesheet" href="{{ asset('adminAsset/plugins/select2/css/select2.min.css') }}">

    <!-- Date range -->
    <link rel="stylesheet" href="{{ asset('adminAsset/plugins/daterangepicker/daterangepicker.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminasset/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/toastr.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminAsset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminAsset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminAsset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminAsset/dist/css/custom.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

@include('layouts.admin_sidebar')

@yield('content')

<!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; {{date('Y')}} <a href="{{route('home')}}">Eplanet</a>.</strong>
        All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('adminAsset/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('adminAsset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminAsset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminAsset/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('adminAsset/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminAsset/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('adminAsset/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('adminAsset/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('adminAsset/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('adminAsset/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('adminAsset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminAsset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminAsset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminAsset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminAsset/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminAsset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminAsset/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('adminAsset/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminAsset/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('adminAsset/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminAsset/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('adminAsset/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('adminAsset/plugins/select2/js/select2.full.min.js') }}"></script>

<script src="{{asset('frontend/assets/js/toastr.min.js')}}"></script>

<!-- ChartJS -->
<script src="{{ asset('adminAsset/plugins/chart.js/Chart.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminAsset/dist/js/demo.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/o2es2ighryq5asf07w5arxsgc1kdh1uf6y1e0moe6be8hozy/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    function random_rgba() {
        var o = Math.round, r = Math.random, s = 255;
        return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
    }
    var data = [];
    var mainDatas = [];
    @php
        $from = date('Y') . '-01-01 ' . date('H:i:s');
        $to = date('Y') . '-12-31 ' . date('H:i:s');
        $pro = \App\Models\Product::where('admin_id', \Illuminate\Support\Facades\Auth::guard('admin')->id())->orderBy('sold', 'desc')->limit(5)->get();
        $monthlySell = [];

        foreach ($pro as $prIndex => $product){
            $res= \App\Models\OrderProduct::with('order')
                ->where('product_id', $product->id)
                ->whereHas('order', function ($query){ $query->where('shifted', 1); })
                ->whereBetween('created_at', [$from, $to])
                ->get()
                ->groupBy(function($val) {
                    return \Carbon\Carbon::parse($val->created_at)->format('m');
            });


            if( ! count($res) ){
                for ($i = 1; $i <= 12; ++$i){
    @endphp

    mainDatas.push(0);
    @php
        }
    }
    else {
        foreach ($res as $index => $value){
    @endphp
    mainDatas.push( {{ $value[0]->order->quantity }} );

    @php
        //$monthlySell[$prIndex]['data'][] = $value[0]->order->quantity;
    }

    $len = count($res) ;

    if( $len < 12 ){
        for ($i = $len+1; $i <= 12; ++$i){
    @endphp
    mainDatas.push(0);
    @php
        }
    }
}

    @endphp
    data.push({
        label : '{{$product->product_name}}',
        backgroundColor : random_rgba(),
        borderColor : random_rgba(),
        {{--pointRadius : true,--}}
            {{--pointColor : '{{ sprintf('#%06X', mt_rand(0, 0xFFFFFF)) }}',--}}
        pointStrokeColor : random_rgba(),
        pointHighlightFill : random_rgba(),
        pointHighlightStroke : random_rgba(),
        data: mainDatas
    });

    mainDatas = [];
    @php

        }
    @endphp

    console.log(data);

    var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

    var salesChartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        // datasets: [
        //     {
        //         label: 'Digital Goods',
        //         backgroundColor: 'rgba(60,141,188,0.9)',
        //         borderColor: 'rgba(60,141,188,0.8)',
        //         pointRadius: true,
        //         pointColor: '#3b8bba',
        //         pointStrokeColor: 'rgba(60,141,188,1)',
        //         pointHighlightFill: '#fff',
        //         pointHighlightStroke: 'rgba(60,141,188,1)',
        //         data: [28, 48, 40, 19, 86, 27, 90,28, 48, 40, 19, 86]
        //     },
        //     {
        //         label: 'Electronics',
        //         backgroundColor: 'rgba(210, 214, 222, 1)',
        //         borderColor: 'rgba(210, 214, 222, 1)',
        //         pointRadius: true,
        //         pointColor: 'rgba(210, 214, 222, 1)',
        //         pointStrokeColor: '#c1c7d1',
        //         pointHighlightFill: '#fff',
        //         pointHighlightStroke: 'rgba(220,220,220,1)',
        //         data: [65, 59, 80, 81, 56, 55, 40,28, 48, 40, 19, 86]
        //     }
        // ]

        datasets : data
    }

    var salesChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: true
                }
            }],
            yAxes: [{
                gridLines: {
                    display: true
                }
            }]
        }
    }

    // This will get the first returned node in the jQuery collection.
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart(salesChartCanvas, {
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
        }
    )
</script>

<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}");
    @endif

    @if(Session::has('error'))
    toastr.error("{{Session::get('error')}}");
    @endif

    @if(Session::has('info'))
    toastr.info("{{Session::get('info')}}");
    @endif
</script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            "ordering": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });

    $('.select2').select2()
</script>

<script>

    // Manage Events
    $(document).on('click', '#eventProducts', function (e) {
        var id = (this.getAttribute('data-target'));
        id = id.slice(9, id.length);
        var modalTableBody = $("#modalTableBodyEvent"+id);
        modalTableBody.empty();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: window.location.origin +'/admin/allevent/' + id,
            method: 'get',

            success: function (response) {
                let parentNode = modalTableBody[0].parentNode;
                $(parentNode).attr('id', 'example2');
                modalTableBody.append(response);
            },
            error:function(response)
            {
                console.warn(response);
            }
        });
        console.log(modalTableBody[0]);

    });

    // Manage Orders
    $(document).on('click', '#submitBtn', function (e) {
        var id = (this.getAttribute('data-target'))
        var moda = $('#exampleModal' + $('#submitBtn').attr('data-target'));
        var modalTableBody = $("#modalTableBody");

        moda.modal('show');
        modalTableBody.empty();
        //$(".modal-dialog")[0].style = "max-width: 1000px !important";


        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: window.location.origin +'/admin/orders/' + id,
            method: 'get',


            success: function (response) {
                response.forEach((value, index) => {
                    console.log(value);
                    let tr = createElement('tr');
                    let unique_id = createElement('td');
                    let order_date = createElement('td');
                    let quantity = createElement('td');
                    let product_name = createElement('td');
                    let product_image = createElement('td');
                    let product_model = createElement('td');
                    let product_total_price = createElement('td');
                    let product_size = createElement('td');
                    let action = createElement('td');
                    let anchor = createElement('a');
                    let url = window.location.origin + '/admin/orders/' + value.id + '/edit';
                    anchor.setAttribute('href', url);
                    action.appendChild(anchor);
                    anchor.innerText = "Shift now";
                    anchor.className = "btn btn-info";


                    let image = createElement('img');
                    let src = window.location.origin + "/storage/app/public/images/" + value.products[0].feature_image;
                    image.setAttribute('src', src);
                    image.setAttribute('alt', value.products[0].product_name);
                    image.setAttribute('width', 80);

                    product_image.appendChild(image);
                    let time = new Date(value.created_at);
                    unique_id.innerText = value.unique_id;
                    order_date.innerText = time.toDateString();
                    quantity.innerText = value.quantity;
                    product_name.innerText = value.products[0].product_name;
                    product_model.innerText = value.products[0].model;
                    product_total_price.innerText = parseInt(value.products[0].product_price) * parseInt(value.quantity);
                    product_size.innerText = value.products[0].size;

                    tr.appendChild(unique_id);
                    tr.appendChild(order_date);
                    tr.appendChild(product_name);
                    tr.appendChild(product_image);
                    tr.appendChild(product_model);
                    tr.appendChild(quantity);
                    tr.appendChild(product_total_price);
                    tr.appendChild(product_size);
                    tr.appendChild(action);
                    modalTableBody.append(tr);
                })
            },
            error:function(response)
            {
                console.warn(response);
            }
        });


    });

    // Manage All Orders
    $(document).on('click', '#submitBtnn', function (e) {
        var id = (this.getAttribute('data-target'))
        var moda = $('#exampleModal' + $('#submitBtnn').attr('data-target'));
        var modalTableBody = $("#modalTableBody");

        moda.modal('show');
        modalTableBody.empty();
        $(".modal-dialog")[0].style = "max-width: 1000px !important";


        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: window.location.origin +'/admin/allOrders/' + id,
            method: 'get',
            // dataType:'json',
            // data: $('#submitBtn').attr('data-target'),// full data for the campain to be created


            success: function (response) {
                response.forEach((value, index) => {
                    console.log(value);
                    let tr = createElement('tr');
                    let unique_id = createElement('td');
                    let order_date = createElement('td');
                    let quantity = createElement('td');
                    let product_name = createElement('td');
                    let product_image = createElement('td');
                    let product_model = createElement('td');
                    let product_total_price = createElement('td');
                    let product_size = createElement('td');
                    let action = createElement('td');
                    let anchor = createElement('a');
                    let url = window.location.origin + '/admin/orders/' + value.id + '/edit';
                    anchor.setAttribute('href', url);
                    action.appendChild(anchor);
                    anchor.innerText = "Mark as Shifted";
                    anchor.className = "btn btn-info";


                    let image = createElement('img');
                    let src = window.location.origin + "/storage/app/public/images/" + value.products[0].feature_image;
                    image.setAttribute('src', src);
                    image.setAttribute('alt', value.products[0].product_name);
                    image.setAttribute('width', 80);

                    product_image.appendChild(image);

                    unique_id.innerText = value.unique_id;
                    order_date.innerText = value.created_at;
                    quantity.innerText = value.quantity;
                    product_name.innerText = value.products[0].product_name;
                    product_model.innerText = value.products[0].model;
                    product_total_price.innerText = parseInt(value.products[0].product_price) * parseInt(value.quantity);
                    product_size.innerText = value.products[0].size;

                    tr.appendChild(unique_id);
                    tr.appendChild(order_date);
                    tr.appendChild(product_name);
                    tr.appendChild(product_image);
                    tr.appendChild(product_model);
                    tr.appendChild(quantity);
                    tr.appendChild(product_total_price);
                    tr.appendChild(product_size);
                    tr.appendChild(action);
                    modalTableBody.append(tr);
                })
            },
            error:function(response)
            {
                console.warn(response);
            }
        });


    });



    // subcategory by category
    $('#category_id').on('change',function (e) {
        let selectedValue = $(this).children("option:selected").val();
        let subCat = $('#sub_category_id');
        let subCatId = subCat.attr("data-subcat");
        //console.log(subCatId)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('admin/subcatbycat') }}/" + selectedValue,
            method: 'post',


            success: function (response) {
                subCat.empty();
                let option = createElement("option");

                option.setAttribute('value', " ");
                option.innerText = "Select";
                subCat[0].append(option);

                response.forEach((value, index) => {
                    let option = returnOption(value, subCatId);
                    subCat[0].append(option);
                });
            },
            error:function(response)
            {
                console.warn(response);
            }
        });


    });

    // sub category by 2nd sub category
    $('#sub_category_id').on('change',function (e) {
        let selectedValue = $(this).children("option:selected").val();
        let subCat = $('#secondary_sub_categories_id');
        let subCatId = subCat.attr("data-secondsub");
        //console.log(subCatId)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('admin/secondsubcatbysubcat') }}/" + selectedValue,
            method: 'post',
            // dataType:'json',
            // data: $('#submitBtn').attr('data-target'),// full data for the campain to be created


            success: function (response) {
                subCat[0].innerHTML = " ";
                let option = createElement("option");

                option.setAttribute('value', " ");
                option.innerText = "Select";
                subCat[0].append(option);

                response.forEach((value, index) => {
                    console.log(value, index);

                    let option = returnOption(value, subCatId, 2);
                    // console.log(option)
                    subCat[0].append(option);
                });
            },
            error:function(response)
            {
                console.warn(response);
            }
        });
    });

    function createElement(element) {
        return document.createElement(element);
    }


    function returnOption(value, subCatId, second = null){
        let option = createElement('option');
        option.setAttribute('value', value.id);
        if(second == 2) option.innerText = value.secondary_subcategory_name;
        else option.innerText = value.subcategory_name;

        if( value.id == subCatId ) option.selected = true;

        return option;
    }

</script>

<script>
    // secondary_sub_categories_id by product
    $('#secondary_sub_categories_id').on('change',function (e) {
        let selectedValue = $(this).children("option:selected").val();
        let product = $('#product_id');
        let productId = product.attr("data-product");
        // console.log(subCatId)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('admin/productbycat') }}/" + selectedValue,
            method: 'post',


            success: function (response) {
                console.log(response)
                product[0].innerHTML = " ";
                let option = createElement("option");

                option.setAttribute('value', " ");
                option.innerText = "Select";
                product[0].append(option);

                response.forEach((value, index) => {
                    let option = returnOptions(value, productId);
                    product[0].append(option);
                });
            },
            error:function(response)
            {
                console.warn(response);
            }
        });


    });
    function createElement(element) {
        return document.createElement(element);
    }

    function returnOptions(value, productId){
        let option = createElement('option');
        option.setAttribute('value', value.id);
        option.innerText = value.product_name;

        if( value.id == productId ) option.selected = true;

        return option;
    }
</script>

<script>
    // Division by District
    $('#division_id').on('change',function (e) {
        let selectedValue = $(this).children("option:selected").val();
        let district = $('#district_id');
        let districtId = district.attr("data-district");
        // console.log(subCatId)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('admin/districtByDivision') }}/" + selectedValue,
            method: 'post',


            success: function (response) {
                console.log(response)
                district[0].innerHTML = " ";
                let option = createElement("option");

                option.setAttribute('value', " ");
                option.innerText = "Select";
                district[0].append(option);

                response.forEach((value, index) => {
                    let option = returnByOption(value, districtId);
                    district[0].append(option);
                });
            },
            error:function(response)
            {
                console.warn(response);
            }
        });


    });
    function createElement(element) {
        return document.createElement(element);
    }

    function returnByOption(value, districtId){
        let option = createElement('option');
        option.setAttribute('value', value.id);
        option.innerText = value.district_name;

        if( value.id == districtId ) option.selected = true;

        return option;
    }
</script>

<script>

    $('#district_id').on('change',function (e) {
        let selectedValue = $(this).children("option:selected").val();
        let city = $('#city_id');
        let cityId = city.attr("data-city");
        // console.log(cityId)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ url('admin/cityByDistrict') }}/" + selectedValue,
            method: 'post',


            success: function (response) {
                console.log(response);
                city[0].innerHTML = " ";
                let option = createElement("option");

                option.setAttribute('value', " ");
                option.innerText = "Select";
                city[0].append(option);

                response.forEach((value, index) => {
                    let option = returnByOptions(value, cityId);
                    city[0].append(option);
                });
            },
            error:function(response)
            {
                console.warn(response);
            }
        });


    });
    function createElement(element) {
        return document.createElement(element);
    }

    function returnByOptions(value, cityId){
        let option = createElement('option');
        option.setAttribute('value', value.id);
        option.innerText = value.city_name;

        if( value.id == cityId ) option.selected = true;

        return option;
    }
</script>





<script>
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY hh:mm A'
        }
    })
</script>

@if( url()->current() == route('product.index') )
    <script>
        let all_description = $('[name^="product_description"]' );

        all_description.each(function( index ) {
            console.log( $( this )[0].id );
            CKEDITOR.replace( $( this )[0].id );
        });

    </script>
@endif
<script>

    var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

    tinymce.init({
        selector: '[name="product_specification"]',
        plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable',
        tinydrive_token_provider: 'URL_TO_YOUR_TOKEN_PROVIDER',
        tinydrive_dropbox_app_key: 'YOUR_DROPBOX_APP_KEY',
        tinydrive_google_drive_key: 'YOUR_GOOGLE_DRIVE_KEY',
        tinydrive_google_drive_client_id: 'YOUR_GOOGLE_DRIVE_CLIENT_ID',
        mobile: {
            plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker textpattern noneditable help formatpainter pageembed charmap mentions quickbars linkchecker emoticons advtable'
        },
        menu: {
            tc: {
                title: 'TinyComments',
                items: 'addcomment showcomments deleteallconversations'
            }
        },
        menubar: 'file edit view insert format tools table tc help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,
        advlist_bullet_styles: 'square',
        link_list: [
            { title: 'My page 1', value: 'https://www.tiny.cloud' },
            { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_list: [
            { title: 'My page 1', value: 'https://www.tiny.cloud' },
            { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_class_list: [
            { title: 'None', value: '' },
            { title: 'Some class', value: 'class-name' }
        ],
        importcss_append: true,
        templates: [
            { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
            { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
            { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
        ],
        template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
        template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
        height: 600,
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_noneditable_class: 'mceNonEditable',
        toolbar_mode: 'sliding',
        spellchecker_whitelist: ['Ephox', 'Moxiecode'],
        tinycomments_mode: 'embedded',
        content_style: '.mymention{ color: gray; }',
        contextmenu: 'link image imagetools table configurepermanentpen',
        a11y_advanced_options: true,
        skin: useDarkMode ? 'oxide-dark' : 'oxide',
        content_css: useDarkMode ? 'dark' : 'default',
        /*
        The following settings require more configuration than shown here.
        For information on configuring the mentions plugin, see:
        https://www.tiny.cloud/docs/plugins/premium/mentions/.
        */
        // mentions_selector: '.mymention',
        // mentions_fetch: mentions_fetch,
        // mentions_menu_hover: mentions_menu_hover,
        // mentions_menu_complete: mentions_menu_complete,
        // mentions_select: mentions_select,
        // mentions_item_type: 'profile'
    });
    tinymce.init({
        selector: '[name="product_description"]',
        plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable',
        tinydrive_token_provider: 'URL_TO_YOUR_TOKEN_PROVIDER',
        tinydrive_dropbox_app_key: 'YOUR_DROPBOX_APP_KEY',
        tinydrive_google_drive_key: 'YOUR_GOOGLE_DRIVE_KEY',
        tinydrive_google_drive_client_id: 'YOUR_GOOGLE_DRIVE_CLIENT_ID',
        mobile: {
            plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker textpattern noneditable help formatpainter pageembed charmap mentions quickbars linkchecker emoticons advtable'
        },
        menu: {
            tc: {
                title: 'TinyComments',
                items: 'addcomment showcomments deleteallconversations'
            }
        },
        menubar: 'file edit view insert format tools table tc help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,
        link_list: [
            { title: 'My page 1', value: 'https://www.tiny.cloud' },
            { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_list: [
            { title: 'My page 1', value: 'https://www.tiny.cloud' },
            { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_class_list: [
            { title: 'None', value: '' },
            { title: 'Some class', value: 'class-name' }
        ],
        importcss_append: true,
        templates: [
            { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
            { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
            { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
        ],
        template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
        template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
        height: 600,
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_noneditable_class: 'mceNonEditable',
        toolbar_mode: 'sliding',
        spellchecker_whitelist: ['Ephox', 'Moxiecode'],
        tinycomments_mode: 'embedded',
        content_style: '.mymention{ color: gray; }',
        contextmenu: 'link image imagetools table configurepermanentpen',
        a11y_advanced_options: true,
        skin: useDarkMode ? 'oxide-dark' : 'oxide',
        content_css: useDarkMode ? 'dark' : 'default',
        /*
        The following settings require more configuration than shown here.
        For information on configuring the mentions plugin, see:
        https://www.tiny.cloud/docs/plugins/premium/mentions/.
        */
        // mentions_selector: '.mymention',
        // mentions_fetch: mentions_fetch,
        // mentions_menu_hover: mentions_menu_hover,
        // mentions_menu_complete: mentions_menu_complete,
        // mentions_select: mentions_select,
        // mentions_item_type: 'profile'
    });




    // tinymce.init({
    //     selector: '[name="product_specification"]'
    // });

    // tinymce.init({
    //     selector: '[name="product_description"]'
    // });
</script>

<script>
    $('#add_button').click(() => {
        $( "#copy" ).clone().appendTo( "#others" );
    });


    $("#delete_button").click(() => {
        let len = $('#others').children().length;

        if( len > 0 ){
            $('#others').children().last().remove();
        }
    });
</script>

</body>
</html>


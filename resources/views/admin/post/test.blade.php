<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/theme.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/MoneAdmin.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/Font-Awesome/css/font-awesome.css')}}" />
    <link href="https://unpkg.com/tabulator-tables@4.7.2/dist/css/tabulator.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
    <style type="text/css">
        .category li{
            list-style-type: none;
            background-color: #f5f5f5;
            border: 1px solid #dddddd;
            border-radius: 5px;
            padding: 10px;
            color: #1b4b72;
        }
        .category li .button-block{
            float: right;
            display: inline-block;
        }
        .category li .up_down{
            padding: 5px;
            background-color: #398cd4;
            color: white;
            border-radius: 2px;
        }
    </style>
</head>
<body>
{{--<div class="row">--}}
{{--    <div class="col-lg-6">--}}
{{--        <div class="panel panel-default">--}}
{{--            <div class="panel-heading">Category</div>--}}
{{--            <div class="panel-body">--}}
{{--                --}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div id="example-table"></div>

</body>
<script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.7.2/dist/js/tabulator.min.js"></script>
<script src="{{asset('assets/plugins/jquery-2.0.3.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>


<script>

    // var tableDataNested = [
    //     {name:"Oli Bob", location:"United Kingdom", gender:"male", col:"red", dob:"14/04/1984", _children:[
    //             {name:"Mary May", location:"Germany", gender:"female", col:"blue", dob:"14/05/1982"},
    //             {name:"Christine Lobowski", location:"France", gender:"female", col:"green", dob:"22/05/1982"},
    //             {name:"Brendon Philips", location:"USA", gender:"male", col:"orange", dob:"01/08/1980", _children:[
    //                     {name:"Margret Marmajuke", location:"Canada", gender:"female", col:"yellow", dob:"31/01/1999"},
    //                     {name:"Frank Harbours", location:"Russia", gender:"male", col:"red", dob:"12/05/1966"},
    //                 ]},
    //         ]},
    //     {name:"Jamie Newhart", location:"India", gender:"male", col:"green", dob:"14/05/1985"},
    //     {name:"Gemma Jane", location:"China", gender:"female", col:"red", dob:"22/05/1982", _children:[
    //             {name:"Emily Sykes", location:"South Korea", gender:"female", col:"maroon", dob:"11/11/1970"},
    //         ]},
    //     {name:"James Newman", location:"Japan", gender:"male", col:"red", dob:"22/03/1998"},
    // ];


    let table = new Tabulator("#example-table", {
        layout:"fitColumns",
        ajaxURL:"/post/category/getAll",
        placeholder:"No Data Set",
        pagination: "local",
        paginationSize:10,
        paginationSizeSelector:[5,10,50,100],
        dataTree:true,
        dataTreeStartExpanded:true,
        columns:[
            {title:"Category", field:"category", responsive:0}, //never hide this column
            {title:"Slug", field:"slug", responsive:2}, //hide this column first
            {title:"Date created", field:"created_at", hozAlign:"center", sorter:"date"},
            {title:"Date updated", field:"updated_at", hozAlign:"center", sorter:"date"},
            {title:"Update", field:"btn_update", hozAlign:"center",formatter:"html",width:100},
        ],
    });

    $(document).ready(function () {
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        $(document).on('click','#btn_update',function () {
            let id = $(this).find('span').attr('id');
            alert(id);
        });


        {{--$.ajax({--}}
        {{--    url: '{{url("/post/category/getAll")}}',--}}
        {{--    type: 'get',--}}
        {{--    dataType:'json',--}}
        {{--    success:function (data) {--}}
        {{--        --}}
        {{--    },--}}
        {{--    error: function (data) {--}}
        {{--        console.log('error retrieving data')--}}
        {{--    }--}}
        {{--});--}}

    });
</script>
</html>

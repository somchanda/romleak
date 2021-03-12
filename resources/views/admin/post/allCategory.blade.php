@extends('admin.layout')

@section('content')
    <div id="content">
        <div class="inner" style="min-height: 700px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1> Categories </h1>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All categories
                        </div>
                        <div class="panel-body">
                            <button class="button-big" id="btn_add">
                                <span class="glyphicon glyphicon-plus"></span>
                                Add new
                            </button>
                            <div class="info-msg" style="display: none">
                                <span class="glyphicon glyphicon-info-sign"></span>
                                <span id="msg"></span>
                            </div>
                            <div class="error-msg" style="display: none">
                                <span class="glyphicon glyphicon-exclamation-sign"></span>
                                <span id="msg"></span>
                            </div>
                            <hr>
                            <!-- <div class="table-responsive" id="category-table-wrap">
                            </div> -->
                            <div id="category-table"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Contact Form-->
    <div id="popup">
        <form class="popup-form" action="javascript:void(0)" id="popup-form"
              method="post">
            <h1>category</h1>
            <button type="button" class="close" id="close-popup">
                <span aria-hidden="true">&times;</span>
            </button>
            <div>
                <div>
                    <label>Category</label><span id="category-info"
                                               class="info"></span>
                    <input type="hidden" name="id" id="id">
                </div>
                <div>
                    <input type="text" id="category" name="category"
                           class="inputBox" />
                </div>
            </div>
            <div>
                <div>
                    <label>Slug </label><span id="slug-info"
                                                class="info"></span>
                </div>
                <div>
                    <input type="text" id="slug" name="slug"
                           class="inputBox" />
                </div>
            </div>
            <div>
                <div>
                    <label>Parent </label><span id="parent-info"
                                              class="info"></span>
                </div>
                <div>
                    <select name="parent" id="parent" class="inputBox">

                    </select>
                </div>
            </div>
            <div>
                <div>
                    <label>Created at: </label><span id="created-at-info"
                                                  class="info"></span>
                    <label id="created-at"></label>
                </div>
            </div>
            <div>
                <button type="submit" id="save" name="save" class="button-big"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
            </div>
        </form>
    </div>

    <div class="overlay" style="display: none">
        <div id="load" class="loader"></div>
    </div>
@endsection

@section('script')
    <script>

    </script>
    <!-- PAGE LEVEL SCRIPTS -->
    <script src="{{asset('assets/plugins/dataTables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/plugins/dataTables/dataTables.bootstrap.js')}}"></script>
    <script>

        $(document).ready(function () {
            /**
             * Define load all category function
             */
            function loadCategory(){
                // let table = new Tabulator("#category-table", {
                //     layout:"fitColumns",
                //     ajaxURL:"/post/category/getAll",
                //     placeholder:"No Data Set",
                //     pagination: "local",
                //     paginationSize:10,
                //     paginationSizeSelector:[5,10,50,100],
                //     dataTree:true,
                //     dataTreeStartExpanded:true,
                //     columns:[
                //         {title:"Category", field:"category", responsive:0}, //never hide this column
                //         {title:"Slug", field:"slug", responsive:2}, //hide this column first
                //         {title:"Date created", field:"created_at", hozAlign:"center", sorter:"date"},
                //         {title:"Date updated", field:"updated_at", hozAlign:"center", sorter:"date"},
                //         {title:"Update", field:"btn_update", hozAlign:"center",formatter:"html",width:90,headerSort:false},
                //         {title:"Delete", field:"btn_delete", hozAlign:"center",formatter:"html",width:90,headerSort:false},
                //     ],
                // });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{url("/post/category/getAll")}}',
                    type: 'get',
                    dataType:'json',
                    success:function (data) {
                        var table = new Tabulator("#category-table", {
                            data:data,           //load row data from array
                            layout:"fitColumns",      //fit columns to width of table
                            responsiveLayout:"hide",  //hide columns that dont fit on the table
                            tooltips:true,            //show tool tips on cells
                            addRowPos:"top",          //when adding a new row, add it to the top of the table
                            history:true,             //allow undo and redo actions on the table
                            pagination:"local",       //paginate the data
                            paginationSize:7,         //allow 7 rows per page of data
                            movableColumns:true,      //allow column order to be changed
                            resizableRows:true,       //allow row order to be changed
                            initialSort:[             //set the initial sort order of the data
                                {column:"category", dir:"asc"},
                            ],
                            dataTree: true,
                            dataTreeStartExpanded:true,
                            columns:[                 //define the table columns
                                {title:"Category", field:"category", responsive:0}, //never hide this column
                                {title:"Slug", field:"slug", responsive:2}, //hide this column first
                                {title:"Date created", field:"created_at", hozAlign:"center", sorter:"date"},
                                {title:"Date updated", field:"updated_at", hozAlign:"center", sorter:"date"},
                                {title:"Update", field:"btn_update", hozAlign:"center",formatter:"html",width:90,headerSort:false},
                                {title:"Delete", field:"btn_delete", hozAlign:"center",formatter:"html",width:90,headerSort:false},
                            ],
                        });
                    },
                    error: function (data) {
                        console.log('error retrieving data')
                    }
                });
            }

            /**
             * Load only one category by id and return category to edit popup form
             * @param id
             */
            function loadOneCategory(id) {
                fillCatSelect(id);
                $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
                });
                $.ajax({
                   url:'{{url("/post/category/getOne")}}/'+id,
                   type: 'get',
                   dataType: 'json',
                    beforeSend:function(){
                        $('.overlay').css('display', 'block');
                    },
                   success:function (data) {
                       $('.overlay').css('display', 'none');
                       $('#id').val(data.id);
                       $('#category').val(data.category);
                       $('#slug').val(data.slug);
                       $('#created-at').html(data.created_at);
                       $('#parent option[value=' + data.parent_id + ']').attr('selected', 'selected');
                       $("#popup").show();
                   },
                   error:function (jqXHR, textStatus, errorThrown) {
                       $('.overlay').css('display', 'none');
                        console.log(errorThrown);
                        if(textStatus === 'timeout'){
                            alert('Request timeout please check your connection and try again!');
                        }
                   },
                    timeout: 3000
                });
            }

            loadCategory();
            closePopup();

            /**
             * Show popup form when user click add button
             */
            $(document).on('click','#btn_add',function () {
                $("#popup").show();
                fillCatSelect();
            });

            /**
             * show popup form when user click update button
             */
            $(document).on('click','#category-table #btn_update',function () {
                let id = $(this).find('span').attr('id');
                loadOneCategory(id);
            });

            /**
             * Delete when user click button delete
             */
            $(document).on('click','#category-table #btn_delete',function () {
                const id = $(this).find('span').attr('id');
                confirmDialog('Do you want to delete?',function yes() {
                    deleteCategory(id);
                },function no() {

                });
            });

            /**
             * close the popup form when user click on close icon
             */
            $(document).on('click','#popup #close-popup',function () {
                closePopup();
            });

            /**
             * Generate slug when user type category name
             */
            $(document).on('keyup','#popup #category',function () {
                let slug = $(this).val().trim().toLowerCase();
                slug = slug.replace(/\s+/g, '-');
                $('#slug').val(slug);
            });

            /**
             * To prevent user input space in slug
             */
            $(document).on('keydown','#popup #slug',function (event) {
                let keyCode = keyPressed(event);
                if(keyCode === 32){
                    $('#slug-info').html('Not allow space in slug!');
                    $('#slug').addClass('input-error');
                    return false;
                }else{
                    $('#slug-info').html('');
                    $('#slug').removeClass('input-error');
                }
            });

            /**
             * To close popup form and clear data from text box
             */
            function closePopup() {
                let popup = $('#popup');
                popup.hide();
                popup.find('input:text, input:hidden').val('');
                popup.find('#parent').html('');
                popup.find('#created-at').html('');
            }

            /**
             * To getCode by pass event to it
             * @param event
             * @returns {number | {COMMA: number, DOWN: number, LEFT: number, ENTER: number, NUMPAD_DECIMAL: number, NUMPAD_ENTER: number, PAGE_UP: number, ESCAPE: number, NUMPAD_DIVIDE: number, PAGE_DOWN: number, SPACE: number, DELETE: number, NUMPAD_ADD: number, NUMPAD_MULTIPLY: number, TAB: number, PERIOD: number, RIGHT: number, END: number, NUMPAD_SUBTRACT: number, BACKSPACE: number, UP: number, HOME: number} | (function(*): any) | (function(*): any)}
             */
            function keyPressed(event){
                return event.keyCode || event.charCode || event.which ;
            }

            /**]
             * Save category when user submit form
             */
            $('#save').click(function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = '';
                if($('#id').val() === ''){
                    url = '/post/category/add';
                }else{
                    url = '/post/category/update';
                }
                $.ajax({
                    url:"{{url('')}}" + url,
                    method:'post',
                    data: $('#popup-form').serialize(),
                    dataType:'json',
                    beforeSend:function(){
                      $('.overlay').css('display','block');
                    },
                    success:function (datas) {
                       if(datas.status){
                           loadCategory();
                           closePopup();
                       }else{
                           let field_array = [] , field_info_array= [];
                           for (let field in datas) {
                               if (datas.hasOwnProperty(field)) {
                                   let field_info_id = '#'+field+'-info';
                                   let field_id = '#'+field;
                                   let msgs = '';
                                   datas[field].forEach(msg => msgs += '<div>'+msg+'</div>');

                                   //Push field id to array variable, use in timeout function
                                   field_array.push(field_id);
                                   field_info_array.push(field_info_id);

                                   //display error on form input
                                   $(field_info_id).html(msgs);
                                   $(field_id).addClass('input-error');
                               }
                           }
                           //Remove error message and remove input error class
                           setTimeout(function(){
                                    field_array.forEach(field => {$(field).removeClass('input-error')});
                                    field_info_array.forEach(field => {$(field).html('')});
                               },
                               9000
                           );
                       }
                        $('.overlay').css('display','none');
                    },
                    error:function (error) {
                        setTimeout(function () {
                            $('.overlay').css('display','none');
                            alert('Internal error please contact your developer');
                        },
                        5000
                        )
                    }
                });
            });

            /**
             * Delete category by ID
             * @param id
             */
            function deleteCategory(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let sMessage = $('.info-msg');
                let eMessage = $('.error-msg');
                $.ajax({
                    url:"{{url('/post/category/delete')}}",
                    method:'post',
                    data: {id:id},
                    dataType:'json',
                    beforeSend:function(){
                        $('.overlay').css('display','block');
                    },
                    success:function (data) {

                        if(data.status){
                            loadCategory();
                            sMessage.find('#msg').html(data.message);
                            sMessage.slideDown();
                        }else{
                            eMessage.find('#msg').html(data.message);
                            eMessage.slideDown();
                        }
                        setTimeout(function () {
                            sMessage.slideUp();
                            eMessage.slideUp();
                        },5000);
                        $('.overlay').css('display','none');
                    },
                    error:function (jqXHR, textStatus, errorThrown) {
                        $('.overlay').css('display','none');
                         eMessage.find('#msg').html('Internal error please contact your developer');
                         eMessage.slideDown();
                        setTimeout(function () {
                            eMessage.slideUp();
                        },5000);
                    }
                });
            }

            /**
             * To fill parent category select
             */
            function fillCatSelect(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{url("/post/category/fillCatSelect")}}/'+id,
                    type: 'get',
                    dataType: 'json',
                    success: function (data) {
                        $('#parent').html(data.option);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    }
                });
            }
        });
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name','Thông tin tiện ích sinh viên')}} @yield('title')</title>
    <link rel="icon" href="https://static.topcv.vn/v4/image/logo/topcv-logo-tet-holiday.png" type="image/x-icon" />
    <!-- <link rel="stylesheet" href="{{asset('css/style.css')}}"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('ckeditor/ckfinder.js')}}"></script>
    <link href="{{asset('css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/toasty.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/toasty.js"></script>
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layout.admin.sidebar_admin')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layout.admin.topbar_admin')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                <div class="col-xs-9">
                    <table id="customers" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <input type="hidden" value="{{$i=0}}">
                                <th>STT</th>
                                <th>Tên service</th>
                                <th>Gias</th>
                                <th>Thời gian dịch vụ</th>
                                <th>Lượt mua</th>
                                <th>Sửa</th>
                                <th>xóa</th>
                            </tr>
                        </thead>
                    </table>
                </div>

        </div>
    </div>
    
                </div>
            </div>
</div>
    @push('scripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.css"/>
    <script src="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.js"></script>
    
    <script>
        $(document).ready(function() {
            let post_table = $('#customers').DataTable({
                dom: 'Bfrtip',
                processing: true,
                serverSide: true,
                select:true,
                ajax: '{!! route('admin.services.indexApi') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'price', name: 'price' },
                    { data: 'time', name: 'time' },
                    { data: 'buy', name: 'buy' },
                    // i want to add a button to edit and delete
                    {
                        data: 'edit',
                        target:5,
                        render:function(data,type,row,meta){
                            var url = '/admin/management-services/edit/view/' + row.id;
                            return `<form action="${url}" method="post">
                                                @csrf
                                                @method('GET')
                                                <button class="btn btn-warning" id="delete-button">Edit</button>
                                    </form>`;
                        }
                    },
                    {
                        data: 'delete',
                        target:6,
                        render:function(data,type,row,meta){
                            return `<form action="${data}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" onclick="if (!confirm('Bạn có muốn xóa gói dịch vụ này không?')) { return false }" id="delete-button">Delete</button>
                                    </form>`;
                        }
                    },
                    
                ],
            });
            $('#fillter-category').on('change',function(){
                let category_id = $(this).val();
                post_table.columns(1).search(category_id).draw();
            });
            post_table.on( 'draw.dt', function () {
                var PageInfo = $('#customers').DataTable().page.info();
                let i = 1;
                post_table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                        cell.innerHTML = i + 1 + PageInfo.start;
                    } );
            });
        });
    
    </script>
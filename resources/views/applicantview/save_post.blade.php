<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="{{asset('css/applicant.css')}}">
    <link rel="stylesheet" href="{{asset('css/public.css')}}">
    <script src="{{asset('js/js.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ỨNG CỬ VIÊN</title>
</head>
<body>
    @include('layout.applicantview.header')
    <div id="main_profile">
       @include('layout.applicantview.navbar_profile')
        <div class="container-fluid">
            <div class="row">
            <table id="customers" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <input type="hidden" value="{{$i=0}}">
                                <th>STT</th>
                                <th>Công ty</th>
                                <th>Bài Tuyển Dụng</th>
                                <th>Đã Lưu</th>
                                <th>Tùy chọn</th>
                            </tr>
                        </thead>
                    </table>
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
                ajax: '{!! route('save.post.indexApi') !!}',
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'company', name: 'company' },
                    { data : 'title', name: 'title'},
                    { data: 'time_saved', name: 'time_saved' },
                    {
                        data:'delete',
                        targets:5,
                        orderable:true,
                        searchable:true,
                        render:function(data,type,row,meta){
                                return `<form action="${data}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" onclick="if (!confirm('Bạn có muốn xóa bài viết không?')) { return false }" id="delete-button">Xóa</button>
                                        </form>`;
                        }
                    }
                    
                ],
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

</body>
</html>
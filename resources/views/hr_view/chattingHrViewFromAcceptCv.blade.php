<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="{{asset('css/applicant.css')}}">
    <link rel="stylesheet" href="{{asset('css/public.css')}}">
    <link rel="stylesheet" href="{{asset('css/chatting.css')}}">
    <script src="{{asset('js/js.js')}}"></script> 
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ỨNG CỬ VIÊN</title>
</head>
<body>
    @include('layout.hrview.header_hr')  
    @include('layout.hrview.chatting_from_acceptCv')
    <script>
    $(".input-text-chatting").click(function(){
	var room_id = '{{$room_id}}';
	var tag_li_with_room_id_value = $('li[value="'+room_id+'"]');
	var meta_class = tag_li_with_room_id_value.find('.meta');
	var backgroundColor = tag_li_with_room_id_value.css('background-color');
	console.log(backgroundColor);
	if(backgroundColor === 'rgb(119, 136, 153)'){
		tag_li_with_room_id_value.css('background-color','transparent');
		meta_class.css('color','white');
	}
	hr_id = '{{session('id_hr')}}';
	var token = "{{csrf_token()}}";
	$.ajax({
		url: "{{route('hr.seen.message')}}",
		type: "POST",
		data: {
			_token: token,
			room_id: room_id,
			hr_id: hr_id,
		},
		success: function(data){
			console.log("ok",data);
			$.ajax({
                                            url:'{{route('count.chatting.messages.not.seen')}}',
                                            type:'GET',
                                            dataType:'json',
                                            data:{
                                                hr_id:{{session('id_hr')}},
                                                from_to:'hr'
                                            },
                                            success:function(data){
                                                console.log(data);
                                                if(data.count_chatting_message_not_seen == 0){
                                                    $('#count_chatting_not_seen').css('display','none');
                                                }
                                                else{
                                                    $('#count_chatting_not_seen').css('display','block');
                                                    $('#count_chatting_not_seen').html(data.count_chatting_message_not_seen);
                                                
                                                }
                                            },
                                            error:function(error){
                                                console.log(error);
                                            }
                                        })
	
		},
		error: function(error){
			console.log(error);
		}
	});

})
    </script>
</body>
</html>

function close_apply_form(){
    document.getElementById("form-apply").style.display = "none";
}

function show_apply_form(){
    document.getElementById("form-apply").style.display = "block";
    
}

$(document).ready(function(){
    var checked = true;
    $('#check_allow').click(function(){
        if(checked == true){
            $('#check_allow').prop('checked', false);
            $('.form-check-label').html('');
            $('.form-check-label').append('<label class="form-check-label" for="check_allow" style=" font-size: 16px;font-weight: 600; color: #e74c3c;">Trạng thái tìm việc đang tắt</label>');
            checked = false;
        }else{
            $('#check_allow').prop('checked', true);
            $('.form-check-label').html('');
            $('.form-check-label').append('<label class="form-check-label" style=" font-size: 16px;font-weight: 600;color: #00b14f;" for="check_allow">Đã bật trạng thái tìm việc</label>');
            checked = true;
        }
    });
    $('#check').click(function(){
        if(checked == true){
            $('#check').prop('checked', false);
            $('.form-check-label-allow').html('');
            $('.form-check-label-allow').append('<label class="form-check-label-allow" style=" font-size: 16px;font-weight: 600; color: #e74c3c;"  for="check">Cho phép NTD liên hệ bạn qua</label>');
            $('.choice_cv').hide();
            checked = false;
        }else{
            $('#check').prop('checked', true);
            $('.form-check-label-allow').html('');
            $('.form-check-label-allow').append('<label class="form-check-label-allow" for="check" style=" font-size: 16px;font-weight: 600;color: #00b14f;">Cho phép NTD liên hệ bạn qua</label>');
            $('.choice_cv').show();
            checked = true;
        }   
    });

    var list_link = document.querySelectorAll('.link_profile');
    console.log(list_link);
    for(var i = 0;i<list_link.length;i++){
        list_link[i].addEventListener('click',function(){
            list_link[i].style.backgroundColor = "red";
        });
    }

});
// function infor_update(){
//     $name = $('#name').val();
//     $numberPhone = $('#phoneNumber').val();
//     $gender = $('#gender').val();
//     $address =$('#address').val();
//     $links = $('#links').val();
//     $avatar = $('#avatar').val();
//     $applicant_id = $('#applicant_id').val()
//     let route ='{{route('update.infor.applicant')}}';
//     $.ajax({
//         headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         url: route,
//         type:'PUT',
//         data:{
//             name:$name,
//             numberPhone:$numberPhone,
//             gender:$gender,
//             address:$address,
//             links:$links,
//             avatar:$avatar,
//             applicant_id:$applicant_id,
//         },
//         dataType:'json',
//         success:function(data){
//             console.log(data)
//         }
// })
// }



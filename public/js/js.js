
function close_apply_form(){
    document.getElementById("form-apply").style.display = "none";
}

function show_apply_form(){
    document.getElementById("form-apply").style.display = "block";
    
}
function close_choice_role_form(){
    document.getElementById("choice_role").style.display = "none";
}

function show_choice_role_form(event){
    var choice_role = document.getElementById("choice_role");
    choice_role.style.display = "block"; 
}

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



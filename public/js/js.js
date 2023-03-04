
function close_apply_form(){
    document.getElementById("form-apply").style.display = "none";
}

function show_apply_form(){
    document.getElementById("form-apply").style.display = "block";
    $file_cv = document.getElementById("up_cv");
    $src_cv = document.getElementById("img_cv");
    $upfile  = document.getElementById("upfile");
    $choice_profile_cv = document.getElementById("choice_profile_cv");
    const remove_img_cv = document.getElementById("remove_img_cv");
    const button_radio = document.getElementById("check");
    remove_img_cv.style.display = "none";
    var click = false;
    button_radio.addEventListener("click", function(){
        if(!click){
            $(this).attr("checked", "checked");
            $upfile.style.display = "none";
            click = true;
        }
        else{
            $(this).prop("checked",false);
            $upfile.style.display = "block";
            click = false;
        }
    })
    $file_cv.onchange = function(e) {
        var fileName = this.value;
        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
        if(ext == "pdf"){
            remove_img_cv.style.display = "block";
            $src_cv.src = URL.createObjectURL(e.target.files[0]);
            remove_img_cv.addEventListener("click", function(){
                $src_cv.src = "";
                remove_img_cv.style.display = "none";
                $choice_profile_cv.style.display = "block";
            })
            if($src_cv.src != null){
                $choice_profile_cv.style.display = "none";
            }
            else{
                $choice_profile_cv.style.display = "block";
            }
        }
        else{
            alert("Chỉ được chọn file pdf");
            $src_cv.src = "";
            $choice_profile_cv.style.display = "block";
        }
    }

}
function file_cv(){
    
}
function close_choice_role_form(){
    document.getElementById("choice_role").style.display = "none";
}

function show_choice_role_form(){
    var choice_role = document.getElementById("choice_role");
    choice_role.style.display = "block"; 
}



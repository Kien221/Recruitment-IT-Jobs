
<div class="end-header">       
               <div class="row">
                   <div class="col-md-4">
                       <div class="search-input">
                           <input type="text" placeholder="Bạn đang tìm kiếm công việc về ngôn ngữ..." id="search_by_language">
                       </div>
                   </div>
                   <div class="col-md-3">
                       <div class="fillter">
                           <span class="icon-header_fillter">
                               <i class="fa-solid fa-building"></i>
                           </span>
                           <select name="" id="search_by_positions">
                               <option value=""> Vị trí công việc</option>
                               <option value="intern">intern</option>
                               <option value="fresher">fresher</option>
                               <option value="junior">junior</option>
                               <option value="senior">senior</option>
                               <option value="leader">leader</option>
                           </select>
                       </div>
                   </div>
                  
                   <div class="col-md-3">
                       <div class="fillter">
                           <span class="icon-header_fillter">  
                               <i class="fa-solid fa-location-dot"></i>
                           </span>
                           <select name="" id="choice_city">
                               <option value="">Địa Điểm</option>
                           </select>
                       </div>
                   </div>
                   <div class="col-md-2">
                       <div class="fillter search_header" id="search_header">
                          <i class="fa-solid fa-magnifying-glass"></i> Tìm Kiếm
                       </div>
                   </div>
               </div>
  
       </div>
    </div>
    <div id="search_results">
                <div id="content-cv">
                </div>
            </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(async function(){
            const response = await fetch('{{asset('locations/index.json')}}');
            const cities = await response.json();
            $.each(cities, function (index, each){      
                   $('#choice_city').append(`
                   <option value='${index}' data-path='${each.file_path}'>${index}</option>
                   `);
   
            })
            $('#search_header').on('click',function(){
                $('#search_results').css('display','block');
                let search_by_language = $('#search_by_language').val();
                let search_by_positions = $('#search_by_positions').val();
                let choice_city = $('#choice_city').val();
                console.log(search_by_language,search_by_positions,choice_city);

                $.ajax({
                    url: '{{route('search')}}',
                    type: 'GET',
                    data: {
                        search_by_language: search_by_language,
                        search_by_positions: search_by_positions,
                        choice_city: choice_city,
                    },
                    dataType:'json',
                    success: function (data) {
                        $('#content-cv').html(data.data);  
                        $('.close').click(function(){
                        $('#search_results').css('display','none');
                    
                })
                    },
                    error:function(error){
                        console.log(error);
                    }
                })
            })

        })


    </script>
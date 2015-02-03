@extends('main')
@section('title')
	Item
@endsection
@section('content')
<div class="container item">
    <div class="container">
    <div class="row">
        <div class="col-xs-10">
            
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-striped table-budget" id="table-item">
                        <thead>
                            <th colspan="2">Category</th>
                            <th>Range1</th>
                            <th>Range2</th>
                            <th>Range3</th>
                            <th>Range4</th>
                            <th>Range5</th>
                            <th>
                                <a href="#" id="budget_all_item_sign_down"><i class="glyphicon glyphicon-chevron-down"></i></a>
                                <a href="#" id="budget_all_item_sign_up"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                <!-- display or hide all items -->
                                <script type="text/javascript">
                                    $('#budget_all_item_sign_up').click(function(){
                                        $('.budget_item_cat').hide();
                                        $('.budget_item_sign_down').show();
                                        $('.budget_item_sign_up').hide(); 
                                        $(".showhide").hide();                                       
                                    });
                                    $('#budget_all_item_sign_down').click(function(){
                                        $('.budget_item_cat').show();
                                        $('.budget_item_sign_down').hide();
                                        $('.budget_item_sign_up').show(); 
                                        $(".showhide").show();  

                                    });
                                </script>

                            </th>
                        </thead>
                        <tbody id="first">
                        @foreach(Category::get() as $key=>$category)
                            <tr class="budget_cat{{$category->id}}">
                                <td></td>
                                
                                <td><strong>{{$category->name}}</strong>

                                </td>
                                <td>
                                    <a onclick="clcate1({{$category->id}})" class="{{$category->id}}_cate_show_hide ">{{round($category->range1,2)}}</a><span class="{{$category->id}}_percent_show_hide"></span>                                    
                                    <input onkeyup="key_range1(event,{{$category->id}})" onchange="v_fChangecate1({{$category->id}})" ondblclick="dbcate1({{$category->id}})" type="text" style="width:150px;display:none;" class="{{$category->id}}_cate_slidingDiv" name="range1" value="{{round($category->range1,2)}}">                                    
                                    <input type="hidden" name="{{$category->id}}" value="{{$category->id}}">
                                    <p class="{{$category->id}}_mgss_cate_1"style="display:none;color:red;">Must Enter Range1!</p>
                                </td>
                                <td>
                                    <a onclick="clcate2({{$category->id}})"class="{{$category->id}}_cate_show_hide1 ">{{round($category->range2,2)}}</a><span class="{{$category->id}}_percent_show_hide1"></span>                                    
                                    <input onkeyup="key_range2(event,{{$category->id}})" onchange="v_fChangecate2({{$category->id}})" ondblclick="dbcate2({{$category->id}})" type="text" style="width:150px;display:none;" class="{{$category->id}}_cate_slidingDiv1" name="range2" value="{{round($category->range2,2)}}">
                                    <input type="hidden" name="{{$category->id}}" value="{{$category->id}}">
                                    <p class="{{$category->id}}_mgss_cate_2"style="display:none;color:red;">Must Enter Range2!</p>
                                </td>
                                <td>
                                    <a onclick="clcate3({{$category->id}})"class="{{$category->id}}_cate_show_hide2 ">{{round($category->range3,2)}}</a><span class="{{$category->id}}_percent_show_hide2"></span>                                    
                                    <input onkeyup="key_range3(event,{{$category->id}})" onchange="v_fChangecate3({{$category->id}})" ondblclick="dbcate3({{$category->id}})" type="text" style="width:150px;display:none;" class="{{$category->id}}_cate_slidingDiv2" name="range3" value="{{round($category->range3,2)}}">
                                    <input type="hidden" name="{{$category->id}}" value="{{$category->id}}">
                                    <p class="{{$category->id}}_mgss_cate_3"style="display:none;color:red;">Must Enter Range3!</p>
                                </td>
                                <td>
                                    <a onclick="clcate4({{$category->id}})"class="{{$category->id}}_cate_show_hide3 ">{{round($category->range4,2)}}</a><span class="{{$category->id}}_percent_show_hide3"></span>                                    
                                    <input onkeyup="key_range4(event,{{$category->id}})" onchange="v_fChangecate4({{$category->id}})" ondblclick="dbcate4({{$category->id}})"type="text" style="width:150px;display:none;" class="{{$category->id}}_cate_slidingDiv3" name="range4" value="{{round($category->range4,2)}}">
                                    <input type="hidden" name="{{$category->id}}" value="{{$category->id}}">
                                    <p class="{{$category->id}}_mgss_cate_4"style="display:none;color:red;">Must Enter Range4!</p>
                                </td>
                                <td>
                                    <a onclick="clcate5({{$category->id}})"class="{{$category->id}}_cate_show_hide4 ">{{round($category->range5,2)}}</a><span class="{{$category->id}}_percent_show_hide4"></span>                                    
                                    <input onkeyup="key_range5(event,{{$category->id}})" onchange="v_fChangecate5({{$category->id}})" ondblclick="dbcate5({{$category->id}})" type="text" style="width:150px;display:none;" class="{{$category->id}}_cate_slidingDiv4" name="range5" value="{{round($category->range5,2)}}">
                                    <input type="hidden" name="{{$category->id}}" value="{{$category->id}}">
                                    <p class="{{$category->id}}_mgss_cate_5"style="display:none;color:red;">Must Enter Range5!</p>
                                </td>
                                    <!-- -Script Update Category Range  -->
                                    <script type="text/javascript">

                                            function clcate1(the_i_CateId){
                                                    $("."+the_i_CateId+"_cate_show_hide").hide();
                                                    $("."+the_i_CateId+"_percent_show_hide").hide();                                                                                                
                                                     $("."+the_i_CateId+"_cate_slidingDiv").show();                                                                                                   
                                                 };   
                                                
                                                function dbcate1(the_i_CateId)
                                                {
                                                    if ($("."+the_i_CateId+"_cate_slidingDiv").val()=="") 
                                                    {
                                                        $("."+the_i_CateId+"_cate_slidingDiv").show();
                                                        $("."+the_i_CateId+"_mgss_cate_1").show();
                                                       
                                                        
                                                    } 
                                                    else
                                                    { 
                                                        $("."+the_i_CateId+"_cate_slidingDiv").hide(); 
                                                        $("."+the_i_CateId+"_cate_show_hide").show();
                                                        $("."+the_i_CateId+"_percent_show_hide").show();  
                                                    };                                                 
                                                };

                                                function v_fChangecate1(the_i_CateId){ 
                                                    if ($("."+the_i_CateId+"_cate_slidingDiv").val()=="") 
                                                    {
                                                        $("."+the_i_CateId+"_cate_slidingDiv").show();
                                                        $("."+the_i_CateId+"_mgss_cate_1").show();
                                                       
                                                        
                                                    } 
                                                    else{                                                                                                       
                                                    $.ajax({
                                                        type: "post",
                                                        url: "{{URL::route('updateCate1')}}",
                                                        data: {range1: $("."+the_i_CateId+"_cate_slidingDiv").val(),
                                                                id: $("."+the_i_CateId+"_cate_slidingDiv").next().val()
                                                        }
                                                        
                                                        });
                                                    $("."+the_i_CateId+"_cate_show_hide").text($("."+the_i_CateId+"_cate_slidingDiv").val());
                                                    $("."+the_i_CateId+"_cate_slidingDiv").hide();
                                                    $("."+the_i_CateId+"_cate_show_hide").show();
                                                    $("."+the_i_CateId+"_percent_show_hide").show();  
                                                    $("."+the_i_CateId+"_mgss_cate_1").hide();
                                                       
                                                   };
                                                };
                                                                
                                            function key_range1(event,id) {     
                                                 if(event.which >= 37 && event.which <= 40) return;
                                                     $("."+id+"_cate_slidingDiv").val(function(index, value) {
                                                            return value
                                                                .replace(/[^0-9.]/g, '')
                                                                //.replace(/\B(?=(\d{3})+(?!\d))/g, "")
                                                            ;
                                                        });
                                                };
                                            function clcate2(the_i_CateId){
                                                    $("."+the_i_CateId+"_cate_show_hide1").hide();
                                                    $("."+the_i_CateId+"_percent_show_hide1").hide();                                                                                                
                                                     $("."+the_i_CateId+"_cate_slidingDiv1").show();                                                                                                   
                                                 };   
                                                
                                                function dbcate2(the_i_CateId)
                                                {
                                                    if ($("."+the_i_CateId+"_cate_slidingDiv1").val()=="") 
                                                    {
                                                        $("."+the_i_CateId+"_cate_slidingDiv1").show();
                                                        $("."+the_i_CateId+"_mgss_cate_2").show();
                                                       
                                                        
                                                    } 
                                                    else
                                                    { 
                                                        $("."+the_i_CateId+"_cate_slidingDiv1").hide(); 
                                                        $("."+the_i_CateId+"_cate_show_hide1").show();
                                                        $("."+the_i_CateId+"_percent_show_hide1").show();  
                                                    };                                                 
                                                };

                                                function v_fChangecate2(the_i_CateId){ 
                                                    if ($("."+the_i_CateId+"_cate_slidingDiv1").val()=="") 
                                                    {
                                                        $("."+the_i_CateId+"_cate_slidingDiv1").show();
                                                         $("."+the_i_CateId+"_mgss_cate_2").show();
                                                       
                                                        
                                                    } 
                                                    else{                                                                                                       
                                                    $.ajax({
                                                        type: "post",
                                                        url: "{{URL::route('updateCate2')}}",
                                                        data: {range2: $("."+the_i_CateId+"_cate_slidingDiv1").val(),
                                                                id: $("."+the_i_CateId+"_cate_slidingDiv1").next().val()
                                                        }
                                                        
                                                        });
                                                    $("."+the_i_CateId+"_cate_show_hide1").text($("."+the_i_CateId+"_cate_slidingDiv1").val());
                                                    $("."+the_i_CateId+"_cate_slidingDiv1").hide();
                                                    $("."+the_i_CateId+"_cate_show_hide1").show();
                                                    $("."+the_i_CateId+"_percent_show_hide1").show(); 
                                                    $("."+the_i_CateId+"_mgss_cate_2").hide();
                                                       
                                                   };
                                                };
                                                function key_range2(event,id) {     
                                                 if(event.which >= 37 && event.which <= 40) return;
                                                     $("."+id+"_cate_slidingDiv1").val(function(index, value) {
                                                            return value
                                                                .replace(/[^0-9.]/g, '')
                                                               // .replace(/\B(?=(\d{3})+(?!\d))/g, "")
                                                            ;
                                                        });
                                                };
                                                
                                                function clcate3(the_i_CateId){
                                                    $("."+the_i_CateId+"_cate_show_hide2").hide();
                                                    $("."+the_i_CateId+"_percent_show_hide2").hide();                                                                                                
                                                     $("."+the_i_CateId+"_cate_slidingDiv2").show();                                                                                                   
                                                 };   
                                                
                                                function dbcate3(the_i_CateId)
                                                {
                                                    if ($("."+the_i_CateId+"_cate_slidingDiv2").val()=="") 
                                                    {
                                                        $("."+the_i_CateId+"_cate_slidingDiv2").show();
                                                        $("."+the_i_CateId+"_mgss_cate_3").show();
                                                       
                                                        
                                                    } 
                                                    else
                                                    { 
                                                        $("."+the_i_CateId+"_cate_slidingDiv2").hide(); 
                                                        $("."+the_i_CateId+"_cate_show_hide2").show();
                                                        $("."+the_i_CateId+"_percent_show_hide2").show();  
                                                    };                                                 
                                                };

                                                function v_fChangecate3(the_i_CateId){ 
                                                    if ($("."+the_i_CateId+"_cate_slidingDiv2").val()=="") 
                                                    {
                                                        $("."+the_i_CateId+"_cate_slidingDiv2").show();
                                                        $("."+the_i_CateId+"_mgss_cate_3").show();
                                                       
                                                        
                                                    } 
                                                    else{                                                                                                       
                                                    $.ajax({
                                                        type: "post",
                                                        url: "{{URL::route('updateCate3')}}",
                                                        data: {range3: $("."+the_i_CateId+"_cate_slidingDiv2").val(),
                                                                id: $("."+the_i_CateId+"_cate_slidingDiv2").next().val()
                                                        }
                                                        
                                                        });
                                                    $("."+the_i_CateId+"_cate_show_hide2").text($("."+the_i_CateId+"_cate_slidingDiv2").val());
                                                    $("."+the_i_CateId+"_cate_slidingDiv2").hide();
                                                    $("."+the_i_CateId+"_cate_show_hide2").show();
                                                    $("."+the_i_CateId+"_percent_show_hide2").show();
                                                    $("."+the_i_CateId+"_mgss_cate_3").hide();
                                                       
                                                   };
                                                };
                                                function key_range3(event,id) {     
                                                 if(event.which >= 37 && event.which <= 40) return;
                                                     $("."+id+"_cate_slidingDiv2").val(function(index, value) {
                                                            return value
                                                                .replace(/[^0-9.]/g, '')
                                                               // .replace(/\B(?=(\d{3})+(?!\d))/g, "")
                                                            ;
                                                        });
                                                };

                                                function clcate4(the_i_CateId){
                                                    $("."+the_i_CateId+"_cate_show_hide3").hide();
                                                    $("."+the_i_CateId+"_percent_show_hide3").hide();                                                                                                
                                                     $("."+the_i_CateId+"_cate_slidingDiv3").show();                                                                                                   
                                                 };   
                                                
                                                function dbcate4(the_i_CateId)
                                                {
                                                    if ($("."+the_i_CateId+"_cate_slidingDiv3").val()=="") 
                                                    {
                                                        $("."+the_i_CateId+"_cate_slidingDiv3").show();
                                                        $("."+the_i_CateId+"_mgss_cate_4").show();
                                                       
                                                       
                                                    } 
                                                    else
                                                    { 
                                                        $("."+the_i_CateId+"_cate_slidingDiv3").hide(); 
                                                        $("."+the_i_CateId+"_cate_show_hide3").show();
                                                        $("."+the_i_CateId+"_percent_show_hide3").show();  
                                                    };                                                 
                                                };

                                                function v_fChangecate4(the_i_CateId){ 
                                                    if ($("."+the_i_CateId+"_cate_slidingDiv3").val()=="") 
                                                    {
                                                        $("."+the_i_CateId+"_cate_slidingDiv3").show();
                                                        $("."+the_i_CateId+"_mgss_cate_4").show();
                                                       
                                                        
                                                    } 
                                                    else{                                                                                                       
                                                    $.ajax({
                                                        type: "post",
                                                        url: "{{URL::route('updateCate4')}}",
                                                        data: {range4: $("."+the_i_CateId+"_cate_slidingDiv3").val(),
                                                                id: $("."+the_i_CateId+"_cate_slidingDiv3").next().val()
                                                        }
                                                        
                                                        });
                                                    $("."+the_i_CateId+"_cate_show_hide3").text($("."+the_i_CateId+"_cate_slidingDiv3").val());
                                                    $("."+the_i_CateId+"_cate_slidingDiv3").hide();
                                                    $("."+the_i_CateId+"_cate_show_hide3").show();
                                                    $("."+the_i_CateId+"_percent_show_hide3").show(); 
                                                    $("."+the_i_CateId+"_mgss_cate_4").hide();
                                                       
                                                   };
                                                };
                                                function key_range4(event,id) {     
                                                 if(event.which >= 37 && event.which <= 40) return;
                                                     $("."+id+"_cate_slidingDiv3").val(function(index, value) {
                                                            return value
                                                                .replace(/[^0-9.]/g, '')
                                                                //.replace(/\B(?=(\d{3})+(?!\d))/g, "")
                                                            ;
                                                        });
                                                };
                                                function clcate5(the_i_CateId){
                                                    $("."+the_i_CateId+"_cate_show_hide4").hide();
                                                    $("."+the_i_CateId+"_percent_show_hide4").hide();                                                                                                
                                                     $("."+the_i_CateId+"_cate_slidingDiv4").show();                                                                                                   
                                                 };   
                                                
                                                function dbcate5(the_i_CateId)
                                                {
                                                    if ($("."+the_i_CateId+"_cate_slidingDiv4").val()=="") 
                                                    {
                                                        $("."+the_i_CateId+"_cate_slidingDiv4").show();
                                                        $("."+the_i_CateId+"_mgss_cate_5").show();
                                                       
                                                        
                                                    } 
                                                    else
                                                    { 
                                                        $("."+the_i_CateId+"_cate_slidingDiv4").hide(); 
                                                        $("."+the_i_CateId+"_cate_show_hide4").show();
                                                        $("."+the_i_CateId+"_percent_show_hide4").show();  
                                                    };                                                 
                                                };

                                                function v_fChangecate5(the_i_CateId){ 
                                                    if ($("."+the_i_CateId+"_cate_slidingDiv4").val()=="") 
                                                    {
                                                        $("."+the_i_CateId+"_cate_slidingDiv4").show();
                                                        $("."+the_i_CateId+"_mgss_cate_5").show();
                                                       
                                                        
                                                    } 
                                                    else{                                                                                                       
                                                    $.ajax({
                                                        type: "post",
                                                        url: "{{URL::route('updateCate5')}}",
                                                        data: {range5: $("."+the_i_CateId+"_cate_slidingDiv4").val(),
                                                                id: $("."+the_i_CateId+"_cate_slidingDiv4").next().val()
                                                        }
                                                        
                                                        });
                                                    $("."+the_i_CateId+"_cate_show_hide4").text($("."+the_i_CateId+"_cate_slidingDiv4").val());
                                                    $("."+the_i_CateId+"_cate_slidingDiv4").hide();
                                                    $("."+the_i_CateId+"_cate_show_hide4").show();
                                                    $("."+the_i_CateId+"_percent_show_hide4").show();
                                                    $$("."+the_i_CateId+"_mgss_cate_5").hide();
                                                       
                                                   };
                                                };
                                                function key_range5(event,id) {     
                                                 if(event.which >= 37 && event.which <= 40) return;
                                                     $("."+id+"_cate_slidingDiv4").val(function(index, value) {
                                                            return value
                                                                .replace(/[^0-9.]/g, '')
                                                                //.replace(/\B(?=(\d{3})+(?!\d))/g, "")
                                                            ;
                                                        });
                                                };


                                            
                                                                
                                        </script><!-- -end Script -->

                                
                                                            
                                                             
                                                          

                                <td>
                                    <span class="budget_item_sign_up{{$category->id}} budget_item_sign_up"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                    <span class="budget_item_sign_down{{$category->id}} budget_item_sign_down" style="display:none;"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                    <!-- display or hide a item -->
                                    <script type="text/javascript">
                                        $('.budget_item_sign_up{{$category->id}}').click(function(){
                                            $('.item_admin{{$category->id}}').hide();
                                            $('.budget_item_sign_up{{$category->id}}').hide();
                                            $('.budget_item_sign_down{{$category->id}}').show();
                                            
                                            
                                        });
                                        $('.budget_item_sign_down{{$category->id}}').click(function(){
                                            $('.item_admin{{$category->id}}').show();
                                            $('.budget_item_sign_up{{$category->id}}').show();
                                            $('.budget_item_sign_down{{$category->id}}').hide();
                                           
                                            
                                        });
                                    </script>
                                </td>
                            
                            </tr>
                            <tbody class="item_admin{{$category->id}} budget_item_cat">
                                @foreach(Budget::where('category',$category->id)->get() as $budget)
                                <tr class="budget_item_cat{{$budget->id}} ">
                                    <td>
                                    <input type="hidden" value="{{$budget->id}}">
                                    </td>
                                    <td>
                                        <div>
                                            <a  onclick="cl({{$budget->id}})" class="{{$budget->id}}_show_hide ">{{$budget->item}}</a>
                                            <input onchange="v_fChange({{$budget->id}})" ondblclick="db({{$budget->id}})"type="text" style="width:150px;display:none;" class="{{$budget->id}}_slidingDiv" name="item" value="{{$budget->item}}">
                                            <input type="hidden" name="{{$budget->id}}" value="{{$budget->id}}">
                                            <p class="{{$budget->id}}_mgss_item_1"style="display:none;color:red;">Must Enter Item!</p>
                                         </div>
                                         
                                    </td>
                                    <td>
                                        <div>
                                            <a onclick="cl1({{$budget->id}})" class="{{$budget->id}}_show_hide1 ">{{round($budget->range1,2)}}</a><span class="{{$budget->id}}_percent_item_show_hide1"></span>                                                                                                                          
                                            <input onkeyup="key_item_range1(event,{{$budget->id}})" onchange="v_fChange1({{$budget->id}})" ondblclick="db1({{$budget->id}})"type="text" style="width:150px;display:none;" class="{{$budget->id}}_slidingDiv1" name="range1" value="{{round($budget->range1,2)}}">
                                            <input type="hidden" name="{{$budget->id}}" value="{{$budget->id}}">
                                            <p class="{{$budget->id}}_mgss_item_2"style="display:none;color:red;">Must Enter Range1!</p>
                                         </div>
                                    </td>
                                    <td>
                                        <div>
                                            <a onclick="cl2({{$budget->id}})" class="{{$budget->id}}_show_hide2 ">{{round($budget->range2,2)}}</a><span class="{{$budget->id}}_percent_item_show_hide2"></span>                                                                                                                           
                                           <input onkeyup="key_item_range2(event,{{$budget->id}})" onchange="v_fChange2({{$budget->id}})" ondblclick="db2({{$budget->id}})" type="text" style="width:150px;display:none;" class="{{$budget->id}}_slidingDiv2" name="range2" value="{{round($budget->range2,2)}}">
                                           <input type="hidden" name="{{$budget->id}}" value="{{$budget->id}}">  
                                           <p class="{{$budget->id}}_mgss_item_3"style="display:none;color:red;">Must Enter Range2!</p>
                                         </div>

                                    </td>
                                    <td>
                                        <div>
                                            <a onclick="cl3({{$budget->id}})" class="{{$budget->id}}_show_hide3 ">{{round($budget->range3,2)}}</a><span class="{{$budget->id}}_percent_item_show_hide3"></span>                                                                                  
                                            <input onkeyup="key_item_range3(event,{{$budget->id}})" onchange="v_fChange3({{$budget->id}})" ondblclick="db3({{$budget->id}})" type="text" style="width:150px;display:none;" class="{{$budget->id}}_slidingDiv3" name="range3" value="{{round($budget->range3,2)}}">
                                            <input type="hidden" name="{{$budget->id}}" value="{{$budget->id}}">
                                            <p class="{{$budget->id}}_mgss_item_4"style="display:none;color:red;">Must Enter Range3!</p>
                                         </div>
                                    </td>
                                    <td>
                                        <div>
                                            <a onclick="cl4({{$budget->id}})" class="{{$budget->id}}_show_hide4 ">{{round($budget->range4,2)}}</a><span class="{{$budget->id}}_percent_item_show_hide4"></span>                                                                                  
                                            <input onkeyup="key_item_range4(event,{{$budget->id}})" onchange="v_fChange4({{$budget->id}})" ondblclick="db4({{$budget->id}})" type="text" style="width:150px;display:none;" class="{{$budget->id}}_slidingDiv4" name="range4" value="{{round($budget->range4,2)}}">
                                            <input type="hidden" name="{{$budget->id}}" value="{{$budget->id}}">
                                            <p class="{{$budget->id}}_mgss_item_5"style="display:none;color:red;">Must Enter Range4!</p>
                                         </div>
                                    </td>
                                    <td>
                                        <div>
                                            <a onclick="cl5({{$budget->id}})" class="{{$budget->id}}_show_hide5 ">{{round($budget->range5,2)}}</a><span class="{{$budget->id}}_percent_item_show_hide5"></span>                                                                                  
                                            <input onkeyup="key_item_range5(event,{{$budget->id}})" onchange="v_fChange5({{$budget->id}})" ondblclick="db5({{$budget->id}})" type="text" style="width:150px;display:none;" class="{{$budget->id}}_slidingDiv5" name="range5" value="{{round($budget->range5,2)}}">
                                            <input type="hidden" value="{{$budget->id}}">
                                            <p class="{{$budget->id}}_mgss_item_6"style="display:none;color:red;">Must Enter Range5!</p>
                                         </div>
                                    </td>

                                        <!-- -Script Onclick show Input New Item -->

                                        
                                        <!-- -Script Update Item -->
                                        

                                    <td>
        
                                        <a class="budget_icon_trash" class="confirm" onclick="deleteItem({{$budget->id}})" href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i></a>
                                        <input type="hidden" class="deleteItem{{$budget->id}}" name="{{$budget->id}}" value="{{$budget->id}}">
                                    </td>
                                                        <script>
                                                            function deleteItem(id){
                                                                if(confirm("Are you sure you want to delete this?")){
                                                                    $.ajax({
                                                                        type: "post",
                                                                        url: "{{URL::route('deleteItem')}}",
                                                                        data: {
                                                                                id:$(".deleteItem"+id).val()

                                                                        },
                                                                        success:function(){
                                                                            $(".budget_item_cat"+id).remove();
                                                                        }
                                                                    });

                                                                }
                                                                else{
                                                                    return false;
                                                                };
                                                            };
                                                        </script>
                                   
                                </tr>
                            
                                                           
                                                            

                                @endforeach
                                <tr>
                                    <td></td>
                                   
                                    <td colspan="7">
                                        <a onclick="addItem({{$category->id}})" href="javascript:void(0)" style="cursor:pointer;" id="add_item{{$category->id}}">
                                            <i class="glyphicon glyphicon-plus"></i>&nbsp Add Item
                                        </a>
                                        <input type="hidden" class="addItem{{$category->id}}" value="{{$category->id}}" name="{{$category->id}}">
                                    </td>
                                    <!-- -Script add new Item -->
                                    <script type="text/javascript">

                                                           function addItem(id){
                                                            $.ajax({
                                                                        type: "post",
                                                                        url: "{{URL::route('add')}}",
                                                                        data: {
                                                                                id:$('.addItem'+id).val()

                                                                        },
                                                                        success: function(data){
                                                                           
                                                                            var obj = JSON.parse(data);
                                                                        if (obj.item_last) {
                                                                            $('.budget_item_cat'+obj.item_last).after(obj.html);
                                                                            //$('.budget_item_cat'+obj.item).show();
                                                                        } else{
                                                                            $('.budget_cat'+id).after(obj.html);
                                                                        };
                                                                        $('.budget_item_cat'+obj.item).show();
                                                                                
                                                                        }
                                                                        

                                                                    });
                                                              };


                                    </script>
                                </tr>
                             </tbody>   
                        @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div> <!-- col-xs-10 -->
        <script type="text/javascript">
                                            function cl(the_i_BugetId){
                                                    if($("."+the_i_BugetId+"_slidingDiv").val()=="New Item"){
                                                    $("."+the_i_BugetId+"_show_hide").hide();                                                    
                                                    $("."+the_i_BugetId+"_slidingDiv").val("") 
                                                    $("."+the_i_BugetId+"_slidingDiv").show();
                                                 }
                                                 else
                                                 {
                                                    $("."+the_i_BugetId+"_show_hide").hide();
                                                    $("."+the_i_BugetId+"_slidingDiv").show();
                                                 };   
                                                };
                                                function db(the_i_BugetId)
                                                {
                                                    if ($("."+the_i_BugetId+"_slidingDiv").val()=="") 
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv").show();
                                                        $("."+the_i_BugetId+"_mgss_item_1").show();
                                                        

                                                    } 

                                                    else
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv").hide(); 
                                                        $("."+the_i_BugetId+"_show_hide").show();
};                                                   };

                                                function v_fChange(the_i_BugetId){ 
                                                    if ($("."+the_i_BugetId+"_slidingDiv").val()=="") 
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv").show();
                                                        $("."+the_i_BugetId+"_mgss_item_1").show();
                                                        
                                                        
                                                    } 
                                                    else{                                                                                                       
                                                    $.ajax({
                                                        type: "post",
                                                        url: "{{URL::route('updateItem')}}",
                                                        data: {item: $("."+the_i_BugetId+"_slidingDiv").val(),
                                                                id: $("."+the_i_BugetId+"_slidingDiv").next().val()
                                                        }
                                                        
                                                        });
                                                    $("."+the_i_BugetId+"_show_hide").text($("."+the_i_BugetId+"_slidingDiv").val());
                                                    $("."+the_i_BugetId+"_slidingDiv").hide();
                                                    $("."+the_i_BugetId+"_show_hide").show();
                                                    $("."+the_i_BugetId+"_mgss_item_1").hide();
                                                        
                                                   };
                                                };

                                            function cl1(the_i_BugetId){
                                                    if($("."+the_i_BugetId+"_slidingDiv1").val()=="0"){
                                                    $("."+the_i_BugetId+"_show_hide1").hide();
                                                    $("."+the_i_BugetId+"_percent_item_show_hide1").hide();                                                                                                
                                                    $("."+the_i_BugetId+"_slidingDiv1").val(""); 
                                                    $("."+the_i_BugetId+"_slidingDiv1").show();
                                                 }
                                                 else
                                                 {
                                                    $("."+the_i_BugetId+"_show_hide1").hide();
                                                    $("."+the_i_BugetId+"_percent_item_show_hide1").hide();  
                                                    $("."+the_i_BugetId+"_slidingDiv1").show();
                                                 };   
                                                };
                                                function db1(the_i_BugetId)
                                                {
                                                    if ($("."+the_i_BugetId+"_slidingDiv1").val()=="") 
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv1").show();
                                                        $("."+the_i_BugetId+"_mgss_item_2").show();

                                                    } 

                                                    else
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv1").hide(); 
                                                        $("."+the_i_BugetId+"_show_hide1").show();
                                                        $("."+the_i_BugetId+"_percent_item_show_hide1").show();  
                                                    };                                                   
                                                };

                                                function v_fChange1(the_i_BugetId){ 
                                                    if ($("."+the_i_BugetId+"_slidingDiv1").val()=="") 
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv1").show();
                                                        $("."+the_i_BugetId+"_mgss_item_2").show();
                                                        
                                                    } 
                                                    else{                                                                                                       
                                                    $.ajax({
                                                        type: "post",
                                                        url: "{{URL::route('updateRange1')}}",
                                                        data: {range1: $("."+the_i_BugetId+"_slidingDiv1").val(),
                                                                id: $("."+the_i_BugetId+"_slidingDiv1").next().val()
                                                        }
                                                        
                                                        });
                                                    $("."+the_i_BugetId+"_show_hide1").text($("."+the_i_BugetId+"_slidingDiv1").val());
                                                    $("."+the_i_BugetId+"_slidingDiv1").hide();
                                                    $("."+the_i_BugetId+"_show_hide1").show();
                                                    $("."+the_i_BugetId+"_percent_item_show_hide1").show(); 
                                                    $("."+the_i_BugetId+"_mgss_item_2").hide(); 
                                                   };
                                                };
                                                function key_item_range1(event,id) {     
                                                 if(event.which >= 37 && event.which <= 40) return;
                                                     $("."+id+"_slidingDiv1").val(function(index, value) {
                                                            return value
                                                                .replace(/[^0-9.]/g, '')
                                                                //.replace(/\B(?=(\d{3})+(?!\d))/g, "")
                                                            ;
                                                        });
                                                };

                                                 function cl2(the_i_BugetId){
                                                    if($("."+the_i_BugetId+"_slidingDiv2").val()=="0"){
                                                    $("."+the_i_BugetId+"_show_hide2").hide();
                                                    $("."+the_i_BugetId+"_percent_item_show_hide2").hide();                                                                                                
                                                    $("."+the_i_BugetId+"_slidingDiv2").val(""); 
                                                    $("."+the_i_BugetId+"_slidingDiv2").show();
                                                 }
                                                 else
                                                 {
                                                    $("."+the_i_BugetId+"_show_hide2").hide();
                                                    $("."+the_i_BugetId+"_percent_item_show_hide2").hide();  
                                                    $("."+the_i_BugetId+"_slidingDiv2").show();
                                                 };   
                                                };
                                                function db2(the_i_BugetId)
                                                {
                                                    if ($("."+the_i_BugetId+"_slidingDiv2").val()=="") 
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv2").show();
                                                        $("."+the_i_BugetId+"_mgss_item_3").show();

                                                    } 

                                                    else
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv2").hide(); 
                                                        $("."+the_i_BugetId+"_show_hide2").show();
                                                        $("."+the_i_BugetId+"_percent_item_show_hide2").show();  
};                                                   };

                                                function v_fChange2(the_i_BugetId){ 
                                                    if ($("."+the_i_BugetId+"_slidingDiv2").val()=="") 
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv2").show();
                                                        $("."+the_i_BugetId+"_mgss_item_3").show();
                                                        
                                                    } 
                                                    else{                                                                                                       
                                                    $.ajax({
                                                        type: "post",
                                                        url: "{{URL::route('updateRange2')}}",
                                                        data: {range2: $("."+the_i_BugetId+"_slidingDiv2").val(),
                                                                id: $("."+the_i_BugetId+"_slidingDiv2").next().val()
                                                        }
                                                        
                                                        });
                                                    $("."+the_i_BugetId+"_show_hide2").text($("."+the_i_BugetId+"_slidingDiv2").val());
                                                    $("."+the_i_BugetId+"_slidingDiv2").hide();
                                                    $("."+the_i_BugetId+"_show_hide2").show();
                                                    $("."+the_i_BugetId+"_percent_item_show_hide2").show(); 
                                                    $("."+the_i_BugetId+"_mgss_item_3").hide(); 
                                                   };
                                                };
                                                function key_item_range2(event,id) {     
                                                 if(event.which >= 37 && event.which <= 40) return;
                                                     $("."+id+"_slidingDiv2").val(function(index, value) {
                                                            return value
                                                                .replace(/[^0-9.]/g, '')
                                                                //.replace(/\B(?=(\d{3})+(?!\d))/g, "")
                                                            ;
                                                        });
                                                };

                                            function cl3(the_i_BugetId){
                                                    if($("."+the_i_BugetId+"_slidingDiv3").val()=="0"){
                                                    $("."+the_i_BugetId+"_show_hide3").hide();
                                                    $("."+the_i_BugetId+"_percent_item_show_hide3").hide();                                                                                                
                                                    $("."+the_i_BugetId+"_slidingDiv3").val(""); 
                                                    $("."+the_i_BugetId+"_slidingDiv3").show();
                                                 }
                                                 else
                                                 {
                                                    $("."+the_i_BugetId+"_show_hide3").hide();
                                                    $("."+the_i_BugetId+"_percent_item_show_hide3").hide();  
                                                    $("."+the_i_BugetId+"_slidingDiv3").show();
                                                 };   
                                                };
                                                function db3(the_i_BugetId)
                                                {
                                                    if ($("."+the_i_BugetId+"_slidingDiv3").val()=="") 
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv3").show();
                                                        $("."+the_i_BugetId+"_mgss_item_4").show();

                                                    } 

                                                    else
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv3").hide(); 
                                                        $("."+the_i_BugetId+"_show_hide3").show();
                                                        $("."+the_i_BugetId+"_percent_item_show_hide3").show();  
};                                                   };

                                                function v_fChange3(the_i_BugetId){ 
                                                    if ($("."+the_i_BugetId+"_slidingDiv3").val()=="") 
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv3").show();
                                                        $("."+the_i_BugetId+"_mgss_item_4").show();
                                                        
                                                    } 
                                                    else{                                                                                                       
                                                    $.ajax({
                                                        type: "post",
                                                        url: "{{URL::route('updateRange3')}}",
                                                        data: {range3: $("."+the_i_BugetId+"_slidingDiv3").val(),
                                                                id: $("."+the_i_BugetId+"_slidingDiv3").next().val()
                                                        }
                                                        
                                                        });
                                                    $("."+the_i_BugetId+"_show_hide3").text($("."+the_i_BugetId+"_slidingDiv3").val());
                                                    $("."+the_i_BugetId+"_slidingDiv3").hide();
                                                    $("."+the_i_BugetId+"_show_hide3").show();
                                                    $("."+the_i_BugetId+"_percent_item_show_hide3").show(); 
                                                    $("."+the_i_BugetId+"_mgss_item_4").hide(); 
                                                   };
                                                };
                                                function key_item_range3(event,id) {     
                                                 if(event.which >= 37 && event.which <= 40) return;
                                                     $("."+id+"_slidingDiv3").val(function(index, value) {
                                                            return value
                                                                .replace(/[^0-9.]/g, '')
                                                                //.replace(/\B(?=(\d{3})+(?!\d))/g, "")
                                                            ;
                                                        });
                                                };

                                            function cl4(the_i_BugetId){
                                                    if($("."+the_i_BugetId+"_slidingDiv4").val()=="0"){
                                                    $("."+the_i_BugetId+"_show_hide4").hide();
                                                    $("."+the_i_BugetId+"_percent_item_show_hide4").hide();                                                                                                
                                                    $("."+the_i_BugetId+"_slidingDiv4").val(""); 
                                                    $("."+the_i_BugetId+"_slidingDiv4").show();
                                                 }
                                                 else
                                                 {
                                                    $("."+the_i_BugetId+"_show_hide4").hide();
                                                    $("."+the_i_BugetId+"_percent_item_show_hide4").hide();  
                                                    $("."+the_i_BugetId+"_slidingDiv4").show();
                                                 };   
                                                };
                                                function db4(the_i_BugetId)
                                                {
                                                    if ($("."+the_i_BugetId+"_slidingDiv4").val()=="") 
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv4").show();
                                                        $("."+the_i_BugetId+"_mgss_item_5").show();

                                                    } 

                                                    else
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv4").hide(); 
                                                        $("."+the_i_BugetId+"_show_hide4").show();
                                                        $("."+the_i_BugetId+"_percent_item_show_hide4").show();  
};                                                   };

                                                function v_fChange4(the_i_BugetId){ 
                                                    if ($("."+the_i_BugetId+"_slidingDiv4").val()=="") 
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv4").show();
                                                        $("."+the_i_BugetId+"_mgss_item_5").show();
                                                        
                                                    } 
                                                    else{                                                                                                       
                                                    $.ajax({
                                                        type: "post",
                                                        url: "{{URL::route('updateRange4')}}",
                                                        data: {range4: $("."+the_i_BugetId+"_slidingDiv4").val(),
                                                                id: $("."+the_i_BugetId+"_slidingDiv4").next().val()
                                                        }
                                                        
                                                        });
                                                    $("."+the_i_BugetId+"_show_hide4").text($("."+the_i_BugetId+"_slidingDiv4").val());
                                                    $("."+the_i_BugetId+"_slidingDiv4").hide();
                                                    $("."+the_i_BugetId+"_show_hide4").show();
                                                    $("."+the_i_BugetId+"_percent_item_show_hide4").show(); 
                                                    $("."+the_i_BugetId+"_mgss_item_5").hide(); 
                                                   };
                                                };
                                                function key_item_range4(event,id) {     
                                                 if(event.which >= 37 && event.which <= 40) return;
                                                     $("."+id+"_slidingDiv4").val(function(index, value) {
                                                            return value
                                                                .replace(/[^0-9.]/g, '')
                                                                //.replace(/\B(?=(\d{3})+(?!\d))/g, "")
                                                            ;
                                                        });
                                                };

                                                function cl5(the_i_BugetId){
                                                    if($("."+the_i_BugetId+"_slidingDiv5").val()=="0"){
                                                    $("."+the_i_BugetId+"_show_hide5").hide();
                                                    $("."+the_i_BugetId+"_percent_item_show_hide5").hide();                                                                                                
                                                    $("."+the_i_BugetId+"_slidingDiv5").val(""); 
                                                    $("."+the_i_BugetId+"_slidingDiv5").show();
                                                 }
                                                 else
                                                 {
                                                    $("."+the_i_BugetId+"_show_hide5").hide();
                                                    $("."+the_i_BugetId+"_percent_item_show_hide5").hide();  
                                                    $("."+the_i_BugetId+"_slidingDiv5").show();
                                                 };   
                                                };
                                                function db5(the_i_BugetId)
                                                {
                                                    if ($("."+the_i_BugetId+"_slidingDiv5").val()=="") 
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv5").show();
                                                        $("."+the_i_BugetId+"_mgss_item_6").show();

                                                    } 

                                                    else
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv5").hide(); 
                                                        $("."+the_i_BugetId+"_show_hide5").show();
                                                        $("."+the_i_BugetId+"_percent_item_show_hide5").show();  
};                                                   };

                                                function v_fChange5(the_i_BugetId){ 
                                                    if ($("."+the_i_BugetId+"_slidingDiv5").val()=="") 
                                                    {
                                                        $("."+the_i_BugetId+"_slidingDiv5").show();
                                                        $("."+the_i_BugetId+"_mgss_item_6").show();
                                                        
                                                    } 
                                                    else{                                                                                                       
                                                    $.ajax({
                                                        type: "post",
                                                        url: "{{URL::route('updateRange5')}}",
                                                        data: {range5: $("."+the_i_BugetId+"_slidingDiv5").val(),
                                                                id: $("."+the_i_BugetId+"_slidingDiv5").next().val()
                                                        }
                                                        
                                                        });
                                                    $("."+the_i_BugetId+"_show_hide5").text($("."+the_i_BugetId+"_slidingDiv5").val());
                                                    $("."+the_i_BugetId+"_slidingDiv5").hide();
                                                    $("."+the_i_BugetId+"_show_hide5").show();
                                                    $("."+the_i_BugetId+"_percent_item_show_hide5").show();  
                                                    $("."+the_i_BugetId+"_mgss_item_6").hide();
                                                   };
                                                };
                                                function key_item_range5(event,id) {     
                                                 if(event.which >= 37 && event.which <= 40) return;
                                                     $("."+id+"_slidingDiv5").val(function(index, value) {
                                                            return value
                                                                .replace(/[^0-9.]/g, '')
                                                                //.replace(/\B(?=(\d{3})+(?!\d))/g, "")
                                                            ;
                                                        });
                                                };


                                        </script>

       

    </div> <!-- row -->
</div><!--container-->
            
@endsection


                                            
                                                                                 
                                                                 
                                                                                                                      
                                                                             
                                    
                                              
                                        
                                                                                                 
                                                                                                    
                                                                                   
                                         
                                                                      
                         
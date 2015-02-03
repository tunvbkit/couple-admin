@extends('main')
@section('title')
	Task
@endsection
@section('content')
<div class="container task">
<div class="row">
    <div class="col-xs-12 col-md-8 col-lg-6">
        <h1>Task</h1>
    </div>
    <div class="col-xs-10 col-md-6 col-lg-4 search">
        <form id="search-vendor" role="form" action="{{URL::route('search-task')}}" method="post">
            <div class="input-group">
              <input type="text" name="search_name" class="form-control">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Search!</button>
              </span>
            </div><!-- /input-group -->
        </form>
    </div>
</div>
<div class="row">
    <div class="col-xs-10">
    	<ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i><a href="{{Asset('admin/main')}}">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i>Task
            </li>
        </ol>
    </div>
    
</div>
    <div class="row">
    	<div class="col-xs-10">
            <a href="{{URL::route('task/add-task')}}"><button type="submit" class="btn btn-primary" >Add Task</button></a>
            <button type="submit" class="btn btn-danger" id="del_task">Delete Task</button>

            <div class="table-responsive">
              <form action="delSelectTask" method="post" id="delSelectTask">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th Style="width:30px">
                                
                                  <input type="checkbox" class="checkbox " id="select-all">

                                  <script type="text/javascript">
                                        $('#select-all').click(function(event) {
                                              if(this.checked) {
                                                  // Iterate each checkbox
                                                  $(':checkbox').each(function() {
                                                      this.checked = true;
                                                  });
                                              }
                                              else {
                                                $(':checkbox').each(function() {
                                                      this.checked = false;
                                                  });
                                          }
                                        });

                                    </script><!-- -Script select all -->
                          </th>
                            <th Style="width:30px">Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Start Date</th>
                            <th>Link</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($tasks))
                    	@foreach($tasks as $i=>$task)
                            <tr>
                                <td>                                
                                    <input type="checkbox" class="checkbox" value="{{$task->id}}">
                                    <input type="hidden" name="chk-{{$task->id}}" value="" >

                                </td>
                                <td>{{$i+1}}</td>
                                <td>{{$task->title}}
                                    <ul class="menu list-unstyled" role="menu">
                                    	<li ><a href="{{URL::route('task/edit',array($task->id))}}">Edit</a></li>
                                    	<li><a class="confirm" href="{{URL::route('task/delete',array($task->id))}}">Delete</a></li>
                                    </ul>
                                    <script type="text/javascript">
                                    $(".confirm").click(function(){
                                        if(confirm("Are you sure you want to delete this?")){
                                            return true;
                                        }
                                        else{
                                            return false;
                                        }
                                    });
                                    </script>
                                </td>
                                <td>{{$task->description}}</td>
                                <td>{{Task::find($task->id)->category()->get()->first()->name}}</td>
                                <td>{{$task->startdate}}</td>
                                <td>{{$task->link}}</td>
                    
                            </tr>
                        @endforeach()
                        @else <p class="empty">Can't find the results</div>
                        @endif
                                       
                    </tbody>
                </table>
            </form>
            <div class="per_page">{{$tasks->links()}}</div>
            </div><!-- /.table-responsive -->
    	</div><!-- /.col-xs-10 -->
    	<div class="col-xs-2">
    	</div>
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

    <script type="text/javascript">
    $(document).ready(function(){
        var $i=0;
        $('input[type="checkbox"]').click(function(){
            if($(this).is(':checked')) {
                var id= $(this).val();
                $(this).next().val(id);
                $i++;
            }else{
                $(this).next().val("");
                $i--;
            }
        });
        $('#del_task').click(function(){
            if ($i<1) {
                alert('You must check task need delete!');
                return false;
            }else{
                $("#delSelectTask").submit();
            }
        });
    });
</script>
@endsection

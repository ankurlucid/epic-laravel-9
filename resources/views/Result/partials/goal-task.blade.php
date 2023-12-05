<div class="col-md-12">
    <hr>
    <table class="table-responsive p-2" width="100%">
      <tbody><tr>
        <th>Tasks</th>
        <th>Completed</th>
        <th>Missed</th>
      </tr>
     @foreach($taskList as $list)
     @php
        $completed = App\GoalBuddyUpdate::where('task_id',$list['id'])
                          ->where('habit_id',$list['gb_habit_id'])
                          ->whereNull('deleted_at') 
                          ->where('status','1')                
                          ->count();
        $missed = App\GoalBuddyUpdate::where('task_id',$list['id'])
                          ->where('habit_id',$list['gb_habit_id'])
                          ->whereNull('deleted_at') 
                          ->where('status','0')                
                          ->count();
        $total = $completed + $missed ;
     @endphp
      <tr>
        <td>
          <a data-toggle="modal" data-target="#" class="listing-habit-name"><span>{{$list->gb_task_name}}</span></a>

        </td>
        <td>
          <span class="completed-habit">{{$completed}}/{{$total}}</span>
        </td>
        <td>
          <span class="missed-habit">{{$missed}}/{{$total}}</span>
        </td>

      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
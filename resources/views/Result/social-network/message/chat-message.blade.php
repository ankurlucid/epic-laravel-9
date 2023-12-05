@if($user_list == null)
    <div class="alert"> no records found</div>
@else           
 @foreach($user_list as $key => $friend)  
         <!-- <div class="chat_list active_chat"> -->
         {{-- <a href="javascript:;" id="chat-people-list-{{ $friend['client']->id }}" onclick="showSingleChat({{ $friend['client']->id }})"> --}}
         {{-- <a href="javascript:;" id="chat-people-list-{{ $friend['client']->id }}" data-id="{{ $loop->iteration}}"> --}}
          <a href="javascript:;" class="chat-people-list chat-people-list-{{$loop->iteration}}" id="chat-people-list-{{ $loop->iteration}}" onclick="showSingleChat({{ $friend['client']->id }})">
           <div class="chat_list">   
               <div class="chat_people">
                  <div class="chat_img">
                    <img data-author="906" src="{{asset('uploads/thumb_'.$friend['client']['profilepic'])}}" onerror="this.onerror=null;this.src='{{asset('assets/images/no-image-icon.jpg')}}';" alt="user profile image">
                   </div>
                  <div class="chat_ib">
                    <h5>{{$friend['client']->firstname}} {{$friend['client']->lastname}}
                     
                     </h5>
                     <span class="text-msg"><span class="text-msg-less">{!!  substr(strip_tags($friend['message']->message), 0, 20) !!}.</span>
                     </span>  
                     @if($friend['message']->message != "")
                     <span class="chat_date">{{ $friend['message']->created_at->diffForHumans() }} </span>
                     @endif
                  </div>
               </div>
           </div>
         </a>         
  @endforeach
@endif
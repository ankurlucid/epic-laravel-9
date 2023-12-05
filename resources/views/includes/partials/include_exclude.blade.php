@if (count($include_list) > 0)
  @foreach ($include_list as $include)
     <div class="alert alert-success alert-dismissible filters-options ">
        <input name="include-tags[]" value="{{ $include }}" hidden>
        <a  class="close include-close-btn" data-val="{{ $include }}" data-dismiss="alert" aria-label="close" >✕</a>   
        + {{ $include }}                           
     </div>   
    @endforeach
 @endif

 @if (count($exclude_list) > 0)
    @foreach ($exclude_list as $exclude)
        <div class="alert alert-success alert-dismissible filters-options">
            <input  name="exclude-tags[]" value="{{ $exclude }}" hidden>
            <a class="close exclude-close-btn"  data-val="{{ $exclude }}" data-dismiss="alert" aria-label="close" >✕</a>   
            <s>+ {{ $exclude}} </s>                            
        </div>
    @endforeach
 @endif
 @if(count($exclude_list) > 0 || count($include_list) > 0)
    <a class="clear_all_incl_excl">Clear All   </a> 
 @endif
    
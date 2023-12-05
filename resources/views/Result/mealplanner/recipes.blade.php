@extends('Result.masters.app')
@section('page-title')
<span>Recipes</span>
@stop
@section('required-styles')
{!! Html::style('result/css/custom.css?v=' . time()) !!}
{!! Html::style('result/plugins/bootstrap-select-master/css/bootstrap-select.min.css?v=' . time()) !!}
<style type="text/css">
   h1 {
   font-family: "Gotham SSm A", sans-serif;
   text-align: center;
   }
   .main-content {
   background: white;
   }
   .modal-content {
   background: white;
   box-shadow: none;
   border-radius: 0px;
   }
   .pagination0a,
   .pagination>li>span {
      border-radius: 0px;
      /*width: 50px;
      height: 50px;*/
      line-height: 40px;
      background: #eaeaea;
      color: #444;
      font-weight: 400;
      font-family: "Gotham SSm A", sans-serif;
      font-size: 13px;
    font-weight: normal;
    line-height: 16px;
    border: 0px;
    border-radius: 5px;
    padding: 7px 10px;
   }
   .pagination>.disabled>span,
   .pagination>.disabled>span:hover,
   .pagination>.disabled>span:focus,
   .pagination>.disabled>a,
   .pagination>.disabled>a:hover,
   .pagination>.disabled>a:focus {
   color: #777;
   cursor: not-allowed;
   background-color: #eaeaea;
   border-color: #ddd;
   }
   .pagination>li:first-child>a, .pagination>li:first-child>span {
      font-size: 26px;
      font-weight: normal;
      line-height: 16px;
      border-radius: 5px;
      padding: 7px 10px;
   }
   .pagination>.active>a,
   .pagination>.active>span,
   .pagination>.active>a:hover,
   .pagination>.active>span:hover,
   .pagination>.active>a:focus,
   .pagination>.active>span:focus {
   border-color: #d1d1d1 !important;
   background: #d1d1d1 !important;
   color: #444;
   }
   .pagination>li:last-child>a,
   .pagination>li:last-child>span {
   font-size: 26px;
      font-weight: normal;
      line-height: 16px;
      border-radius: 5px;
      padding: 7px 10px;
   }
   .pagination>li:last-child>a,
   .pagination>li:last-child>span {
   color: #ffffff;
   background-color: #f64c1e;
   }
   @media(max-width: 767px) {
      .modal, .modal-dialog {
        z-index: 99999999 !important;
     }
      .pagination li {
         display: none;
      }
      .pagination li:first-child,
         .pagination li:last-child {
         display: inline-block;
      }
      .pagination>li:last-child>a, .pagination>li:last-child>span{
         line-height: 33px;
         height: 50px;
         width: 50px;
      }
      .pagination>li:first-child>a, .pagination>li:first-child>span{
         line-height: 33px;
         height: 50px;
         width: 50px;
      }
      section#page-title {
         display: none;
      }
      header.navbar {
          background: transparent;
      }
      .navbar .navbar-header {
         background: transparent !important;
         border-bottom: 0px;
      }
      .navbar .navbar-header .sidebar-mobile-toggler{
       /*  color: #ffffff !important;*/
      }
   }
   .paginationn>.col-md-6.col-xs-12 {
      width: 100%;
      text-align: center;
   }
   .paginationn .col-sm-text {
      text-align: center;
   }
   .rating__star--checked-new{color:#a18f7a !important}

</style>
@stop
@section('content')
<div class="recipes_mobile_top">
   <span class="recipe_heading">Recipes</span>
</div>
<div class="recipes_for_mobile">
   <form class="filter-sub-cat" id="filter-sub-cat" action="{{route('recipes.list')}}" method="get">
      <div class="recipes-section">
         <div class="recipes-filter">
            <div class="col-md-12 col-xs-12 form-group text-center p-0">
               <div class="filter-box">
               <div class="col-md-4 col-sm-4 col-xs-12 form-group  has-feedback search-box">
               <input type="text" name="search" value="{{ Request::get('search') }}" autofocus="autofocus"
                  class="form-control search-wd search-height" style="<?php echo Request::get('search') ? 'width:100%' : 'width:100%'; ?>"
                  placeholder="Search recipes and more…">
                  <button class="btn btn-primary btn-sm search-submit-btn" type="submit"></button>
               <button class="btn--link css-wga544" type="button"><span class="icon__remove"
                  aria-label="Clear search input"></span></button>
               @if (Request::get('search'))

               @endif
               
               <div class="search-suggested-recipes"></div>
            </div>
         
         
            <div class="col-md-4 col-sm-4 col-xs-12 ingredient-filters">
               <div class="has-feedback float-left">                       
                  <input type="text"  onfocus="removeExclude()"  name="include[]" value="" class="form-control" placeholder="Include Ingredient">
                  <button class="a-e-ingredient">&#43;</button>
               </div>

            </div>
            
            <div class="col-md-4 col-sm-4 col-xs-12 ingredient-filters" >
               <div class="has-feedback float-left">
                  <input type="text"  onfocus="removeInclude()" name="exclude[]" value="" class="form-control" placeholder="Exclude Ingredient">
                  <button class="a-e-ingredient">&#8722;</button>
               </div>
               
            </div>

         </div>

          <div class="col-md-12 col-sm-12 col-xs-12 ingredient-filters" style="margin-top: 10px;">

                @if( isset( $include_list ) && $include_list != null && !empty($include_list) )
                  @foreach ($include_list as $include)
                    <div class="alert alert-success alert-dismissible filters-options">
                       <input name="include[]" value="{{ $include }}" hidden>
                       <a  class="close include-close-btn" data-val="{{ $include }}" data-dismiss="alert" aria-label="close" >✕</a>   
                       + {{ $include }}                           
                    </div>   
                  @endforeach
                @endif
                  
                
                @if( isset( $exclude_list ) && $exclude_list != null && !empty($exclude_list) )
              
                  @foreach ($exclude_list as $exclude)
                  <div class="alert alert-success alert-dismissible filters-options">
                     <input  name="exclude[]" value="{{ $exclude }}" hidden>
                     <a class="close exclude-close-btn"  data-val="{{ $exclude }}" data-dismiss="alert" aria-label="close" >✕</a>   
                     <s>+ {{ $exclude }}</s>                            
                  </div>
                  @endforeach
                  @if(count($exclude_list) > 0 || count($include_list) > 0)
                     <a class="clear_all_incl_excl">Clear All   </a>   
                  @endif

                @endif                      
                  
               </div>
               {{-- </form> --}}
            </div>
            <div class="content__row">
            <div class="col-md-3 col-xs-12 col-sm-3" style="padding-left:0px">
               <button type="button" class="btn btn--outline css-u5bt32" data-toggle="modal"
                  data-target="#filtermodal">Filter</button>
               <div class="hidden-xs">
                  @include('includes.partials.filter_popup')
               </div>
            </div>
            <div class="content__main">
               <div class="dm-flex">
                  <div class="matching-recipes">
                     <span class="search-header__count hidden-sm hidden-md hidden-lg">{{ $meals->total() }} result</span>
                     <span class="search-header__count hidden-xs">{{ $meals->total() }} matching recipes</span>
                  </div>
                  <div class="filter-data">
                     @if (count($sub_cat_name) > 0)
                        @foreach ($sub_cat_name as $cat)
                           <div class="alert alert-success alert-dismissible filters-options">
                              <a data-id="{{ $cat->id }}" class="close sub-cat-filter-tag-remove"
                              data-dismiss="alert" aria-label="close">&#10005;</a>
                              {{ $cat->name }}
                           </div>
                        @endforeach
                     @endif
                     @if (count($recipe_cat_name) > 0)
                     @foreach ($recipe_cat_name as $recipe_cat)
                        <div class="alert alert-success alert-dismissible filters-options">
                           <a data-id="{{ $recipe_cat->id }}" class="close recipe_cat-filter-tag-remove"
                           data-dismiss="alert" aria-label="close">&#10005;</a>
                           {{ $recipe_cat->name }}
                        </div>
                      @endforeach
                    @endif
                     {{-- <a href="{{ route('recipes.list') }}" class="clear-data">Clear all</a> --}}
                     @if(count($recipe_cat_name) > 0 || count($sub_cat_name) > 0)
                     <button class="clear-data">Clear all</button>
                     @endif
                  </div>
                  {{-- 
                  <div class="sort-by">
                     <div class="css-186a4nq-container">
                        <label for="SortbySelect">Sort by : &nbsp;</label>
                        <div class="css-xhvnwj-selectContainer">
                           <span class="css-f4gzkj-arrow"></span>
                           <select id="SortbySelect" class="css-1intgc1-select">
                              <option value="relevance">Relevance</option>
                              <option value="newest">Newest</option>
                              <option value="popular">Popular</option>
                              <option value="rating">Highest Rated</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  --}}
               </div>
               <ul class="recipe_list">
                  @foreach ($meals as $item)
                  <a href="{{ route('recipes.details', $item->id) }}">
                     <li class="">
                        {{-- 
                        <div class="recipe-data mealDiv data-btn" data-id="{{$item->id}}" data-type="Meal">
                        --}}
                        <div class="recipe-data data-btn" data-id="{{ $item->id }}" data-type="Meal">
                           {{-- <div class="imgbox mealDiv" data-id="{{ $item->id }}" data-type="Meal"> --}}
                           <div class="imgbox">
                              <img src="{{ dpSrc($item->mealimages()->pluck('mmi_img_name')->first()) }}">
                           </div>
                           <div class="col-md-12 col-xs-12 h-114">
                              {{-- <a class="mealDiv" data-id="{{ $item->id }}" data-type="Meal"> --}}

                                 <h5>{{ getLimitedString($item['name'], 40) }}</h5>
                              {{-- </a> --}}
                            <div class="recipe-description">{!! getLimitedString($item['description'], 80) !!}</div>
                           </div>
                           <div class="rating collectable__rating">
                              <span>({{$item->getRatingCount()}})</span>
                              @php
                                 $avgRating = 0;
                                 foreach($item->rating as $rating){
                                     $avgRating = $avgRating + $rating['star'];
                                    } 
                                 if($item->getRatingCount() > 0){
                                      $totalAvgRating = $avgRating/$item->getRatingCount();
                                  } else {
                                      $totalAvgRating = 0; 
                                  }
                              @endphp
                              @for($i=5;$i>= 1;$i--)
                              @if($i <= $totalAvgRating)
                              <div aria-hidden="true" class="rating__star rating__star--checked-new">
                                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 23.8">
                                    <path fill="currentColor"
                                       d="M12.5 0l2.9 9.1H25l-7.7 5.6 2.9 9.1-7.7-5.7-7.7 5.7 2.9-9.1L0 9.1h9.6z">
                                    </path>
                                 </svg>
                              </div>      
                              @else
                              <div aria-hidden="true" class="rating__star">
                                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 23.8">
                                    <path fill="currentColor"
                                       d="M12.5 0l2.9 9.1H25l-7.7 5.6 2.9 9.1-7.7-5.7-7.7 5.7 2.9-9.1L0 9.1h9.6z">
                                    </path>
                                 </svg>
                              </div>  
                              @endif
                              @endfor
                           </div>
                           <a class="btn btn-xs btn-default tooltips save-btn"
                              href="{{ route('meals.download', $item->id) }}" data-placement="top"
                              data-original-title="Download">
                              <svg aria-hidden="true" class="icon collection-save__icon"
                                 xmlns="http://www.w3.org/2000/svg" width="13" height="17.3" viewBox="0 0 13 17.3">
                                 <path fill="currentColor" stroke="#57696d"
                                    d="M12.5,16.5l-6-2.8l-6,2.8v-16h12V16.5z"></path>
                              </svg>
                              &nbsp;SAVE
                           </a>
                           <a href="{{ route('recipes.details', $item->id) }}" class="detail-link">
                              <i class="fa fa-eye"></i></a>
                           {{-- <a href="{{ route('recipes.details', [$item->id, $item->name]) }}" class="detail-link"><i class="fa fa-eye"></i></a> --}}
                        </div>
                     </li>
                  </a>
                  @endforeach
               </ul>
            </div>
         </div>
      </div>
   </div>

<div id="waitingShield" class="hidden text-center" data-slug="">
   <div>
      <i class="fa fa-circle-o-notch"></i>
   </div>
</div>
@include('includes.partials.paging', ['entity' => $meals])
</form>
</div>
</div>
<!-- Modal -->
<div class="modal fade mobile_popup_fixed" id="filtermodal" role="dialog">
   <div class="modal-dialog" style="margin: 0;height:100%">
      <!-- Modal content-->
      <div class="modal-content animate-bottom" style="height:100%">
         <button type="button" class="close" data-dismiss="modal"></button>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
               
                  @include('includes.partials.filter_popup_mob')
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


{{-- @include('includes.partials.meal-plan-modal') --}}
@endsection
@section('required-script')
{!! Html::script('result/plugins/bootstrap-select-master/js/bootstrap-select.min.js?v=' . time()) !!}
<script>
   $(function() {
   
       $('.include-close-btn').click(function() {
           var tag = $(this).data("val");
           // $('.include-input input[value="'+tag+'"]').val('');
           $('input[name="include[]"][value="' + tag + '"]').remove();
           document.getElementById('filter-sub-cat').submit();
       });
   
       $('.exclude-close-btn').click(function() {
           var tag = $(this).data("val");
           // $('.include-input input[value="'+tag+'"]').val('');
           $('input[name="exclude[]"][value="' + tag + '"]').remove();
           document.getElementById('filter-sub-cat').submit();
       });
   
       $('select').selectpicker();
   
       var minlength = 3;
       $('.search-box .search-wd.search-height').keyup(function() {
           //  $(".search-header-autosuggest__suggestions-container").show();
           $(".search-submit-btn").addClass("search-history");
           $(".btn--link").show();
           value = $(this).val();
           if (value.length >= minlength) {
               $.get("{{ url('/') }}" + '/meal-planner/recipes/' + value, function(response) {
                   if (response.status == 'success') {
                       console.log(response);
                       $('.search-suggested-recipes').html(response.search);
                       $(".search-header-autosuggest__suggestions-container").show();
                   }
               });
           } else {
               $(".search-header-autosuggest__suggestions-container").hide();
           }
           if (value.length == 0) {
               $(".btn--link").hide();
               $(".search-submit-btn").removeClass("search-history");
           }
   
       });
   
      //  if (window.location.pathname != '?search=') { 
      //      $(".search-submit-btn").addClass("search-history");
      //      $(".btn--link").show();
      //  }
       $(".btn--link").click(function() {
           $(".search-header-autosuggest__suggestions-container").hide();
           $(".search-submit-btn").removeClass("search-history");
           $(".btn--link").hide();
           $('.search-wd').val('');
       });
   
       /* end */
   });
   $(document).ready(function() {
      $(".include-exclude").click(function(){
        $(".ingredient-filters").show();
        $(".include-exclude").hide();
     });

      $(document).on('click','.clear_all_incl_excl',function(){
      //   $('.include-close-btn').trigger('click');
      //   $('.exclude-close-btn').trigger('click');
         // $('.search-wd').val("");
      //   $('.search-submit-btn').trigger('click');
       $('[name="include[]"]').each(function() {
                if ($(this).val()) {
                  $(this).remove();
                  //   $(this).val('');
                }
          });
         $('[name="exclude[]"]').each(function() {
                if ($(this).val()) {
                  $(this).remove();
                  // $(this).val('');
                }
          });
        $('.search-wd').val("");
        $('.search-submit-btn').trigger('click');
     });

      $('.clear-data').click(function() {
          $(":checkbox").attr("checked", false);
     });

    $(".btn--link").hide();
    let searchParams = new URLSearchParams(window.location.search);
    let param = searchParams.has('search') ;
    var search_val = searchParams.get('search');
    $("#mob-search").attr('value',search_val);
    console.log(param,'search_val',search_val);
    if(param && search_val.length > 0){
          $(".search-submit-btn").addClass("search-history");
          $(".btn--link").show();   
      }
    // 
       $(".clear-data").click(function() {
           $(".filters-options").hide();
           $(".clear-data").hide();
       });
   
       $('.sub-cat-filter-tag-remove').click(function() {
           var sub_cat = $(this).data('id');
           $('input[value="' + sub_cat + '"]').click();
       });

        $('.recipe_cat-filter-tag-remove').click(function() {
           var recipe_cat = $(this).data('id');
           console.log('recipe_cat', recipe_cat);
           $('input[name="recipe_tags[]"][value="' + recipe_cat + '"]').click();
       });

       /* new  */
   
   });
   function removeInclude(){
         if($('input[name="include[]"]').val()){
            $('input[name="include[]"]').val('');
          }
      }
   function removeExclude(){
         if($('input[name="exclude[]"]').val()){
            $('input[name="exclude[]"]').val('');
          }
      }
</script>
<script type="text/javascript">
   $(document).ready(function() {
   
       $('html, body').animate({
           scrollTop: 0
       }, 100);
       return false;

   });
</script>
@stop
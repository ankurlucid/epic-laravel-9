@php
$clientInvoicePaginateLength = isset($_COOKIE['clientInvoicePaginateLength']) ? (int)$_COOKIE['clientInvoicePaginateLength'] : null ;
@endphp
<style>
    .select-width{
        width:74% !important;
    }
    
    button.search-submit-btn {
        background: no-repeat;
        border: none;
        border-right: none !important;
    }

</style>

    <div class="col-lg-2 col-md-6 col-12">
        <div class="d-flex align-items-center position-relative">
            @if(isset($extra))
                {!! $extra !!}
            @endif
            <hr class="vertical light mt-0">
        </div>
    </div>
    <div class="col-lg-8 col-md-6 col-12">
        <div class="d-flex align-items-center position-relative">
            
            @if(isset($source) && $source == 'meal')
                {!! Form::open(['url' => Request::url(), 'method' => 'get', 'class'=>'d-flex']) !!}
                <select name="filter" class="select-width search-height" style="<?php echo (Request::get('filter'))?'width:55%':'width:75%'; ?>">
                    <option value="">--select--</option>
                    @foreach($mealCategories as $mealCategory)
                    <option value="{{$mealCategory->name}}" {{Request::get('filter') == $mealCategory->name?'selected':''}}>{{$mealCategory->name}}</option>
                    @endforeach
                </select>
                {!! Form::submit('Filter', ['class'=>'btn btn-primary btn-sm search-submit-btn']) !!}
                @if(Request::get('filter'))
                    <a class="btn btn-primary btn-sm search-clear-btn" href="{{ Request::url() }}">
                        Clear
                    </a>
                @endif
                {!! Form::close() !!}
                @endif
                @if(isset($source) && $source == 'actvity-video')
                {!! Form::open(['url' => Request::url(), 'method' => 'get']) !!}
                <select name="filter" class="select-width search-height" style="<?php echo (Request::get('filter'))?'width:55%':'width:77%'; ?>" onchange="javascript:$(this).closest('form').submit();">
                    @foreach($abWorkouts as $key => $value)
                    <option value="{{$key}}" {{Request::get('filter') == $key?'selected':''}}>{{$value}}</option>
                    @endforeach
                </select>
                {!! Form::close() !!}
                @endif
            
            
            @if(isset($source) && $source == 'client-profile-invoice')
                
            @else
                    
                {!! Form::open(['url' => Request::url(), 'method' => 'get', 'class'=>'input-group input-group-dynamic']) !!}
                        <input placeholder="search anything" style="<?php echo (Request::get('search'))?'width:55%':'width:75%'; ?>" class="form-control text-white opacity-8 mb-1 ms-3" value="{{ Request::get('search') }}" name="search" type="text">
                        <input type="hidden"  name="my-client" value="{{ Request::get('my-client') }}">
                        @if(Request::get('search'))
                            <span class="input-group-text" style="margin-right: 77px">
                        @else
                            <span class="input-group-text">
                        @endif
                            <button type="submit" class="search-submit-btn"><i class="fas fa-search"
                                aria-hidden="true"></i></button>
                        </span>
                        @if(Request::get('search'))
                            <a class="btn btn-primary btn-sm search-clear-btn" href="{{ Request::url() }}">
                                Clear
                            </a>
                        @endif
                        
                    
                {!! Form::close() !!}       
            @endif

            <hr class="vertical light mt-0">
        </div>
    </div>
    <div class="col-lg-2 col-md-6 col-12 ms-lg-auto">
        <div class="d-flex align-items-center">
            <p class="text-white mb-1 ms-lg-auto" style="margin-right:10px">Show</p>
            @if(isset($source) && $source == 'client-profile-invoice')
                <select class="form-select border border-2 p-1 text-white search-bar-select" id="datatableLengthDd"> <!--name="client-datatable_length"-->
                    <option value="10" @if($clientInvoicePaginateLength && $clientInvoicePaginateLength == 10) selected @endif>10</option>
                    <option value="25" @if($clientInvoicePaginateLength && $clientInvoicePaginateLength == 25) selected @endif>25</option>
                    <option value="50" @if($clientInvoicePaginateLength && $clientInvoicePaginateLength == 50) selected @endif>50</option>
                    <option value="100" @if($clientInvoicePaginateLength && $clientInvoicePaginateLength == 100) selected @endif>100</option>
                    <option value="1000000" @if($clientInvoicePaginateLength && $clientInvoicePaginateLength == 1000000) selected @endif>All</option>
                </select>
            @else
            <select class="form-select border border-2 p-1 text-white search-bar-select" id="datatableLengthDd"> <!--name="client-datatable_length"-->
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="1000000">All</option>
                </select>
            @endif
            <p class="text-white opacity-8 mb-1 ms-3">entries</p> 
        </div>
    </div>

        


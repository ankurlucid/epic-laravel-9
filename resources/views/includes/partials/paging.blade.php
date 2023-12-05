@if($entity->count())
<div class="row paginationn m-3">
    <div class="col-md-6 col-xs-12 col-sm-12">
        <p class="text-xs">
            Showing {{ $entity->firstItem() }} to {{ $entity->lastItem() }} of {{ $entity->total() }} entries
        </p>
    </div>

   <div class="col-md-6 text-right col-xs-12 col-sm-12 col-sm-text">

        @if(Request::get('my-client') || Request::get('search') || Request::get('filter') || Request::get('tab'))
        {{ $entity->appends(['my-client' => Request::get('my-client'), 'search' => Request::get('search'),'filter' => Request::get('filter'),'tab' =>Request::get('tab')])->links('pagination::bootstrap-4') }}
        @else
        {!! $entity->appends(request()->all())->links('pagination::bootstrap-4') !!}
        @endif

    </div>
</div>
    @else
    <div style="text-align: center;"> no records found !!</div> 

@endif
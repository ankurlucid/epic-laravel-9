@extends('layouts.app')
@section('required-styles-for-this-page')
   
    <style>
       .custom_btn_css{

            padding:1px 5px !important;
            background: #fff !important;
            font-size: 11px !important;
            border:1px solid #c8c7cc !important;
            border-radius: 3px !important;
       } 

       tr:nth-child(even) {
        background-color: #f2f2f2;
      }

      thead th{
        padding: 0.75rem 1.5rem;
        opacity: .7;
        font-weight: bolder;
        color: #7b809a;
        text-transform: uppercase;
        font-size: 0.65rem
      }
    </style>
@endsection
@section('title', 'Dashboard')

@section('breadcum')

    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard.show') }}">Home</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Client list</li>

@endsection

@section('breadcumTitle')

    <h6 class="font-weight-bolder mb-0">Client list</h6>

@endsection

@section('content')
{!! displayAlert()!!}

@include('includes.partials.delete_form')

<div class="d-sm-flex justify-content-between">
    <div>
        <h4 class="text-dark">Client List</h4>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="dropdown d-inline">
                <div class="input-group input-group-static">
                    <select name="client_status" class="form-control change-client-status" >
                        {{-- <option data-hidden="true" value=""> Move To </option> --}}
                        <option value="all">Select All</option>
                         @foreach(clientStatuses() as $key => $value)
                           @if($value != 'Contra')
                              <option value="{{$value}}">{{$value}}</option>
                              @endif
                         @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-9 mt-3">
            <button class="btn btn-icon btn-outline-dark ms-2 export" data-type="csv" type="button">
                <i class="material-icons text-xs position-relative">archive</i>
                Export
            </button>
            <a class="btn btn-icon btn-outline-dark ms-2 export" data-type="csv" href="{{ Request::url() }}?search={{ Request::get('search') }}&my-client={{ auth()->user()->id }}&page=1">
                My Clients
            </a>
            <a class="btn btn-icon btn-outline-dark ms-2" href="">
                <i class="fa fa-plus text-xs position-relative"></i>
                Add Client
            </a>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <div class="dropdown">
                              <a href="#" class="btn bg-light dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                                  {{ ( $filter != null ) ? ucwords($filter) : 'All' }}
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                  <li>
                                      <a class="dropdown-item" href="{{ route('clients') }}">
                                        All
                                      </a>
                                  </li>
                                    <li><a  class="dropdown-item" href="{{ route('clients') }}/active">Active</a></li>
                                    <li><a  class="dropdown-item" href="{{ route('clients') }}/active-lead">Active lead</a></li>
                                    <li><a  class="dropdown-item" href="{{ route('clients') }}/contra">Contra</a></li>
                                    <li><a  class="dropdown-item" href="{{ route('clients') }}/inactive">Inactive</a></li>
                                    <li><a  class="dropdown-item" href="{{ route('clients') }}/inactive-lead">Inactive lead</a></li>
                                    <li><a  class="dropdown-item" href="{{ route('clients') }}/on-hold">On hold</a></li>
                                    <li><a  class="dropdown-item" href="{{ route('clients') }}/pending">Pending</a></li>
                                    <li><a  class="dropdown-item" href="{{ route('clients') }}/pre-benchmarking">Pre-Benchmarking</a></li>
                                    <li><a  class="dropdown-item" href="{{ route('clients') }}/pre-consultation">Pre-Consultation</a></li>
                                    <li><a  class="dropdown-item" href="{{ route('clients') }}/pre-training">Pre-Training</a></li>
                              </ul>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding-right: 0px !important;">
                    {!! Form::open(['url' => Request::url(), 'method' => 'get', 'class'=>'']) !!}
                        <div class="input-group input-group-outline">
                            <label class="form-label">Search</label>
                            <input type="text" value="{{ Request::get('search') }}" name="search" class="form-control" style="height: 37px;border-radius: 0px;">
                        </div>
                    </div>
                    <div class="col-md-3" style="padding-left: 0px !important;">
                            <button class="btn btn-dark pull-left" style="border-radius: 0px;" type="submit">Search</button>
                            @if(Request::get('search'))
                              <a class="btn btn-dark" style="border-radius: 0px;" href="{{ Request::url() }}">
                                  Clear
                              </a>
                            @endif 
                    {!! Form::close() !!}
                    </div>

                </div>
            </div>
            @if (Session::has('status'))
                <div class="alert alert-success alert-dismissible text-white mx-4" role="alert">
                    <span class="text-sm">{{ Session::get('status') }}</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif        
            <div class="table-responsive">
                 <input type="hidden" name="operateAsClient" value="">

                <table class="table-striped" id="datatable-search">
                    <thead class="thead-light">
                       <th class="center mw-70 w70">Photo</th>
                        <th>Full Name</th>
                        <th class="">Contact Details</th>
                        <th class="">Risk Factor</th>
                        <th class="">EPIC Credit balance</th>
                        <th class="">Current membership</th>
                        <th class="">Registered At</th>
                        <th class="center">Actions</th>
                    </thead>
                    <tbody>
                        @foreach($allClients as $clients)
                            <tr data-status="{{  strtolower( $clients->account_status ) }}" data-id="{{ $clients->id }}">
                                <td style="padding: 0.75rem 1.5rem;">
                                    <div class="d-flex text-xs align-items-center">
                                        <a href="{{ route('clients.show', $clients->id) }}"><!--url('client/'.$clients->id)-->
                                            <img src="{{ dpSrc($clients->profilepic, $clients->gender) }}" alt="{{ $clients->firstname }} {{ $clients->lastname }}" class="mw-50 mh-50" style="max-width: 50px; max-height: 50px;">
                                        </a>
                                    </div>
                                </td>
                                <td class="text-xs font-weight-normal">
                                    <a href="{{ route('clients.show', $clients->id) }}">{{ $clients->firstname ?? 'Default' }} {{ $clients->lastname ?? 'Default' }}</a> <!--url('client/'.$clients->id)-->
                                    <br>
                                    {{  ucfirst($clients->account_status) }}
                                    @if($clients->account_status == 'Active' || $clients->account_status == 'Contra')
                                    <i class="fa fa-check" ></i>
                                    @endif
                                </td>
                                <td class="text-xs">
                                    <a href="mailto:{{ $clients->email ?? '' }}">{{ $clients->email ?? '' }}</a>
                                    <br>
                                    <a href="tel:{{ $clients->phonenumber ?? '' }}">{{ $clients->phonenumber ?? '' }}</a>
                                </td>
                                <td class="text-xs font-weight-normal">
                                    {!! ($clients->risk_factor >= 2)?'<span class="epic-tooltip" rel="tooltip" data-toggle="tooltip" data-placement="left" title="This client has high risk factor"><i class="fa fa-warning"></i></span>':'' !!}
                                    {{ $clients->risk_factor }}
                                </td>
                                <td class="text-xs font-weight-normal">
                                    $<span class="epic-bal-{{$clients->id}}" >{{ number_format($clients->epic_credit_balance, 2, '.', ',') }}</span>
                                </td>
                                <td class="text-xs font-weight-normal">
                                    @php 
                                        $record = $clients->memberships;  
                                        $membershipName = "----";

                                        if(isset($record[0]) && !$record->isEmpty()){

                                            $newData = $record[0];

                                            if (isset($newData) && $newData !=null && $newData->cm_status != 'Removed') {

                                                if($newData->cm_status == 'Active'){

                                                    $membershipName = $newData->cm_label;

                                                }elseif($newData->cm_status == 'On Hold') {
                                                
                                                    $membershipName =  "<span class='text-danger'>".$newData->cm_label."</span>";
                                                }
                                            }   
                                        }
                                    @endphp

                                    <span class="my-2 text-xs">{!! $membershipName !!}</span>
                                </td>
                                <td class="font-weight-normal" data-sort="{{ $clients->created_at }}">
                                    <span class="my-2 text-xs">{{ $clients->created_at->format('j M Y') }}</span>
                                </td>
                                <td>
                                    <div>
                                        @if (isUserType(['Admin']) && Auth::user()->hasPermission(Auth::user(), 'view-client'))
                                            <a href="javascript:void(0)" data-client-id="{{ $clients->id }}"
                                                data-client-name="{{ $clients->firstname ?? 'Default' }} {{ $clients->lastname ?? 'Default' }}"
                                                data-image="{{ dpSrc($clients->profilepic, $clients->gender) }}"
                                                class="btn btn-xs custom_btn_css btn-default operateAsClient tooltips" data-placement="top"
                                                data-original-title="Login as client">
                                                <i class="fa fa-sign-in" style="color:#253746;"></i>

                                            </a>
                                        @endif

                                        @if (isUserType(['Admin']) && Auth::user()->hasPermission(Auth::user(), 'view-client'))
                                            <a href="{{ route('clients.show', $clients->id) }}" class="btn btn-xs custom_btn_css btn-default tooltips" data-placement="top"
                                                data-original-title="View">
                                                <i class="fa fa-share" style="color:#253746;"></i>
                                            </a>
                                        @endif

                                        @if (isUserType(['Admin']) && Auth::user()->hasPermission(Auth::user(), 'edit-client'))
                                            <a class="btn btn-xs custom_btn_css btn-default tooltips" href="{{ route('clients.edit', $clients->id) }}" data-placement="top"
                                                data-original-title="Edit">
                                                <i class="fa fa-pencil" style="color:#253746;"></i>
                                            </a>
                                        @endif


                                        @if (isUserType(['Admin']) && Auth::user()->hasPermission(Auth::user(), 'delete-client'))
                                            <a class="btn btn-xs custom_btn_css btn-default tooltips delLink" href="{{ route('clients.destroy', $clients->id) }}"
                                                data-placement="top" data-original-title="Delete" data-entity="client">
                                                <i class="fa fa-trash-o" style="color:#253746;"></i>
                                            </a>
                                        @endif

                                        <div class="btn-group">


                                            @if (isUserType(['Admin']) && Auth::user()->hasPermission(Auth::user(), 'edit-client'))
                                                <a class="btn btn-xs custom_btn_css btn-default tooltips data-btn-{{ $clients->id }}" data-toggle="modal"
                                                    data-target="#raiseMakeUpModel" data-placement="top" data-original-title="EPIC Credit"
                                                    data-client-id="{{ $clients->id }}" data-check="no" data-labelval="rise"
                                                    data-netamount="{{ $clients->AllNetAmount }}"><i class="fa fa-dollar" style="color:#253746;"></i></a>
                                            @endif

                                        </div>
                                        <div class="form-group client-menu-list">
                                            <select name="menu" class="menuList onChangePop" data-client-id="{{ $clients->id }}"
                                                data-sales-process-completed="{{ $clients->sale_process_step }}"
                                                data-consultation-date="{{ $clients->consultation_date }}">
                                                <option data-hidden="true" value=""> Move To </option>
                                                @foreach (clientStatuses() as $key => $value)
                                                    <option value="{{ $key }}" {{ $value == $clients->account_status ? 'selected' : '' }}>
                                                        {{ $value }}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                                    
                @include('includes.partials.paging', ['entity' => $allClients])
            </div>         
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
      <div class="modal-dialog modal-danger modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
               <div class="col-md-4">
                  <div class="img-div">
                     <img class="loginClientImg" width="150" height="150" src="" style="border-radius: 50%">
                  </div>
                </div>
                  <div class="col-md-8">
                     <h2>You have switched into <span class="loginClient">Timmy</span>'s Account</h2>
                     <p>We've detected you've switched into <span class="loginClient">Timmy</span>'s Account in another tab. You can have only one active session at any time.</p>
                     <a class="openClient btn btn-dark btn-lg" href="" target="_blank" class="btn">Refresh and view <span class="loginClient"></span> account</a>
                  </div>
               </div>
            </div>
          </div>
        </div>
      </div>
    </div>


@endsection

@section('script-after-page-handler')
    
    <script src="{{ asset('theme') }}/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('theme') }}/js/plugins/datatables.js"></script>
    {!! Html::script('vendor/moment/moment-timezone-with-data.js') !!}
    {!! Html::script('assets/js/set-moment-timezone.js') !!}  -->
    <!-- end : moment  -->

    {!! Html::script('assets/js/helper.js') !!}

    {!! Html::script('assets/js/makeup.js') !!}
    <script>
        var cookieSlug = "client";
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
            searchable: false,
            fixedHeight: false,
        });

        $(document).ready(function() {
            
            $('.dataTable-bottom').remove()
        });

    </script>
    <script>
        function changeStatus(clientId, newStatus){
            var formData={};
            formData['clientId']=clientId;
            formData['newStatus']=newStatus;
            //formData['currenturl']=window.location.href;   
            toggleWaitShield('show');
            $.ajax({
                url: public_url+'client/change-status',
                method: "POST",
                data: formData,
                success: function(data) {
                    toggleWaitShield('hide');
                    myObj=JSON.parse(data);
                    if(myObj.status=='succsess'){
                        if(newStatus=='active'){
                            swal.close();
                            var emm = $('#editMembSub');
                            emm.modal('show');
                            emm.find('input[name=clientId]').val(clientId);
                            emm.on("hidden.bs.modal", function () {
                                location.reload();
                            });
                        }
                        else {
                            location.reload(true);
                        }
                    }
                }
            });
            /*var curl=window.location.href;
            window.location.href = public_url+'client/'+clientId+'/'+newStatus+'?u='+curl;*/ 
        }
        function statusChangeSwalCancle(){
             location.reload(true);
            // $("select.menuList").val('').selectpicker('refresh')
        }

        function statusChangeSwalConfirm($currentSelectElem){
            var $this = $currentSelectElem,
            newStatus = $this.val(),
            clientId = $this.data('client-id')
            lastStatus = $this.closest('tr').data('status');
            if(lastStatus==newStatus){
                $this.val('').selectpicker('refresh')
                swal.close();
                return;
            }
            swal.close();
            $('input[name="salesProcessCompleted"]').val($this.data('sales-process-completed'))
            $('input[name="consultationDate"]').val($this.data('consultation-date'))

            
            salesProcessUpgradeCheck(newStatus, function(){
                changeStatus(clientId, newStatus)
            }, statusChangeSwalCancle);  
        }

        $('.operateAsClient').click(function(){
            var clientId = $(this).data('client-id');
            var clientName = $(this).data('client-name');
            var clientImg = $(this).data('image');
            var formData = {};
            formData['clientId'] = clientId;
            var url = "{{url('clients/operate-as-client/')}}"+'/'+clientId;
            var weburl = "https://update.epicresult.com/login/";
            $.get(url,function(response){
                if(response.status == 'ok'){
                    var loginUrl = weburl+response.bussName+"?id="+clientId;
                    if(response.operateAsClient == "yes"){
                        $('#myModal').modal('show');
                        $('#myModal').find('.loginClient').text(clientName);
                        $('#myModal').find('.loginClientImg').attr('src',clientImg);
                        $('#myModal').find('.openClient').attr('href',loginUrl);
                    }else{
                        window.open(loginUrl, '_blank');
                    }
                }else{
                    swal({
                        type: 'error',
                        title: 'Error!',
                        showCancelButton: false,
                        allowOutsideClick: false,
                        text: response.message,
                        showConfirmButton: true,     
                    });
                }
            })
        })

        /* select */
               $(document).on('change', '.change-client-status', function() {
                    if($(this).val()){      
                        $('input[name="status"]').attr('value', $(this).val());
                    }    
                });

        /* end */


</script>

{!! Html::script('assets/js/client-membership.js?v='.time()) !!}

@endsection

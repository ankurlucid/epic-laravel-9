@props(['activePage', 'activeItem', 'activeSubitem'])
<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex align-items-center text-wrap" href="">
            <img src="{{ asset('theme') }}/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
              <span class="ms-2 font-weight-bold text-white"> {{app_name()}} </span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mb-2 mt-0">
                <a data-bs-toggle="collapse" href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav"
                    role="button" aria-expanded="false">
                    @if (auth()->user()->picture)
                    <img src="/storage/{{(auth()->user()->picture)}}" alt="avatar" class="avatar">
                    @else
                    <img src="{{ asset('theme') }}/img/default-avatar.png" alt="avatar" class="avatar">
                    @endif
                    <span class="nav-link-text ms-2 ps-1">{{ auth()->user()->name }}</span>
                </a>
                <div class="collapse" id="ProfileNav" style="">
                    <ul class="nav ">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="">
                                <span class="sidenav-mini-icon"> MP </span>
                                <span class="sidenav-normal  ms-3  ps-1"> My Profile </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal  ms-3  ps-1"> Settings </span>
                            </a>
                        </li>
                        <form method="POST" action="" class="d-none" id="logout-form">
                            @csrf
                        </form>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="{{route('auth.logout')}}" >
                                <span class="sidenav-mini-icon"> L </span>
                                <span class="sidenav-normal  ms-3  ps-1"> Logout </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <hr class="horizontal light mt-0">
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#dashboardsExamples"
                    class="nav-link text-white dashboard"
                    aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                    <i class="material-icons-round opacity-10">dashboard</i>
                    <span class="nav-link-text ms-2 ps-1">Dashboards</span>
                </a>
                <div class="collapse dashboard" id="dashboardsExamples">
                    <ul class="nav ">
                        <li class="nav-item analytics ">
                            <a class="nav-link text-white analytics "
                                href="">
                                <span class="sidenav-mini-icon"> A </span>
                                <span class="sidenav-normal  ms-2  ps-1"> Analytics </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <hr class="horizontal light mt-0">

            {{-- <li class="nav-item analytics ">
                <a class="nav-link text-white analytics @if( \Route::is('muscle.list') || \Route::is('muscle.create') || \Route::is('muscle.edit') ) active   @endif"
                href="{{ route('muscle.list') }}">
                <i class="fa fa-child"></i>
                <span class="sidenav-normal  ms-2  ps-1"> Muscle </span>
              </a>
            </li> --}}
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#muscle-management"
                    class="nav-link text-white dashboard @if( \Route::is('muscle.list') || \Route::is('muscle.view') || \Route::is('muscle.create') || \Route::is('muscle.edit') ) active @endif"
                    aria-controls="muscle-management" role="button" aria-expanded="false">
                    <i class="fa fa-child"></i>
                    <span class="nav-link-text ms-2 ps-1">Muscle</span>
                </a>
                <div class="collapse dashboard @if( \Route::is('muscle.list') || \Route::is('muscle.view') || \Route::is('muscle.create') || \Route::is('muscle.edit') ) show @endif" id="muscle-management">
                    <ul class="nav ">
                        <li class="nav-item analytics ">
                            <a class="nav-link text-white analytics @if( \Route::is('muscle.list') || \Route::is('muscle.view') || \Route::is('muscle.create') || \Route::is('muscle.edit') ) active @endif"
                                href="{{ route('muscle.list') }}">
                                <span class="sidenav-mini-icon"> ML </span>
                                <span class="sidenav-normal  ms-2  ps-1"> Muscle List </span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#gallery-management"
                    class="nav-link text-white dashboard"
                    aria-controls="gallery-management" role="button" aria-expanded="false">
                    <i class="fa fa-image"></i>
                    <span class="nav-link-text ms-2 ps-1">Gallery</span>
                </a>
                <div class="collapse dashboard" id="gallery-management">
                    <ul class="nav ">
                        <li class="nav-item analytics ">
                            <a class="nav-link text-white analytics "
                                href="">
                                <span class="sidenav-mini-icon"> G </span>
                                <span class="sidenav-normal  ms-2  ps-1"> Gallery </span>
                            </a>
                        </li>
                        <li class="nav-item analytics ">
                            <a class="nav-link text-white analytics "
                                href="">
                                <span class="sidenav-mini-icon"> CL </span>
                                <span class="sidenav-normal  ms-2  ps-1"> Category List </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#attendence-management"
                    class="nav-link text-white dashboard"
                    aria-controls="attendence-management" role="button" aria-expanded="false">
                    <i class="fa fa-book"></i>
                    <span class="nav-link-text ms-2 ps-1">Attendence</span>
                </a>
                <div class="collapse dashboard" id="attendence-management">
                    <ul class="nav ">
                        <li class="nav-item analytics ">
                            <a class="nav-link text-white analytics "
                                href="">
                                <span class="sidenav-mini-icon"> R </span>
                                <span class="sidenav-normal  ms-2  ps-1"> Roster </span>
                            </a>
                        </li>
                        <li class="nav-item analytics ">
                            <a class="nav-link text-white analytics "
                                href="">
                                <span class="sidenav-mini-icon"> R </span>
                                <span class="sidenav-normal  ms-2  ps-1"> Report </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#sales-tools-management"
                    class="nav-link text-white dashboard"
                    aria-controls="sales-tools-management" role="button" aria-expanded="false">
                    <i class="fa fa-barcode"></i>
                    <span class="nav-link-text ms-2 ps-1">Sales Tools</span>
                </a>
                <div class="collapse dashboard" id="sales-tools-management">
                    <ul class="nav ">
                        <li class="nav-item analytics ">
                            <a class="nav-link text-white analytics "
                                href="">
                                <span class="sidenav-mini-icon"> DL </span>
                                <span class="sidenav-normal  ms-2  ps-1"> Discounts List </span>
                            </a>
                        </li>

                        <li class="nav-item analytics ">
                            <a class="nav-link text-white analytics "
                                href="">
                                <span class="sidenav-mini-icon"> IT </span>
                                <span class="sidenav-normal  ms-2  ps-1"> Invoices & taxes </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#business-setup-management"
              class="nav-link text-white dashboard @if( \Route::is('clients') ) active @endif"
              aria-controls="business-setup-management" role="button" aria-expanded="false">
              <i class="fa fa-suitcase"></i>
              <span class="nav-link-text ms-2 ps-1">Business Setup</span>
            </a>
            <div class="collapse dashboard @if( \Route::is('clients') ) show @endif" id="business-setup-management">
              <ul class="nav ">

                    <li class="nav-item analytics ">
                        <a class="nav-link text-white analytics "
                        href="">
                        <span class="sidenav-mini-icon"> L </span>
                        <span class="sidenav-normal  ms-2  ps-1"> LDC </span>
                      </a>
                    </li>

                    <li class="nav-item analytics ">
                        <a class="nav-link text-white analytics "
                        href="">
                        <span class="sidenav-mini-icon"> BI </span>
                        <span class="sidenav-normal  ms-2  ps-1"> Basic Information </span>
                      </a>
                    </li>

                  <li class="nav-item analytics ">
                      <a class="nav-link text-white analytics "
                      href="">
                      <span class="sidenav-mini-icon"> LL </span>
                      <span class="sidenav-normal  ms-2  ps-1"> Locations List </span>
                    </a>
                  </li>

                <li class="nav-item analytics ">
                    <a class="nav-link text-white analytics "
                    href="">
                    <span class="sidenav-mini-icon"> SL </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Staffs List </span>
                  </a>
                </li>


                <li class="nav-item analytics ">
                    <a class="nav-link text-white analytics "
                    href="">
                    <span class="sidenav-mini-icon"> SL </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Services List </span>
                  </a>
                </li>

                <li class="nav-item analytics ">
                    <a class="nav-link text-white analytics "
                    href="">
                    <span class="sidenav-mini-icon"> CL </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Classes List </span>
                  </a>
                </li>

                <li class="nav-item analytics ">
                    <a class="nav-link text-white analytics "
                    href="">
                    <span class="sidenav-mini-icon"> PL </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Products List </span>
                  </a>
                </li>

                <li class="nav-item analytics ">
                    <a class="nav-link text-white analytics @if( \Route::is('clients') ) active @endif"
                    href="{{route('clients')}}">
                    <span class="sidenav-mini-icon"> CL </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Clients List </span>
                  </a>
                </li>

                <li class="nav-item analytics ">
                    <a class="nav-link text-white analytics "
                    href="">
                    <span class="sidenav-mini-icon"> CL </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Contacts List </span>
                  </a>
                </li>


                <li class="nav-item analytics ">
                    <a class="nav-link text-white analytics "
                    href="">
                    <span class="sidenav-mini-icon"> MO </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Membership Options </span>
                  </a>
                </li>

                <li class="nav-item analytics ">
                    <a class="nav-link text-white analytics "
                    href="">
                    <span class="sidenav-mini-icon"> RL</span>
                    <span class="sidenav-normal  ms-2  ps-1"> Resources List </span>
                  </a>
                </li>



                <li class="nav-item analytics ">
                    <a class="nav-link text-white analytics "
                    href="">
                    <span class="sidenav-mini-icon"> CS </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Calendar Settings </span>
                  </a>
                </li>

                <li class="nav-item analytics ">
                    <a class="nav-link text-white analytics "
                    href="">
                    <span class="sidenav-mini-icon"> AL </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Admin List </span>
                  </a>
                </li>



        </ul>
      </div>
    </li>


            <li class="nav-item analytics ">
                <a class="nav-link text-white analytics "
                href="">
                <i class="fa fa-calendar"></i>
                <span class="sidenav-normal  ms-2  ps-1"> Calendar </span>
              </a>
            </li>


            <li class="nav-item analytics ">
                <a class="nav-link text-white analytics "
                href="">
                <i class="fa fa-money"></i>
                <span class="sidenav-normal  ms-2  ps-1"> Business Plan </span>
              </a>
            </li>

            <li class="nav-item analytics ">
                <a class="nav-link text-white analytics "
                href="">
                <i class="fa fa-key"></i>
                <span class="sidenav-normal  ms-2  ps-1"> Manage Permission </span>
              </a>
            </li>


              <li class="nav-item analytics ">
                  <a class="nav-link text-white analytics "
                  href="">
                  <i class="fa fa-bank"></i>
                  <span class="sidenav-normal  ms-2  ps-1"> Manage Invoices </span>
                </a>
              </li>

              <li class="nav-item ">
                 <a class="nav-link text-white"
                     data-bs-toggle="collapse" aria-expanded="false" href="#financial-tool-example">
                     <i class="fa fa-dollar"></i>
                     <span class="sidenav-normal  ms-2  ps-1"> Financial Tool <b class="caret"></b></span>
                 </a>
                 <div class="collapse" id="financial-tool-example">
                     <ul class="nav nav-sm flex-column">
                         <li class="nav-item">
                             <a class="nav-link text-white"
                                 href="">
                                 <span class="sidenav-mini-icon"> SP </span>
                                 <span class="sidenav-normal  ms-2  ps-1"> Settings & Preferences </span>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link text-white"
                                 href="">
                                 <span class="sidenav-mini-icon"> NS </span>
                                 <span class="sidenav-normal  ms-2  ps-1"> New Setup  </span>
                             </a>
                         </li>
                     </ul>
                 </div>
             </li>

              <li class="nav-item">
                  <a data-bs-toggle="collapse" href="#activity-builder-management"
                      class="nav-link text-white dashboard"
                      aria-controls="activity-builder-management" role="button" aria-expanded="false">
                      <i class="fa fa-child"></i>
                      <span class="nav-link-text ms-2 ps-1">Activity Builder</span>
                  </a>
                  <div class="collapse dashboard" id="activity-builder-management">
                      <ul class="nav ">
                          <li class="nav-item analytics ">
                              <a class="nav-link text-white analytics "
                                  href="">
                                  <span class="sidenav-mini-icon"> EL </span>
                                  <span class="sidenav-normal  ms-2  ps-1"> Exercise List </span>
                              </a>
                          </li>

                          <li class="nav-item ">
                             <a class="nav-link text-white"
                                 data-bs-toggle="collapse" aria-expanded="false" href="#library-program-id">
                                 <span class="sidenav-mini-icon"> P </span>
                                 <span class="sidenav-normal  ms-2  ps-1"> Library Program <b class="caret"></b></span>
                             </a>
                             <div class="collapse" id="library-program-id">
                                 <ul class="nav nav-sm flex-column">
                                     <li class="nav-item">
                                         <a class="nav-link text-white"
                                             href="">
                                             <span class="sidenav-mini-icon"> SP </span>
                                             <span class="sidenav-normal  ms-2  ps-1"> Single Phase </span>
                                         </a>
                                     </li>
                                     <li class="nav-item">
                                         <a class="nav-link text-white"
                                             href="">
                                             <span class="sidenav-mini-icon"> MP </span>
                                             <span class="sidenav-normal  ms-2  ps-1"> Multi Phase  </span>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </li>

                          <li class="nav-item analytics ">
                              <a class="nav-link text-white analytics "
                                  href="">
                                  <span class="sidenav-mini-icon"> GP </span>
                                  <span class="sidenav-normal  ms-2  ps-1"> Generate Program </span>
                              </a>
                          </li>


                          <li class="nav-item analytics ">
                              <a class="nav-link text-white analytics "
                                  href="">
                                  <span class="sidenav-mini-icon"> VL </span>
                                  <span class="sidenav-normal  ms-2  ps-1"> Video List </span>
                              </a>
                          </li>


                      </ul>
                  </div>
              </li>


              <li class="nav-item ">
                 <a class="nav-link text-white @if( \Route::is('meals.index') ) active @endif" 
                     data-bs-toggle="collapse" aria-expanded="false" href="#meal-planner-example">
                     <i class="fa fa-cutlery"></i>
                     <span class="sidenav-normal  ms-2  ps-1"> Meal Planner <b class="caret"></b></span>
                 </a>
                 <div class="collapse @if( \Route::is('meals.index') ) show @endif" id="meal-planner-example">
                     <ul class="nav nav-sm flex-column">
                         <li class="nav-item">
                             <a class="nav-link text-white"
                                 href="">
                                 <span class="sidenav-mini-icon"> IL </span>
                                 <span class="sidenav-normal  ms-2  ps-1"> Ingredient List </span>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link text-white @if( \Route::is('meals.index') ) active @endif"
                                 href="{{ route('meals.index') }}">
                                 <span class="sidenav-mini-icon"> RL </span>
                                 <span class="sidenav-normal  ms-2  ps-1"> Recipe List </span>
                             </a>
                         </li>


                         <li class="nav-item">
                             <a class="nav-link text-white"
                                 href="">
                                 <span class="sidenav-mini-icon"> MC </span>
                                 <span class="sidenav-normal  ms-2  ps-1"> Main Category </span>
                             </a>
                         </li>


                         <li class="nav-item">
                             <a class="nav-link text-white"
                                 href="">
                                 <span class="sidenav-mini-icon"> SC </span>
                                 <span class="sidenav-normal  ms-2  ps-1"> Sub Category </span>
                             </a>
                         </li>


                     </ul>
                 </div>
             </li>


             <li class="nav-item ">
                <a class="nav-link text-white"
                    data-bs-toggle="collapse" aria-expanded="false" href="#pipeline-process-example">
                    <i class="fa fa-cutlery"></i>
                    <span class="sidenav-normal  ms-2  ps-1"> Pipeline Process <b class="caret"></b></span>
                </a>
                <div class="collapse" id="pipeline-process-example">
                    <ul class="nav nav-sm flex-column">

                        <li class="nav-item">
                            <a class="nav-link text-white"
                                href="">
                                <span class="sidenav-mini-icon"> D </span>
                                <span class="sidenav-normal  ms-2  ps-1"> Dashboard </span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link text-white"
                                href="">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal  ms-2  ps-1"> Projects </span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link text-white"
                                href="">
                                <span class="sidenav-mini-icon"> MT </span>
                                <span class="sidenav-normal  ms-2  ps-1"> My Tasks </span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link text-white"
                                href="">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal  ms-2  ps-1"> Calendar </span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link text-white"
                                href="">
                                <span class="sidenav-mini-icon"> F </span>
                                <span class="sidenav-normal  ms-2  ps-1"> Favorites </span>
                            </a>
                        </li>



                    </ul>
                </div>
            </li>


        </ul>
    </div>

</aside>

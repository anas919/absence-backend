        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-3 ml-auto">
                <!-- form class="input-icon my-3 my-lg-0">
                  <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fa fa-search"></i>
                  </div>
                </form -->
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  @if( isGranted('ADMIN') )
                  <li class="nav-item groupe">
                    <a href="{{ route('groupe') }}" class="nav-link">
                      <i class="fa fa-list"></i> 
                      {{ __('groupe.module_name') }}
                    </a>
                  </li>
                  @endif
                  @if( isGranted('ADMIN') )
                  <li class="nav-item user">
                    <a href="{{ route('user') }}" class="nav-link">
                      <i class="fa fa-users"></i> 
                      {{ __('user.module_name') }}
                    </a>
                  </li>
                  @endif
                  @if( isGranted('Page') )
                  <li class="nav-item page">
                    <a href="{{ route('page') }}" class="nav-link">
                      <i class="fa fa-file"></i> 
                      {{ __('page.module_name') }}
                    </a>
                  </li>
                  @endif
                  @if( isGranted('ADMIN') )
                  <li class="nav-item filiere">
                    <a href="{{ route('filiere') }}" class="nav-link">
                      <i class="fa fa-book"></i> 
                      {{ __('filiere.module_name') }}
                    </a>
                  </li>
                  @endif
                  @if( isGranted('ADMIN') )
                  <li class="nav-item etudiant">
                    <a href="{{ route('etudiant') }}" class="nav-link">
                      <i class="fa fa-users"></i> 
                      {{ __('etudiant.module_name') }}
                    </a>
                  </li>
                  @endif
                  @if( isGranted('ADMIN') )
                  <li class="nav-item prof">
                    <a href="{{ route('prof') }}" class="nav-link">
                      <i class="fa fa-users"></i> 
                      {{ __('prof.module_name') }}
                    </a>
                  </li>
                  @endif
                  @if( isGranted('ADMIN') )
                  <li class="nav-item semestre">
                    <a href="{{ route('semestre') }}" class="nav-link">
                      <i class="fa fa-pie-chart"></i> 
                      {{ __('semestre.module_name') }}
                    </a>
                  </li>
                  @endif
                  @if( isGranted('ADMIN') )
                  <li class="nav-item module">
                    <a href="{{ route('module') }}" class="nav-link">
                      <i class="fa fa-book"></i> 
                      {{ __('module.module_name') }}
                    </a>
                  </li>
                  @endif
                  @if( isGranted('ADMIN') )
                  <li class="nav-item seance">
                    <a href="{{ route('seance') }}" class="nav-link">
                      <i class="fa fa-book"></i> 
                      {{ __('seance.seance_name') }}
                    </a>
                  </li>
                  @endif
                  @if( isGranted('ADMIN') )
                  <li class="nav-item absence">
                    <a href="{{ route('absence') }}" class="nav-link">
                      <i class="fa fa-book"></i> 
                      {{ __('absence.absence_name') }}
                    </a>
                  </li>
                  @endif
                  <script type="text/javascript">
                    $(document).ready(function(){
                      $('.nav-item.{{ explode('_',\Request::route()->getName())[0] }}').addClass('active');
                    })
                  </script>
                </ul>
              </div>
            </div>
          </div>
        </div>
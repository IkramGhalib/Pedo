@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Meter Reading</li>
  </ol>
  <!-- <h1 class="page-title">Categories</h1> -->
</div>

<div class="page-content">

<div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
              <a href="{{ route('reading.form') }}" class="btn btn-success btn-sm"><i class="icon wb-plus" aria-hidden="true"></i> Add  </a>
            </div>
          
          <div class="panel-actions">
           <form method="GET" action="{{ route('reading.lists') }}">
              <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ Request::input('search') }}">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="Search"><i class="icon wb-search" aria-hidden="true"></i></button>
                  <a href="{{ route('reading.lists') }}" class="btn btn-danger" data-toggle="tooltip" data-original-title="Clear Search"><i class="icon wb-close" aria-hidden="true"></i></a>
                </span>
              </div>
          </form> 
          </div>
        </div>
        
        <div class="panel-body">
          <div class="table-responsive">
          <table class="table table-hover table-striped w-full">
            <thead>
              <tr>
                <th>#</th>
               
                <th> Ref #</th>
                <th>Month-Year</th>
                <th> Pre.Reading</th>
                <th>cur.Reading</th>
                <th>cal.Units</th>
                <!-- <th>Peak R</th> -->
                <!-- <th>Offpeak R</th> -->
               
                <th>Verified</th>
                <th> Attachment</th>

                <th>Actions</th>
                

              </tr>
            </thead>
            <tbody>
              @foreach($list as $key=>$i)
              <tr>
                <td>{{ $key+1}}</td>
                <td>{{ $i->ref_no}}</td>
                <td>{{ date('M Y',strtotime($i->month_year)) }} </td>
                <!-- <td>{{ $i->peak}}</td> -->
                <td>{{ $i->offpeak_prev}}</td>
                <td>{{ $i->offpeak}}</td>
                <td>{{ $i->offpeak_units}}</td>
              
                

                <td>
                  @if($i->is_verified==1)
                  <span class="badge badge-success">Yes</span>
                  @else
                  <span class="badge badge-danger">No</span>
                  @endif
                </td>
                <td>@if($i->offpkimage) <a href="#" data-img-src="{{asset('reading').'/'.$i->offpkimage}}" class="show_reading_image"> Show </a> @else {{'N/A'}} @endif</td>
                <td>
                  <a href="{{ url('meter-reading-edit/'.$i->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" title="Edit" >
                    <i class="icon wb-pencil" aria-hidden="true"></i>
                  </a>

                  <a href="{{ url('meter-reading-disable/'.$i->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round delete-record" title="delete"  >
                    <i class="fa fa-ban disabled-icon"></i>
                  </a>
                </td>
                {{-- <td>
                  <a style="background-color:rgb(73, 196, 73);color:white;text-decoration:none" href="{{ route('admin.view.courses',$category->id) }}" class="btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" >
                    view courses</i>
                  </a>
                </td> --}}
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
          
          <div class="float-right">
            {{-- {{ $instructor->appends(['search' => Request::input('search')])->links() }} --}}
          </div>
          
          
        </div>
      </div>
      <!-- End Panel Basic -->
</div>

                    <!-- image showing model -->
                    <div class="modal" id="myModal">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Attachment</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body">
                            <div class="row"> 
                                  <div class="col-md-12"> 
                                  <img class="img img-thumbnail" src="" id="show_image_area">
                                  
                                </div>
                          </div>
                          </div>

                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>

                        </div>
                      </div>
                    </div>
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function()
    { 
      $(document).on('click','.show_reading_image',function(){
        let src_v=$(this).data('img-src');
        $("#show_image_area").attr('src',src_v);
        $("#myModal").modal('show');
      });
    });
</script>
@endsection
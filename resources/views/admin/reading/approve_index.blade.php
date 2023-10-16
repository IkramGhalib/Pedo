@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Reading Approval</li>
  </ol>
  <!-- <h1 class="page-title">Categories</h1> -->
</div>

<div class="page-content">

<div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
              &nbsp;
              <a href="{{ route('reading.approve.form') }}" class="btn btn-success btn-sm"><i class="icon wb-plus" aria-hidden="true"></i> Add  Approval</a>
            </div>
          
          <div class="panel-actions">
           <form method="GET" action="{{ route('reading.approve.lists') }}">
              <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ Request::input('search') }}">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="Search"><i class="icon wb-search" aria-hidden="true"></i></button>
                  <a href="{{ route('reading.approve.lists') }}" class="btn btn-danger" data-toggle="tooltip" data-original-title="Clear Search"><i class="icon wb-close" aria-hidden="true"></i></a>
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
               
                <!-- <th> Ref #</th> -->
                <th>Month-Year</th>
                <!-- <th>Peak R</th> -->
                <!-- <th>Offpeak R</th> -->
               
                <th>Verified</th>

                <!-- <th>Actions</th> -->
                

              </tr>
            </thead>
            <tbody>
              @foreach($list as $key=>$i)
              <tr>
                <td>{{ $key+1}}</td>
                <td>{{ app_month_format($i->month_year) }} </td>
              
                

                <td>
                  @if($i->is_verified==1)
                  <span class="badge badge-success">Yes</span>
                  @else
                  <span class="badge badge-danger">No</span>
                  @endif
                </td>
                {{--<td>
                  @if($i->is_verified !=1)
                  <a href="#" class="btn btn-xs btn-icon btn-inverse btn-round approve_button" id="row{{$i->id}}" data-record-id="{{$i->id}}" title="approve"  >
                    <i class="icon wb-pencil"></i>
                    approve
                  </a>
                  @endif
                </td>
                --}}
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
<!-- <div class="modal fade" id="formModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="formModalLabel">Confirmation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                    </div>
                    <div class="modal-body">
                        <form id="myForm" name="myForm" class="form-horizontal" novalidate="">
                            <div class="form-group">
                                <label>Are You Sure ? </label>
                                <input type="hidden"  id="record_id" name="record_id" value="">
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-save" value="add"> Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> -->
@endsection


@section('javascript')
<!-- <script>
  $(document).ready(function(){
    $('').click(function(){

    });
  });


    jQuery(document).ready(function($){
    jQuery('.approve_button').click(function () {
        jQuery('#formModal').modal('show');
       var record_id= $(this).data('record-id');
       var record_id= $('#record_id').val(record_id);
    });
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var id=jQuery('#record_id').val();
        var formData = {
            id: id,
        };
       
       
        $.ajax({
            type: 'POST',
            url: '{{route("reading.approve")}}',
            data: formData,
            dataType: 'json',
            success: function (data) {
                
                jQuery('#formModal').modal('hide')
                if(data.success=='true')
                {
                  $("#row"+id).closest('tr').remove();
                  message('success',data.message);
                }
                else
                message('error',data.message);
              },
            error: function (data) {
                console.log(data);
            }
        });
    });
});
</script> -->
@endsection
@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item ">Bill</li>
    <li class="breadcrumb-item active">Bill Adjustment</li>
  </ol>
  <!-- <h1 class="page-title">Categories</h1> -->
</div>

<div class="page-content">

<div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
              <a href="{{ route('bill.adjustment.form') }}" class="btn btn-success btn-sm"><i class="icon wb-plus" aria-hidden="true"></i> Add  </a>
            </div>
          
          <div class="panel-actions">
           <form method="GET" action="{{ route('bill.adjustment.lists') }}">
              <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ Request::input('search') }}">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="Search"><i class="icon wb-search" aria-hidden="true"></i></button>
                  <a href="{{ route('bill.adjustment.lists') }}" class="btn btn-danger" data-toggle="tooltip" data-original-title="Clear Search"><i class="icon wb-close" aria-hidden="true"></i></a>
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
               
                <th>Ref #</th>
                <th>Amount</th>
                <th>remarks</th>
                <th>Created Date</th>
                <!-- <th>Actions</th> -->
                

              </tr>
            </thead>
            <tbody>
              @foreach($list as $key=>$i)
              <tr>
                <td>{{ $key+1}}</td>
                {{-- <td>{{ date('M-Y',strtotime($i->month_year)) }} </td> --}}
                <td>{{ $i->bConsumerMeter->ref_no }} </td>
                <td>{{ $i->amount }} </td>
                <td>{{ $i->remarks }} </td>
                <td>{{ $i->created_at}}</td>
                <td>
                  <!-- <a href="{{ url('meter-reading-form-edit/'.$i->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" title="Edit" >
                    <i class="icon wb-pencil" aria-hidden="true"></i>
                  </a> -->

                  <!-- <a href="{{ url('meter-reading-disable/'.$i->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" title="delete"  >
                    <i class="fa fa-ban disabled-icon"></i>
                  </a> -->
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

@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function()
    { 

    });
</script>
@endsection
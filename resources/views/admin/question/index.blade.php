@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Question Lists</li>
  </ol>
  <h1 class="page-title">Question Lists</h1>
</div>

<div class="page-content">

<div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
              <a href="{{ route('admin.question') }}" class="btn btn-success btn-sm"><i class="icon wb-plus" aria-hidden="true"></i> Add Question</a>
            </div>
          
          <div class="panel-actions">
          <form method="GET" action="{{ route('admin.question.list') }}">
              <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ Request::input('search') }}">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="Search"><i class="icon wb-search" aria-hidden="true"></i></button>
                  <a href="{{ route('admin.question.list') }}" class="btn btn-danger" data-toggle="tooltip" data-original-title="Clear Search"><i class="icon wb-close" aria-hidden="true"></i></a>
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
                <th>Sl.no</th>
                <th>Test</th>
                <th>Q.No</th>
                <th>Question Name</th>
                <th>Option a</th>
                <th>Option b</th>
                <th>Option c</th>
                <th>Option d</th>
                <th>Correct Answer</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($questions as $key=>$question)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $question->test->test_title }}</td>
                <td>{{ $question->question_no }}</td>
                <td>{{ $question->question_name}}</td>
                
                <td>{{ $question->opt_1 }}</td>
                <td>{{ $question->opt_2 }}</td>
                <td>{{ $question->opt_3 }}</td>
                <td>{{ $question->opt_4 }}</td>
                <td>{{ $question->correct_answer }}</td>

                {{-- <td>{{ $tests->test_title }}</td> --}}
               
                <td>
                  <a href="{{ route('admin.question.edit',$question->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Edit">
                    <i class="icon wb-pencil" aria-hidden="true"></i>
                  </a>
                  <a href="{{ route('admin.question.delete',$question->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Delete">
                    <i class="icon wb-trash" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>
            </td>

              @endforeach
            </tbody>
          </table>
          </div>
          
          <div class="float-right">
            {{ $questions->appends(['search' => Request::input('search')])->links() }}
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
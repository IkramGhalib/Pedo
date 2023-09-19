@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="">Question</a></li>
    <li class="breadcrumb-item active">Add</li>
  </ol>
  <h1 class="page-title">Add Question</h1>
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST"action="{{ route('admin.question.update', $question->id) }}"id="userForm">
          {{ csrf_field() }}
          {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
          <div class="row">
          


           

            <div class="form-group col-md-12">
         
              
                <input type="hidden" class="form-control" value="{{ $question->question_no }}" name="question_no"
                placeholder="Write your Questions">
               
            </div>


            <div class="form-group col-md-12">
              <label class="form-control-label">Question Name</label>
              
                <textarea   id="editor" class="form-control" name="question_name"
                placeholder="Write your Questions">{{ $question->question_name }}</textarea>
                @if ($errors->has('question_name'))
                    <label class="error" for="question_name">{{ $errors->first('question_name') }}</label>
                @endif
            </div>
          
          <div class="form-group col-md-6">
            <label class="form-control-label">Option 1</label>
            <textarea class="form-control" placeholder="Write your Option 1" id="editor1" name="opt_1">{{ $question->opt_1 }}</textarea>
            <label class="error" for="opt_1">{{ $errors->first('opt_1') }}</label>
            @if ($errors->has('opt_1'))
            <label class="error" for="opt_1">{{ $errors->first('opt_1') }}</label>
        @endif
        
          </div>

          <div class="form-group col-md-6">
            <label class="form-control-label">Option 2</label>
            <textarea class="form-control" placeholder="Write your Option 2" id="editor2" name="opt_2">{{ $question->opt_2 }}</textarea>
            @if ($errors->has('opt_2'))
            <label class="error" for="opt_2">{{ $errors->first('opt_2') }}</label>
        @endif
        
          </div>

          <div class="form-group col-md-6">
            <label class="form-control-label">Option 3</label>
            <textarea  class="form-control" id="editor3" placeholder="Write your Option 3"  placeholder="Option 3" name="opt_3">{{ $question->opt_3 }}</textarea>
            @if ($errors->has('opt_3'))
            <label class="error" for="opt_3">{{ $errors->first('opt_3') }}</label>
        @endif
        
          </div>

          <div class="form-group col-md-6">
            <label class="form-control-label">Option 4</label>
            <textarea class="form-control"  id="editor4"  placeholder="Write your Option 4"name="opt_4">{{ $question->opt_4 }}</textarea>
            @if ($errors->has('opt_4'))
            <label class="error" for="opt_4">{{ $errors->first('opt_4') }}</label>
        @endif
        
          </div>



          <div class="form-group col-md-6">
            <label class="form-control-label">Correct Answer</label>
            <select name="correct_answer" value="{{ $question->correct_answer }}" class="form-control">
                <option value="a">Option 1</option>
                <option value="b">Option 2</option>
                <option value="c">Option 3</option>
                <option value="d">Option 4</option>

            </select>
              
            @if ($errors->has('correct_answer'))
                <label class="error" for="correct_answer">{{ $errors->first('correct_answer') }}</label>
            @endif
          </div>

          <div class="form-group col-md-6">
            <label class="form-control-label">Test</label>
            <select  class="form-control" name="test_id" required>
              @foreach ($test as $tests)
                  <option value="{{ $tests->id }}"  {{ $tests->id == $tests->id ? 'selected' : '' }}>
                    {{ $tests->test_title}}</option>
              @endforeach
              
            </select>
            @if ($errors->has('test_id'))
            <label class="error" for="test_id">{{ $errors->first('test_id') }}</label>
        @endif
            
             
          </div>



         

         

          



          


        
          
        
          </div>
          <hr>
          <div class="form-group row">
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-default btn-outline">Reset</button>
            </div>
          </div>
          
        </form>
      </div>
    </div>
    
           
          <!-- End Panel Basic -->
    </div>



@endsection


@section('javascript')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script type="text/javascript">
  $(document).ready(function()
  { 
                             ClassicEditor
                              .create( document.querySelector( '#editor' ),{
                                ckfinder:{
                                  uploadUrl: '{{ route('question_name.image').'?_token='.csrf_token() }}'
                                }
                              } )
                              .then( editor => {
                                      console.log( editor );
                              } )
                              .catch( error => {
                                      console.error( error );
                              } );

//option 1 editor

ClassicEditor
      .create( document.querySelector( '#editor1' ),{
        ckfinder:{
          uploadUrl: '{{ route('question_option_1.image').'?_token='.csrf_token() }}'
        }
      } )
      .then( editor => {
          console.log( editor );
      } )
      .catch( error => {
          console.error( error );
      } );

      //option 2 editor

ClassicEditor
.create( document.querySelector( '#editor2' ),{
        ckfinder:{
          uploadUrl: '{{ route('question_option_2.image').'?_token='.csrf_token() }}'
        }
      } )
      .then( editor => {
          console.log( editor );
      } )
      .catch( error => {
          console.error( error );
      } );

             //option 3 editor

ClassicEditor
.create( document.querySelector( '#editor3' ),{
        ckfinder:{
          uploadUrl: '{{ route('question_option_3.image').'?_token='.csrf_token() }}'
        }
      } )
      .then( editor => {
          console.log( editor );
      } )
      .catch( error => {
          console.error( error );
      } );

             //option 4 editor

ClassicEditor
.create( document.querySelector( '#editor4' ),{
        ckfinder:{
          uploadUrl: '{{ route('question_option_4.image').'?_token='.csrf_token() }}'
        }
      } )
      .then( editor => {
          console.log( editor );
      } )
      .catch( error => {
          console.error( error );
      } );


  });
</script>
@endsection




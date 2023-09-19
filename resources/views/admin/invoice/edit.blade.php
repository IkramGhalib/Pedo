@extends('layouts.backend.index')
@section('content')

<div class="page-header">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.invoice') }}">invoice</a></li>
      
    </ol>
    <!-- <h1 class="page-title">Add Category</h1> -->
  </div>


  <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('admin/invoice-form-update') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                {{-- <input type="hidden" name="invoice_id" value="{{ $invoice->id }}"> --}}
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationTooltip01">Name</label>
                        <select class="form-control" id="validationTooltip01" name="user_id" required>
                            @foreach ($user as $users)
                                <option value="{{ $users->id }}" {{ $invoice->user_id == $users->id ? 'selected' : '' }}>
                                    {{ $users->first_name }} {{ $users->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationTooltip02">Group</label>
                        <select name="group_id" class="form-control" id="validationTooltip02" required>
                            @foreach ($group as $groups)
                                <option value="{{ $groups->id }}" {{ $invoice->group_id == $groups->id ? 'selected' : '' }}>
                                    {{ $groups->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationTooltipUsername">Courses</label>
                        <div class="input-group">
                            <select style="height: 40px" name="course_id[]" multiple="multiple" class="form-control"
                                id="validationTooltip02" required>
                                @foreach ($course as $courses)
                                    <option value="{{ $courses->id }}"
                                        {{ in_array($courses->id, explode(',', $invoice->course_id)) ? 'selected' : '' }}>
                                        {{ $courses->course_title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationTooltip01">Category</label>
                        <select name="category_id" class="form-control" id="validationTooltip02" required>
                            @foreach ($category as $categories)
                                <option value="{{ $categories->id }}"
                                    {{ $invoice->category_id == $categories->id ? 'selected' : '' }}>
                                    {{ $categories->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationTooltip02">Price</label>
                        <input type="number" name="price" class="form-control" id="validationTooltip02"
                            value="{{ $invoice->price }}" required>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Update Invoice</button>
            </form>
        </div>
    </div>
</div>


@endsection


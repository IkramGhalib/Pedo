@extends('layouts.frontend.index')
@section('content')
<!-- <link relation="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css"> -->

    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
    <!-- content start -->
    <div class="container-fluid p-0 home-content">
        <!-- banner start -->
        <div class="subpage-slide-blue">
            <div class="container">
                <h1>Payments</h1>
            </div>
        </div>
        <!-- banner end -->

        <!-- breadcrumb start -->
            <div class="breadcrumb-container">
                <div class="container">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Payments</li>
                  </ol>
                </div>
            </div>
        
        
        <div class="container py-5 ">
            <!-- instructor block start -->
            
                <div class="container">
                    <div class="row mb-5">
                       
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            
                        <div class="container table-responsive "> 
                        <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Inv #</th>
                            <th scope="col">Created Date</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Attachment</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
  

                        @foreach($invoices as $row)
                                <?php 
                                    
                                    $inv_de_price=  $row->invoice_total_amount+$row->other_charges;
                                    // dd($inv_de);
                                ?>
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $row->id}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$inv_de_price}}</td>
                            <td>@if($row->status !='un-paid')<span class="badge badge-success">{{$row->status}}</span>   @else <span class="badge badge-danger">{{$row->status}}</span>  @endif</td>
                            <td>
                                @if($row->uploaded_receipt)
                                <a href="{{$row->uploaded_receipt}}" > Show</a>
                                @else
                                    <span> No Attachmnt</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('getUserInvoice', $row->id)}}"  class="btn btn-success btn-sm" title="View Invoice"> <i class="fa fa-file"></i> </a>
                                @if($row->status=='un-paid')
                                <a href="#"  class="btn btn-primary btn-sm uploadButton" data-invId="{{$row->id}}" title="Uplaod Receipt"> <i class="fa fa-upload " ></i> </a></td>
                                @endif    
                            </tr>
                        
                        {{--
                        
                        <div class="instructor-box mx-auto text-center">
                            <a href="route('instructor.view', $row->instructor_slug)">
                                <main>
                                    <img src="@if($row->instructor_image && Storage::exists($row->instructor_image)){{ Storage::url($instructor->instructor_image) }}@else{{ asset('backend/assets/images/course_detail_thumb.jpg') }}@endif">
                                    <div class="col-md-12">
                                        <h6 class="instructor-title">{{ $row->id.' '.$row->last_name }}</h6>
                                        <p>{!! mb_strimwidth($row->biography, 0, 120, ".....") !!}</p>
                                    </div>
                                </main>
                            </a>
                        </div>
                            --}}
                    </div>
                    @endforeach
                    </tbody>
                    </table>
                    </div>
                    </div>
                    
                </div>
                <!-- pagination start -->
                <div class="float-right">
                   {{ $invoices->links() }}
                </div>
                <!-- pagination end -->
            
            <!-- instructor block end -->
            
        </div>
        </div>
        
    <!-- content end -->
    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="standard-modalLabel">Upload File </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="invoice_id" id="invoice_id">
                                <form  class="dropzone" id="dZUpload" name="dropzone">
                                
                                </form>  
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
@endsection

@section('javascript')
<script type="text/javascript" src="{{ asset('frontend/js/dropzone.js') }}"></script>
<script> 
        // $(document).ready(function(){
        //     $(".uploadButton").click(function(e){
        //         e.preventDefault();
        //         $('#uploadModal').modal('show');
        //     });
        // });
        var url="{{route('upload_file')}}";

        $(document).on('click',".uploadButton",function(e){
            e.preventDefault();
            $('#standard-modal').modal('show');
            console.log($(this).attr('data-invId'));
            $("#invoice_id").val($(this).attr('data-invId'));
           
            });
            $("#dZUpload").dropzone(
            {
                maxFiles:1,
                init: function() {
                    this.hiddenFileInput.removeAttribute('multiple');
                }  ,
                acceptedFiles: ".pdf,.jpg,.png,.PNG,.jpeg,",
                url: url,
                success: function (file, response) {
                    var imgName = response;
                    file.previewElement.classList.add("dz-success");
                    // load_exam_subject();
                    $('#standard-modal').modal('hide');
                    message('success','File Upload Successfully')

                    // console.log("Successfully uploaded :" + imgName);

                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                },
                sending: function(file, xhr, formData){
                   
                    formData.append('invoice_id', $("#invoice_id").val());
                    
                },
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        // ------------------------------------------------------------------------            
           
</script>
@endsection
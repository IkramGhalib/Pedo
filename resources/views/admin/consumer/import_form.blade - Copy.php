@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('consumer.form') }}">Consumer</a></li>
    <li class="breadcrumb-item active">import consumer</li>
  </ol>
  <!-- <h1 class="page-title">Add </h1> -->
</div>


<div class="page-content">
    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('consumer.save') }}" id="userForm" enctype="multipart/form-data">
        
         
      
          <div class="row">
              <div class="form-group col-md-4">
                <label class="form-control-label">excel file</label>
                <input required  type="file" id="excel_file" class="form-control excel_file" name="excel_file"                  />
                <input type="hidden" id="hidden_json_object" >
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
 function upload_data()
 {
 var passing_data=$('#hidden_json_object').val();
  console.log(passing_data);
 }

// $('.excel_file').change(function (e) 
// {
          // e.preventDefault();
          // var division_id = $(this).val();
          // console.log('testing');

          // $.ajaxSetup({
          //     headers: {
          //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          //     }
          // });

          // $.ajax({
          //             method:"get",
          //             url: "{{Route('get_all_sub_division_where')}}",
          //             dataType: "json",
          //             data:{
          //                 'division_id':$(this).val(),
          //             },
          //             success:function(response){
          //               var sub_division='';
          //                 if(response)
          //                 {
          //                   sub_division+='<option value=""> Select </option>';
          //                   $.each( response, function( key, value ) {
          //                     sub_division+='<option value="'+value.id+'">'+value.sub_division_code+'-'+value.name+'</option>';
          //                   });
          //                   $('.sub_division').empty();
          //                   $('.sub_division').append(sub_division);
          //                 }
          //                 else
          //                 message('error',response.message);
          //             }
          //         });
// });



        // let data_result;
        document.getElementById('excel_file').addEventListener('change', function() {
          // var data_result;
          console.log('testiong');
            var reader = new FileReader();
            reader.onload = function() {
                var arrayBuffer = this.result,
                    array = new Uint8Array(arrayBuffer),
                    binaryString = String.fromCharCode.apply(null, array);
                /* set up XMLHttpRequest */
                // var url = "http://myclassbook.org/wp-content/uploads/2017/12/Test.xlsx";
                // var oReq = new XMLHttpRequest();
                // oReq.open("GET", url, true);
                // oReq.responseType = "arraybuffer";

                // oReq.onload = function(e) {
                // var arraybuffer = oReq.response;

                /* convert data to binary string */
                // var data = new Uint8Array(arraybuffer);
                // var arr = new Array();
                // for (var i = 0; i != data.length; ++i) arr[i] = String.fromCharCode(data[i]);
                // var bstr = arr.join("");

                /* Call XLSX */
                var workbook = XLSX.read(binaryString, {
                    type: "binary"
                });

                /* DO SOMETHING WITH workbook HERE */
                var first_sheet_name = workbook.SheetNames[0];
                /* Get worksheet */
                var worksheet = workbook.Sheets[first_sheet_name];
                rr=XLSX.utils.sheet_to_json(worksheet, {
                    raw: true
                });
                data_result=JSON.stringify(rr);
                document.getElementById('hidden_json_object').value=data_result;
                upload_data();
                // console.log(data_result);
                // }

                // oReq.send();
            }
           var data= reader.readAsArrayBuffer(this.files[0]);
          //  console.log(data_result);
         


        });
   
      });
</script>
@endsection



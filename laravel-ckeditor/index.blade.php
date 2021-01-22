@extends("layouts.Master")
@section("main_section")
<!-- <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script> -->
<!-- <script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script> -->
<!-- <script src="https://cdn.ckeditor.com/4.15.1/full-all/ckeditor.js"></script> -->
<!-- <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script> -->
<script src="https://cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="tab-content">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="card-header">
                        <h5 class="card-title" style="margin-top: 10px">Mail Formate</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-12">
                                <br>
                                @if(session()->has('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                                    {{ session()->get('success') }}
                                </div>
                                @endif
                                @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="fas fa-skull-crossbones"></i> Alert!</h5>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-12">     
                                <div class="main-card mb-3 card">
                                    <form action="{{route('submitpdf1')}}" method="post">
                                        {{ csrf_field() }}  
                                        <input type="hidden" name="updval" value="@if( !empty($pdf1->id) ) {{ $pdf1->id }} @endif">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="First Name" class="">PDF Formate One<span class="text-danger">*</span></label>
                                                <textarea cols="80" id="editor1" name="editor1" rows="10" data-sample-short>@if( !empty($pdf1->msg) ) {{ $pdf1->msg }} @endif</textarea>
                                 
                                            </div>
                                        </div>
                                        <div class="d-block text-right card-footer">
                                            <button type="submit" id="submit" class="btn-wide btn btn-success" style="margin-right: 20px"> SET FORMATE </button>
                                        </div>
                                    </form>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

  
@endsection

@section("script_section")
    <script>
        var i = 1;
        var max = 5;
        while(max > i){  
            CKEDITOR.replace('editor'+i, {
                filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });            
            i++;
        }



   
    </script>

@endsection
@extends('yonetim.layout')
@section('customcss')
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Müşteri Görüşleri</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="">
        				{{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Müşteri Adı:</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ (isset($properties->name)) ? $properties->name : "" }}" class="form-control" id="" placeholder="Müşterinin Adı" name="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Müşteri İşi:</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$properties->job}}" class="form-control" id="email" placeholder="Müşterinin İşi" name="job">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Müşteri Görüşü:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="review">{{$properties->review}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email"></label>
                            <div class="col-sm-10">
                                <input type="submit" value="Ekle" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection
@section('customjs')
    <script src="{{ asset('scripts/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('scripts/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('scripts/dataTables.responsive.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true,
                "order": []
            });
        });
    </script>
@endsection

@extends('yonetim.layout')
@section('customcss')
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Popüler Yerler</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        				{{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Yerin Adı:</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ (isset($properties->name)) ? $properties->name : "" }}" class="form-control" id="" placeholder="Yerin Adı" name="name">
                            </div>
                        </div>
                        @if(isset($properties->image))
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Varolan Resmi: </label>
                                <div class="col-sm-5">
                                    <img class="img-responsive" src="{{ asset('images/'.$properties->image) }}">
                                </div>
                                <div class="col-sm-5"></div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Yerin Resmi: (948 × 633)</label>
                            <div class="col-sm-10">
                                <input type="file" name="image">
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

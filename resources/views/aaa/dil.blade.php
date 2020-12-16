@extends('yonetim.layout')
@section('customcss')
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dil</h1>
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
                            @foreach($turkce as $t)
                                <div class="col-sm-2 text-right">
                                    {{$t->orj}}
                                </div>
                                <div class="col-sm-10 text-left">
                                    @foreach ($properties as $property)
                                        @if($property->orj==$t->orj)
                                            <input type="text" class="form-control" id="email" placeholder="" value="{{$property->trans}}" name="ceviri{{$t->id}}">
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                            <div class="form-group">
                            @endforeach
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

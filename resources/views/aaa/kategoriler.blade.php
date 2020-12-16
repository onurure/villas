@extends('yonetim.layout')
@section('customcss')
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Hizmet Kategorileri</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-12">
            <a href="{{ url('yonetim/kategori') }}" class="btn btn-primary">Ekle</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Başlık</th>
                                <th>Üst Kategori</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($properties as $property)
                                <tr>
                                    <td>{{ $property->title }}</td>
                                    <td>
                                    </td>
                                    <td>
                                        <a href="{{ url('yonetim/kategori/'.$property->id) }}" class="btn btn-primary">
                                            Düzenle
                                        </a>
                                    </td>
                                </tr>
                                @if(count($property->sub_categories)>0)
                                    @foreach ($property->sub_categories as $sub_category)
                                    <tr>
                                        <td>{{ $sub_category->title }}</td>
                                        <td>
                                            {{ $property->title }}
                                        </td>
                                        <td>
                                            <a href="{{ url('yonetim/kategori/'.$sub_category->id.'?s=1') }}" class="btn btn-primary">
                                                Düzenle
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                    </table>
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

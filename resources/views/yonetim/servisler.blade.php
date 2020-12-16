@extends('yonetim.layout')
@section('customcss')
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Servis İlanları</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Başlık</th>
                                <th>Kullanıcı</th>
                                <th>Kod</th>
                                <th>Onay</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($properties as $property)
                                <tr>
                                    <td>{{ $property->title }}</td>
                                    <td>{{ $property->firm->name }}</td>
                                    <td>{{ $property->code }}</td>
                                    <td>{{ $property->approve==1 ? 'Onaylı' : 'Onaysız' }}</td>
                                    <td>
                                        <a href="{{ url('villa/'.$property->id.'/'.url_slug($property->title)) }}" class="btn btn-primary" target="_blank">
                                            Önizle
                                        </a>
                                        @if( $property->approve==0)
                                            <button type="button" class="btn btn-info" onclick="Onayla({{$property->id}})">Onayla</button>
                                        @endif
                                    </td>
                                </tr>
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
        function Onayla(pid){
            $.post( "{{url('yonetim/onayla')}}", { _token: "{{ csrf_token() }}", islem: "servis", pid: pid })
            .done(function( data ) {
                if(data.success){
                    alert( "İlan onaylandı." );
                    location.reload();
                }else{
                    alert( "Bir sorun oluştu.");
                }
            });
        }
    </script>
@endsection

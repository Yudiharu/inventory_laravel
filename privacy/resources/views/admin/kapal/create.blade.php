@extends('adminlte::page')

@section('title', 'kapal')

@section('content_header')

@stop

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
@include('sweet::alert')
<body onLoad="load()">
    <div class="box box-solid">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="kapal-table" width="100%" style="font-size: 12px;">
                    <thead>
                    <tr class="bg-blue">
                        <th>Kode kapal</th>
                        <th>Nama kapal</th>
                        <th>Merk</th>
                        <th>Type</th>
                        <th>Tahun</th>
                        <th>No Asset</th>
                        <th>Lokasi</th>
                     </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <button type="button" class="back2Top btn btn-warning btn-xs" id="back2Top"><i class="fa fa-arrow-up" style="color: #fff"></i> <i>{{ $nama_company }}</i> <b>({{ $nama_lokasi }})</b></button>

        <style type="text/css">
            #back2Top {
                width: 400px;
                line-height: 27px;
                overflow: hidden;
                z-index: 999;
                display: none;
                cursor: pointer;
                position: fixed;
                bottom: 0;
                text-align: left;
                font-size: 15px;
                color: #000000;
                text-decoration: none;
            }
            #back2Top:hover {
                color: #fff;
            }
        </style>
</body>
@stop

@push('css')

@endpush
@push('js')
  
    <script type="text/javascript">
        $(window).scroll(function() {
            var height = $(window).scrollTop();
            if (height > 1) {
                $('#back2Top').show();
            } else {
                $('#back2Top').show();
            }
        });
        $(document).ready(function() {
            $("#back2Top").click(function(event) {
                event.preventDefault();
                $("html, body").animate({ scrollTop: 0 }, "slow");
                return false;
            });

        });

        function load(){
            startTime();
            $('.tombol1').hide();
            $('.tombol2').hide();
            $('.back2Top').show();
        }

        $(function() {
            $('#kapal-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('kapal.data') !!}',
            columns: [
                { data: 'kode_kapal', name: 'kode_kapal' },
                { data: 'nama_kapal', name: 'nama_kapal' },
                { data: 'merk', name: 'merk' },
                { data: 'type', name: 'type' },
                { data: 'tahun', name: 'tahun' },
                { data: 'no_asset_kapal', name: 'no_asset_kapal' },
                { data: 'kode_lokasi', name: 'kode_lokasi' },
            ]
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function refreshTable() {
             $('#kapal-table').DataTable().ajax.reload(null,false);;
        }

    </script>
@endpush
@extends ('layouts.mall-informasi-layouts.dashboard')
@section('content')

<div class="content-wrapper">
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-body">
                <div class="text-end">
                    <button type="button" onclick="dataModal()" class="btn btn-primary actionYears" style="display:none;">Tambah Data</button>
                </div>
                <hr>
                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>OPD</th>
                            <th>Pagu (Rp.)</th>
                            <th>Metode</th>
                            <th>Rencana Pelaksanaan</th>
                            <th>Sumber Dana</th>
                            <th>Dokumen</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataTransparan as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->opd}}</td>
                                <td>{{number_format($item->pagu)}}</td>
                                <td>{{$item->metode}}</td>
                                <td>{{$item->rencana_pelaksanaan}}</td>
                                <td>{{$item->sumber_dana}}</td>
                                <td>
                                    @if(isset($item->file))
                                        <a href="{{ url ('/files/' . $item->file)}}" target="_blank">View File</a>
                                    @else
                                        No file uploaded
                                    @endif
                                </td>
                                <td>
                                    <button type="button" onclick="updateDataModal('{{$item->id}}', '{{$item->nama}}', '{{$item->opd}}', '{{$item->pagu}}', '{{$item->metode}}', '{{$item->rencana_pelaksanaan}}', '{{$item->sumber_dana}}')" class="btn btn-sm btn-secondary actionYears" style="display:none;">Edit</button>
                                    <a href="{{route('web.mall-informasi.strategis-daerah-del', $item->id)}}" class="btn btn-sm btn-danger actionYears" style="display:none;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br>
                <br><br><br><br><br>
            </div>
        </div>
    </div>
</div>
@include('web.pages.mall-informasi.strategis-daerah.crud.modal')
@include('web.pages.mall-informasi.strategis-daerah.crud.script')
@endsection
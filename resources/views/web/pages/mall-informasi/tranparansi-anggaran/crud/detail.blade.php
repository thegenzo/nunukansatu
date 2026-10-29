@extends ('layouts.mall-informasi-layouts.dashboard')
@section('content')

<div class="content-wrapper">
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-body">
                <div class="text-end">
                    {{-- <button type="button" onclick="dataModal()" class="btn btn-primary">Tambah Data</button> --}}
                </div>
                <hr>
                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal Publish</th>
                            <th>Lampiran</th>
                            <th>Dokumen</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataTransparan as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->date_publish ?? '-'}}</td>
                                <td>
                                    <a href="javascript:void(0);" onclick="viewsLampiran('{{$item->id}}')">Lampiran</a>
                                    <a href="javascript:void(0);" class="actionYears" style="display:none;" onclick="addlampiran('{{$item->id}}')"><i class="bx bxs-plus-square"></i></a>
                                </td>
                                <td>
                                    @if(isset($item->docs))
                                        <a href="{{ url ('/files/' . $item->docs)}}" target="_blank">View File</a>
                                    @else
                                        No file uploaded
                                    @endif
                                </td>
                                <td>
                                    <button type="button" onclick="updateDataModal('{{$item->id}}', '{{$item->title}}', '{{$item->date_publish}}')" class="btn btn-sm btn-secondary actionYears" style="display:none;">Edit</button>
                                    <a href="{{route('web.mall-informasi.transparansi-data-del', $item->id)}}" class="btn btn-sm btn-danger actionYears" style="display:none;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
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
@include('web.pages.mall-informasi.tranparansi-anggaran.crud.modal')
@include('web.pages.mall-informasi.tranparansi-anggaran.crud.script')
@endsection
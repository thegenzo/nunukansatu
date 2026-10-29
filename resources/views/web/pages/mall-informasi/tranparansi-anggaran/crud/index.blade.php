@extends ('layouts.mall-informasi-layouts.dashboard')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-body">
                <div class="text-end">
                    <button type="button" onclick="yearModal()" style="display: none;" class="btn btn-primary actionYears">Tambah Data</button>
                </div>
                <hr>
                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Year</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataTransparan as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->year}}</td>
                                <td>
                                    <button type="button" onclick="updateYearModal('{{$item->id}}', '{{$item->year}}')" class="btn btn-sm btn-secondary actionYears" style="display: none;">Edit</button>
                                    <a href="{{route('web.mall-informasi.transparansi-detail')}}?id={{$item->id}}" class="btn btn-sm btn-warning">Detail</a>
                                    <a href="{{route('web.mall-informasi.transparansi-delete', $item->id)}}" class="btn btn-sm btn-danger actionYears" style="display: none;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
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
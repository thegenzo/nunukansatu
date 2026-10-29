@extends('layouts.mall-data.layouts')
@section('title', 'detail')
@section('content')
    <!-- MAIN -->
    <section id="dataset-detail">
      <div class="container">
        <div class="d-flex justify-content-center title-show"></div>
      </div>
    </section>

    <section id="card-dataset" class="desc-card">
      <div class="container">
        <div class="card">
          <div class="card-body p-5">
            <h5 class="card-title">Deksripsi Dataset</h5>
            <div class="datas-show desc-show"></div>
          </div>
        </div>
      </div>
    </section>

    <section id="card-dataset">
      <div class="container">
        <div class="card">
          <div class="card-body">
            <div class="tahun-show"></div>
            <div class="datas-show elastic-show"></div>
          </div>
        </div>
      </div>
    </section>
    <!-- MAIN -->
@endsection
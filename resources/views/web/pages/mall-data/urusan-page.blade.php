@extends('layouts.mall-data.layouts')
@section('title', 'Urusan Pemerintahan')
@section('content')
    <!-- MAIN -->
    <section id="detail" class="pt-5 pb-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div
              class="d-flex justify-content-between w-100 flex-column flex-lg-row mb-5"
            >
              <div class="w-50">
                <img
                  src="/assets/logos/topic.png"
                  alt="Mall Data"
                  width="auto"
                  height="200px"
                  style="left: 0; right: 0; margin: auto; display: block"
                />
              </div>
              <div class="w-50">
                <h1>Urusan</h1>
                <p>
                  cari data Urusan Pemerintahan terkait dibawah ini
                </p>
                <div class="search-container mt-3">
                  <input
                    type="text"
                    name="search"
                    placeholder="Cari Urusan..."
                    class="search-input"
                  />
                  <a href="#" class="search-btn">
                    <i class="fas fa-search"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="row" id="row"></div>
          </div>
        </div>
      </div>
    </section>
    <!-- MAIN -->
@endsection
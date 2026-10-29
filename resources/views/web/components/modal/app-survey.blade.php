@push('styles')
<style>
    #modalSurveyFull .modal-body {
        height: 76vh !important;
    }
</style>
@endpush

<div class="modal fade" id="modalSurveyFull" tabindex="-1" aria-labelledby="modalSurveyFull" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Survey</h5>
      </div>
      <div class="modal-body">
        <iframe src="https://admin-mall.nunukankab.go.id/" frameborder="0" class="responsive-iframe" height="90vh" ></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
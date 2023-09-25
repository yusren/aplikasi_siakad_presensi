<!-- Modal for User KRS Details -->
<div class="modal fade" id="userKrsModal" tabindex="-1" role="dialog" aria-labelledby="userKrsModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userKrsModalLabel">User KRS Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="krsDetails"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@section('page-script')
<script>
    $(document).ready(function() {
    $('.show-krs-details').click(function(e) {
      e.preventDefault();

      var userId = $(this).data('user-id');
      var tahunAjaranId = $(this).data('tahun-ajaran-id');

      $.ajax({
        url: "{{ route('krs.showDetails') }}",
        method: "POST",
        data: { userId: userId, tahunAjaranId: tahunAjaranId, _token: '{{ csrf_token() }}' },
        success: function(response) {
          $('#krsDetails').html(response.html);
          $('#userKrsModal').modal('show');
        },
        error: function(error) {
          console.error(error);
        }
      });
    });
  });
</script>
@endsection

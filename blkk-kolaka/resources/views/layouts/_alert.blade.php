@if(session()->has('error'))
<div id="alertError" class="alert alertError alert-danger text-light alert-dismissible fade show" role="alert">
    {{ session()->get('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if(session()->has('success'))
<div class="alert alert-tambah alert-success alert-dismissible fade show" role="alert">
    {{ session()->get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@push('alertScript')
<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alertError").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 5000);
    });

    window.setTimeout(function() {
        $(".alert-tambah").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 5000);

</script>
@endpush


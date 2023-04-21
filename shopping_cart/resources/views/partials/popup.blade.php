@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: '{{ session('error') }}'
            })
    </script>
@endif

@if (session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
<script>
    Swal.fire({
        icon: 'success',
        title: 'congrat',
        text: '{{ session('success') }}'
        })
</script>
@endif
  
 <!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>


 <!-- Bootstrap 5 JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- <script src="{{asset('js/school-script.js')}}"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  $(document).ready(function() {
    $('#questions').select2({
      placeholder: "Select",
      allowClear: true
    });
  });
</script>

@yield('script')
<script>
     $(document).on("click",'.show_confirm',function(event) {

var form = $(this).closest("form");

var name = $(this).data("name");

event.preventDefault();

swal({
        title: `Are you sure want to delete this item?`,
        text: "If you delete this item, you will not be able to retrieve it again!",
        icon: "warning",
        buttons: ['no', 'yes'],
        dangerMode: true,
    })

    .then((willDelete) => {

        if (willDelete) {
            form.submit();
        }
    });
});
</script>

@if(\Session::has('success'))
<script>
    swal({
    icon: 'success',
    title: '{{session()->get('success')}}',
    buttons: false,
    timer: 1500
  });

</script>
@endif
@if(\Session::has('error'))
<script>
   swal({
    icon: 'error',
    title: '{{session()->get('error')}}',
    buttons: false,
    timer: 1500
  });

</script>
@endif
</body>
</html>
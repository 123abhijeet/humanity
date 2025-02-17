</div>
<script src="{{ asset('backend/js/jquery-3.6.0.min.js')}}"></script>

<script src="{{ asset('backend/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{ asset('backend/js/jquery.slimscroll.js')}}"></script>

<script src="{{ asset('backend/js/select2.min.js')}}"></script>
<script src="{{ asset('backend/js/moment.min.js')}}"></script>

<script src="{{ asset('backend/js/fullcalendar.min.js')}}"></script>
<script src="{{ asset('backend/js/jquery.fullcalendar.js')}}"></script>

<script src="{{ asset('backend/plugins/morris/morris.min.js')}}"></script>
<script src="{{ asset('backend/plugins/raphael/raphael-min.js')}}"></script>
<script src="{{ asset('backend/js/apexcharts.js')}}"></script>
<script src="{{ asset('backend/js/chart-data.js')}}"></script>

<script src="{{ asset('backend/js/app.js')}}"></script>

<script src="{{ asset('backend/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('backend/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    $(document).ready(function() {
        if ("{{ !empty(session('success')) }}") {
            successMsg("{{ session('success') }}")
        }
        if ("{{ !empty(session('error')) }}") {
            errorMsg("{{ session('error') }}")
        }
    })
</script>
</body>

</html>
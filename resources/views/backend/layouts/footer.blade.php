</div>


<!-- jQuery and DataTables JS CDN -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>

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

    $(document).ready(function() {
        $('.DataTable').DataTable({
            scrollX: true, // Enables horizontal scrolling
            responsive: false, // Disables DataTables' built-in responsiveness
            dom: '<"row"<"col-md-6"l><"col-md-6"f>>tipr', // Adjusts table layout (optional)
        });
    });
</script>
</body>

</html>
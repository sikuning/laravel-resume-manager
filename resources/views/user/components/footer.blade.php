    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright © 2023 | <a href="https://github.com/sikuning" target="_blank">Sikuning</a></strong>
    </footer>
    <input type="hidden" class="demo" value="{{url('/')}}"></input>
    <!-- ./wrapper -->
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('public/assets/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('public/assets/js/moment.min.js')}}"></script>
    <script src="{{asset('public/assets/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Tokenfield Js -->
    <script src="{{asset('public/assets/js/tokenfield.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('public/assets/js/bs-custom-file-input.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('public/assets/js/daterangepicker.js')}}"></script>
    <script src="{{asset('public/assets/js/iconpicker.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('public/assets/js/adminlte.js')}}"></script>

    <!-- jquery-validation -->
    <script src="{{asset('public/assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('public/assets/js/additional-methods.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('public/assets/js/summernote-bs4.min.js')}}"></script>
    <!-- SweetAlert -->
    <script src="{{asset('public/assets/js/sweetalert2.min.js')}}"></script>
    <!-- Main_ajax.js -->
    <script src="{{asset('public/assets/js/user-action.js')}}"></script>
    <input type="hidden" class="site-url" value="{{url('/')}}"></input>
    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        $(function () {
            // Summernote
            $('.textarea').summernote()
        })

        $('#target').on('change', function(e) {
            $("#icon").val(e.icon);
        });
    </script>
    @yield('pageJsScripts')
</body>
</html>

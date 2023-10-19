 <!-- base:js -->
 <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
 <!-- endinject -->
 <!-- Plugin js for this page-->
 <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
 <!-- End plugin js for this page-->
 <!-- inject:js -->
 <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
 <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
 <script src="{{ asset('assets/js/template.js') }}"></script>
 <script src="{{ asset('assets/js/settings.js') }}"></script>
 <script src="{{ asset('assets/js/todolist.js') }}"></script>
 <!-- endinject -->
 <!-- Custom js for this page-->
 <script src="{{ asset('assets/js/dashboard.js') }}"></script>
 <!-- End custom js for this page-->
 <script>
     var msg = '{{ Session::get('alert') }}';
     var exist = '{{ Session::has('alert') }}';
     if (exist) {
         alert(msg);
     }
 </script>

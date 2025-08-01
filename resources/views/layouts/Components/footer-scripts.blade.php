<!-- BACK-TO-TOP -->
<a class="hidden-print" href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

<!-- JQUERY JS -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

<!-- BOOTSTRAP JS -->
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- SPARKLINE JS-->
<script src="{{ asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

<!-- CHART-CIRCLE JS -->
<script src="{{ asset('assets/plugins/circle-progress/circle-progress.min.js') }}"></script>

{{-- timer --}}
<script src="{{ asset('assets/plugins/counters/jquery.missofis-countdown.js') }}"></script>

<script src="{{ asset('assets/plugins/morris/raphael-min.js') }}"></script>
<script src="{{ asset('assets/plugins/morris/morris.js') }}"></script>

<!-- C3.JS CHART JS -->
<script src="{{ asset('assets/plugins/charts-c3/d3.v5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/charts-c3/c3-chart.js') }}"></script>

<!-- INPUT MASK JS-->
<script src="{{ asset('assets/plugins/input-mask/jquery.mask.min.js') }}"></script>

<!-- SIDE-MENU JS-->
<script src="{{ asset('assets/plugins/sidemenu/sidemenu.js') }}"></script>

<!-- SIDEBAR JS -->
<script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>

<!-- Perfect SCROLLBAR JS-->
<script src="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/plugins/p-scroll/pscroll.js') }}"></script>

<script src="{{ asset('assets/plugins/echarts/echarts.js') }}"></script>

<!--CUSTOM JS -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!-- Color Change JS -->
<script src="{{ asset('assets/js/color-change.js') }}"></script>

<script src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/datatable.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/my-js/the-data-table.js') }}"></script>

{{-- add by laith --}}

<script src="{{ asset('assets/plugins/multipleselect/multiple-select.js') }}"></script>
<script src="{{ asset('assets/plugins/multipleselect/multi-select.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

<script src="{{ asset('assets/plugins/summernote/summernote-bs4.js') }}"></script>
{{-- <script src="{{ asset('assets/js/summernote.js') }}"></script> --}}

<script src="{{ asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>

<script>
    // 
    function sidenavToggledApi() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $.ajax({
            url: "{{ route('sidenav.toggled') }}",
            type: 'POST',
            success: function(result) {}
        });
    }
</script>

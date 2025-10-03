@yield('main_js_admin')
<!DOCTYPE html>
<html lang="en">

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">

    <!-- [Page Specific JS] start -->
    <script src="../assets_admin/js/plugins/apexcharts.min.js"></script>
    <script src="../assets_admin/js/pages/dashboard-default.js"></script>
    <!-- [Page Specific JS] end -->
    <!-- Required Js -->
    <script src="../assets_admin/js/plugins/popper.min.js"></script>
    <script src="../assets_admin/js/plugins/simplebar.min.js"></script>
    <script src="../assets_admin/js/plugins/bootstrap.min.js"></script>
    <script src="../assets_admin/js/fonts/custom-font.js"></script>
    <script src="../assets_admin/js/pcoded.js"></script>
    <script src="../assets_admin/js/plugins/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../assets_admin/js/plugins/jquery.dataTables.min.js"></script>
    <script src="../assets_admin/js/plugins/dataTables.bootstrap5.min.js"></script>
    <script>
        layout_change('light');
    </script>

    <script>
        change_box_container('false');
    </script>

    <script>
        layout_rtl_change('false');
    </script>

    <script>
        preset_change("preset-1");
    </script>

    <script>
        font_change("Public-Sans");
    </script>
    <script>
        // [ Zero Configuration ] start
        $('#simpletable').DataTable();

        // [ Default Ordering ] start
        $('#order-table').DataTable({
            order: [
                [3, 'desc']
            ]
        });

        // [ Multi-Column Ordering ]
        $('#multi-colum-dt').DataTable({
            columnDefs: [{
                    targets: [0],
                    orderData: [0, 1]
                },
                {
                    targets: [1],
                    orderData: [1, 0]
                },
                {
                    targets: [4],
                    orderData: [4, 0]
                }
            ]
        });

        // [ Complex Headers ]
        $('#complex-dt').DataTable();

        // [ DOM Positioning ]
        $('#DOM-dt').DataTable({
            dom: '<"top"i>rt<"bottom"flp><"clear">'
        });

        // [ Alternative Pagination ]
        $('#alt-pg-dt').DataTable({
            pagingType: 'full_numbers'
        });

        // [ Scroll - Vertical ]
        $('#scr-vrt-dt').DataTable({
            scrollY: '200px',
            scrollCollapse: true,
            paging: false
        });

        // [ Scroll - Vertical, Dynamic Height ]
        $('#scr-vtr-dynamic').DataTable({
            scrollY: '50vh',
            scrollCollapse: true,
            paging: false
        });

        // [ Language - Comma Decimal Place ]
        $('#lang-dt').DataTable({
            language: {
                decimal: ',',
                thousands: '.'
            }
        });
    </script>

</body>
<!-- [Body] end -->

</html>

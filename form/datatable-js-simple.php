<!--<link rel="stylesheet" type="text/css" href="../../assets/widgets/datatable/datatable.css">-->
<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/datatable/datatable.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/datatable/datatable-bootstrap.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/datatable/datatable-tabletools.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/datatable/datatable-reorder.js"></script>
<script type="text/javascript">

    /* Datatables export */

    $(document).ready(function() {

      var table = $('#datatable-tabletools').DataTable({});
      var tt = new $.fn.dataTable.TableTools( table );
      $('.dataTables_filter input').attr("placeholder", "Search...");

    });


    $(document).ready(function() {
        $('.dataTables_filter input').attr("placeholder", "Search...");
    });

</script>
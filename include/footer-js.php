    <!-- WIDGETS -->

<script type="text/javascript" src="<?=BASE_URL?>assets/bootstrap/js/bootstrap.js"></script>

<!-- Bootstrap Dropdown -->

<!-- <script type="text/javascript" src="../../assets/widgets/dropdown/dropdown.js"></script> -->

<!-- Bootstrap Tooltip -->

<!-- <script type="text/javascript" src="../../assets/widgets/tooltip/tooltip.js"></script> -->

<!-- Bootstrap Popover -->

<!-- <script type="text/javascript" src="../../assets/widgets/popover/popover.js"></script> -->

<!-- Bootstrap Progress Bar -->

<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/progressbar/progressbar.js"></script>

<!-- Bootstrap Buttons -->

<!-- <script type="text/javascript" src="../../assets/widgets/button/button.js"></script> -->

<!-- Bootstrap Collapse -->

<!-- <script type="text/javascript" src="../../assets/widgets/collapse/collapse.js"></script> -->

<!-- Superclick -->

<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/superclick/superclick.js"></script>

<!-- Input switch alternate -->

<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/input-switch/inputswitch-alt.js"></script>

<!-- Slim scroll -->

<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/slimscroll/slimscroll.js"></script>

<!-- Slidebars -->

<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/slidebars/slidebars.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/slidebars/slidebars-demo.js"></script>

<!-- PieGage -->

<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/charts/piegage/piegage.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/charts/piegage/piegage-demo.js"></script>

<!-- Screenfull -->

<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/screenfull/screenfull.js"></script>

<!-- Content box -->

<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/content-box/contentbox.js"></script>

<!-- Overlay -->

<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/overlay/overlay.js"></script>

<!-- Widgets init for demo -->

<script type="text/javascript" src="<?=BASE_URL?>assets/js-init/widgets-init.js"></script>

<!-- Theme layout -->

<script type="text/javascript" src="<?=BASE_URL?>assets/themes/admin/layout.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/noty-notifications/noty.js"></script>

<!-- Theme switcher -->

<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/theme-switcher/themeswitcher.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>assets/js/function.js"></script>

<script type="text/javascript">
// @sk(5717) script to change Switch status
function toggleSwitch(id,tbl_id,status)
{
$.ajax({
	 url:"ajax/update-status.php",
	 type:"POST",
	 dataType:"json",
	 data:{id:id,tbl_id:tbl_id,status:status},
	 beforeSend: function()
	 {	 
	 },
	 success(res)
	 {
	 }
	});	
}
</script>
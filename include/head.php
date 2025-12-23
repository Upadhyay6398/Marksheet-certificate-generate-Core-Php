<style>
/* Loading Spinner */
    .spinner{margin:0;width:70px;height:18px;margin:-35px 0 0 -9px;position:absolute;top:50%;left:50%;text-align:center}.spinner > div{width:18px;height:18px;background-color:#333;border-radius:100%;display:inline-block;-webkit-animation:bouncedelay 1.4s infinite ease-in-out;animation:bouncedelay 1.4s infinite ease-in-out;-webkit-animation-fill-mode:both;animation-fill-mode:both}.spinner .bounce1{-webkit-animation-delay:-.32s;animation-delay:-.32s}.spinner .bounce2{-webkit-animation-delay:-.16s;animation-delay:-.16s}@-webkit-keyframes bouncedelay{0%,80%,100%{-webkit-transform:scale(0.0)}40%{-webkit-transform:scale(1.0)}}@keyframes bouncedelay{0%,80%,100%{transform:scale(0.0);-webkit-transform:scale(0.0)}40%{transform:scale(1.0);-webkit-transform:scale(1.0)}}
    div.pagination{padding:3px;margin:3px}div.pagination a{padding:2px 5px;margin:2px;border:1px solid #AAD;text-decoration:none;color:#1F1F1F}div.pagination a:hover,div.pagination a:active{border:1px solid #1F1F1F;color:#000}div.pagination span.current{padding:2px 5px;margin:2px;border:1px solid #1F1F1F;font-weight:700;background-color:#1F1F1F;color:#FFF}div.pagination span.disabled{padding:2px 5px;margin:2px;border:1px solid #EEE;color:#DDD}
</style>


<meta charset="UTF-8">
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<title><?=DEFAULT_TITLE?> | Admin</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Favicons -->

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=BASE_URL?>assets/images/icons/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=BASE_URL?>assets/images/icons/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=BASE_URL?>assets/images/icons/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?=BASE_URL?>assets/images/icons/apple-touch-icon-57-precomposed.png">
<?php /*?><link rel="shortcut icon" href="<?=BASE_URL?>assets/images/icons/favicon.png"><?php */?>

	<link href="https://www.learnwithleaders.com/images/lande-leaders/fav.png" rel="shortcut icon" type="image/x-icon"/><link href="https://www.learnwithleaders.com/images/lande-leaders/fav.png" rel="apple-touch-icon"/>



    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/bootstrap/css/bootstrap.css">


<!-- HELPERS -->

<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/helpers/animate.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/helpers/backgrounds.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/helpers/boilerplate.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/helpers/border-radius.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/helpers/grid.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/helpers/page-transitions.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/helpers/spacing.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/helpers/typography.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/helpers/utils.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/helpers/colors.css">


<!-- ELEMENTS -->

<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/badges.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/buttons.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/content-box.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/dashboard-box.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/forms.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/images.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/info-box.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/invoice.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/loading-indicators.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/menus.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/panel-box.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/response-messages.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/responsive-tables.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/ribbon.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/social-box.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/tables.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/tile-box.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/elements/timeline.css">



<!-- ICONS -->

<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/icons/fontawesome/fontawesome.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/icons/linecons/linecons.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/icons/spinnericon/spinnericon.css">


<!-- WIDGETS -->

<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/accordion-ui/accordion.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/calendar/calendar.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/carousel/carousel.css">

<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/charts/justgage/justgage.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/charts/morris/morris.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/charts/piegage/piegage.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/charts/xcharts/xcharts.css">

<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/chosen/chosen.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/colorpicker/colorpicker.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/datatable/datatable.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/datepicker/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/datepicker-ui/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/daterangepicker/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/dialog/dialog.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/dropdown/dropdown.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/dropzone/dropzone.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/file-input/fileinput.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/input-switch/inputswitch.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/input-switch/inputswitch-alt.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/ionrangeslider/ionrangeslider.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/jcrop/jcrop.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/jgrowl-notifications/jgrowl.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/loading-bar/loadingbar.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/maps/vector-maps/vectormaps.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/markdown/markdown.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/modal/modal.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/multi-select/multiselect.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/multi-upload/fileupload.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/nestable/nestable.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/noty-notifications/noty.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/popover/popover.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/pretty-photo/prettyphoto.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/progressbar/progressbar.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/range-slider/rangeslider.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/slidebars/slidebars.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/slider-ui/slider.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/summernote-wysiwyg/summernote-wysiwyg.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/tabs-ui/tabs.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/theme-switcher/themeswitcher.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/timepicker/timepicker.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/tocify/tocify.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/tooltip/tooltip.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/touchspin/touchspin.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/uniform/uniform.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/wizard/wizard.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/widgets/xeditable/xeditable.css">

<!-- SNIPPETS -->

<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/snippets/chat.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/snippets/files-box.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/snippets/login-box.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/snippets/notification-box.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/snippets/progress-box.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/snippets/todo.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/snippets/user-profile.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/snippets/mobile-navigation.css">

<!-- APPLICATIONS -->

<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/applications/mailbox.css">

<!-- Admin theme -->

<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/themes/admin/layout.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/themes/admin/color-schemes/default.css">

<!-- Components theme -->

<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/themes/components/default.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/themes/components/border-radius.css">

<!-- Admin responsive -->

<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/helpers/responsive-elements.css">
<link rel="stylesheet" type="text/css" href="<?=BASE_URL?>assets/helpers/admin-responsive.css">

<!-- JS Core -->

<script type="text/javascript" src="<?=BASE_URL?>assets/js-core/jquery-core.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>assets/js-core/jquery-ui-core.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>assets/js-core/jquery-ui-widget.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>assets/js-core/jquery-ui-mouse.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>assets/js-core/jquery-ui-position.js"></script>
<!--<script type="text/javascript" src="../../assets/js-core/transition.js"></script>-->
<script type="text/javascript" src="<?=BASE_URL?>assets/js-core/modernizr.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>assets/js-core/jquery-cookie.js"></script>





<script type="text/javascript">
    $(window).load(function(){
        setTimeout(function() {
            $('#loading').fadeOut( 400, "linear" );
        }, 300);
    });
</script>
<?php
/**
 * Created by PhpStorm.
 * User: o.ogunsola
 * Date: 7/18/14
 * Time: 7:44 PM
 */
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>HOF Procurement Portal</title>
        <meta name="description" content="HOF Procurement Portal is an end to end procurement portal developed by Crèyatif (Oluwamayowa Steepe)." />
        <meta name="keywords" content="House of Freedom, Crèyatif, Oluwamayowa Steepe, Kreyatif, Procurement" />
        <meta name="author" content="Crèyatif"/>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.ico');?>"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- global css -->
        <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/app.css');?>"/>
        <!-- end of global css -->
        <!--page level css -->
        <link rel="stylesheet" href="<?php echo base_url('assets/vendors/swiper/css/swiper.min.css');?>">
        <link href="<?php echo base_url('assets/vendors/nvd3/css/nv.d3.min.css');?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url('assets/vendors/lcswitch/css/lc_switch.css');?>"">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/custom.css');?>"">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/custom_css/skins/skin-default.css');?>"" type="text/css" id="skin"/>
        <link href="<?php echo base_url('assets/css/custom_css/dashboard1.css');?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/css/custom_css/dashboard1_timeline.css');?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/css/upload.css');?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/css/alertmessage.css');?>" rel="stylesheet">

        <!--end of page level css-->
        <!--page level css -->
        <link href="<?php echo base_url('assets/vendors/iCheck/css/all.css');?>" rel="stylesheet"/>
        <link href="<?php echo base_url('assets/vendors/bootstrap-fileinput/css/fileinput.min.css');?>" media="all" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/custom.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/custom_css/skins/skin-default.css');?>" type="text/css" id="skin"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/formelements.css');?>">
        <!--end of page level css-->


        <script type="text/javascript">

            function delete_vendor(vendor_id){
                // alert(vendor_id);
                dataString = vendor_id;

                $.ajax({
                    type:"POST",
                    url:"<?php echo base_url('home/delete_vendor'); ?>"+"/"+dataString,
                    data:dataString,

                    success:function (datax) {
                        //alert(datax);
                        alert("Vendor has been successfully deleted.");
                        $('#tab10').html('<img src="<?php echo base_url('assets/images/725.GIF');?>"/>')
                            .load('<?php echo base_url('home/get_vendors'); ?>');

                    },

                    error: function(datax) {
                        alert("Vendor has not been successfully deleted. Try again.");
                        $('#tab10').html('<img src="<?php echo base_url('assets/images/725.GIF');?>"/>')
                            .load('<?php echo base_url('home/get_vendors'); ?>');
                    }
                });
                // event.preventDefault();
            }

            function toggle_approval(vendor_id, is_approved) {
                // alert(vendor_id);
                dataString = vendor_id;
                dataString_y = is_approved;

                $.ajax({
                    type:"POST",
                    url:"<?php echo base_url('home/toggle_vendor_approval'); ?>"+"/"+dataString+"/"+dataString_y,
                    //data:dataString,

                    data: {
                        id : dataString,
                        status: dataString_y
                    },

                    success:function (datax) {
                        //prompt("Copy to clipboard: Ctrl+C, Enter", datax);
                        //alert(datax);
                        //alert("Vendor has been successfully deleted.");
                        $('#tab10').html('<img src="<?php echo base_url('assets/images/725.GIF');?>"/>')
                            .load('<?php echo base_url('home/get_vendors'); ?>');

                    },

                    error: function(datax) {
                        // alert("Vendor has not been successfully deleted. Try again.");
                        $('#tab10').html('<img src="<?php echo base_url('assets/images/725.GIF');?>"/>')
                            .load('<?php echo base_url('home/get_vendors'); ?>');
                    }
                });
                // event.preventDefault();
            }


            function getSubTotal() {
                $(document).ready(function(){
                    var counter = $("#item_counter").val();
                    var quantity = $("#quantity_"+counter).val();
                    var unit_price = $("#unit_price_"+counter).val();
                    $("#total_"+counter).val(quantity*unit_price);
                });
                return false;
            }



        </script>
    </head>

    <body class="skin-default">
    <div class="preloader">
        <div class="loader_img"><img src="<?php echo base_url('assets/img/loader.gif');?>" alt="loading..." height="64" width="64"></div>
    </div>

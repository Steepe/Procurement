<?php
/**
 * Created by PhpStorm.
 * User: o.ogunsola
 * Date: 7/18/14
 * Time: 7:45 PM
 */
?>

<!-- global js -->
<div id="qn"></div>

<script src="<?php echo base_url('assets/js/app.js');?>" type="text/javascript"></script>
<!-- end of global js -->


<!-- begining of page level js -->
<!--Sparkline Chart-->

<!-- flip --->
<script type="text/javascript" src="<?php echo base_url('assets/vendors/flip/js/jquery.flip.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendors/lcswitch/js/lc_switch.min.js');?>"></script>
<!--swiper-->
<script type="text/javascript" src="<?php echo base_url('assets/vendors/swiper/js/swiper.min.js');?>"></script>
<!--chartjs-->
<script src="<?php echo base_url('assets/vendors/chartjs/js/Chart.js');?>"></script>
<!--nvd3 chart-->
<script type="text/javascript" src="<?php echo base_url('assets/js/nvd3/d3.v3.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendors/nvd3/js/nv.d3.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendors/moment/js/moment.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendors/advanced_newsTicker/js/newsTicker.js');?>"></script>

<script src="<?php echo base_url('assets/vendors/iCheck/js/icheck.js');?>"></script>
<script src="<?php echo base_url('assets/vendors/bootstrap-fileinput/js/fileinput.min.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/custom_js/form_elements.js');?>"></script>
<script src="vendors/insignia/js/insignia.js"></script>
<script type="text/javascript" src="js/custom_js/insignia_custom.js');?>"></script>
<!-- end of page level js -->
<!-- Data table JavaScript -->
<script type="text/javascript" src="<?php echo base_url('assets/vendors/datatables/js/jquery.dataTables.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendors/datatables/js/dataTables.bootstrap.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/custom_js/datatables_custom.js');?>"></script>
<!-- File upload -->
<script  src="<?php echo base_url('assets/uploader/plupload.full.min.js');?>"></script>
<script src="<?php echo base_url('assets/uploader/plupload.queue.min.js');?>"></script>
<script type="text/javascript">
    //===== Pluploader (multiple file uploader) =====//
    $(function() {

        $(".multiple-uploader").pluploadQueue({
            runtimes : 'html5, html4',
            //url : 'http://www.thispresenthouse.org/procurement/uploader/do_upload',
            url : 'http://localhost/procurement/uploader/do_upload',
            //url : '<?php echo base_url("uploader/do_upload");?>',
            chunk_size : '1mb',
            unique_names : true,
            filters : {
                max_file_size : '10mb',
                mime_types: [
                    {title : "Image files", extensions : "jpg,gif,png,pdf"},
                    {title : "Zip files", extensions : "zip"}
                ]
            },
            resize : {width : 320, height : 240, quality : 90}
        });
    });
</script>





<script>
    $(document).ready(function () {
// var documentViewer = $('#document-preview').documentViewer({ debug:true });

        $("#mayowa").click(function(e){
            documentViewer.load('http://localhost/procurement/uploads/two-cities.txt');

        });

        $('#requestList').DataTable({
            "order":[[0, "desc"]],
            select: true
        });


        $("#add_new_vendor").submit(function(e){
            event.preventDefault();
            dataString = $("#add_new_vendor").serialize();
//alert(dataString);

            $.ajax({
                type:"POST",
                url:"<?php echo base_url('home/do_add_new_vendor'); ?>",
                data:dataString,

                success:function (datax) {
                    alert("Vendor has been successfully added.");
                    $('#add_new_vendor').trigger("reset");
                },

                error: function(datax) {
                    alert("Vendor has not been successfully added. Try again.");
                    $('#add_new_vendor').trigger("reset");
                }
            });

        });


        $("#vendortab").click(function(e){
            $('#tab10').html('<img src="<?php echo base_url('assets/images/725.GIF');?>"/>')
                .load('<?php echo base_url('home/get_vendors'); ?>');
        });

        $("#testme").click(function(e){
            alert("deleted.");
        });


        $("#delete_vendor").click(function(e){
            alert("deleted.");
        });

        $("#request_subject").click(function(e){
            var drogo = $('#request_subject').val()

        });


//var cloneCount = 1;

        var count = $("#more_items_div").children().length + 1;
        $("#add_item").click(function(){
// alert(count);
            count++;

            var htmlx = '<div class="form-group" id="to_duplicate">\n' +
                '                        <label class="col-sm-2 control-label">Item(s): </label>\n' +
                '                        <div class="col-sm-2">\n' +
                '                            <textarea id="description_'+count+'" name="description_'+count+'" class="form-control" placeholder="Description"></textarea>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-2">\n' +
                '                            <input type="number" min="1" id="quantity_'+count+'" name="quantity_'+count+'" class="form-control stark" value="" placeholder="Quantity">\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-2">\n' +
                '                            <input type="number" step=".01" min="1" id="unit_price_'+count+'" name="unit_price_'+count+'" class="form-control" value="" placeholder="Unit Price" onchange="javascript:getSubTotal();">\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-2">\n' +
                '                            <input type="text" id="total_'+count+'" name="total_'+count+'" class="form-control" value="" placeholder="Total" readonly>\n' +
                '                        </div>\n' +
                '                    </div>'.toString();

            $( htmlx ).appendTo( $( "#more_items_div" ) );

            $("#item_counter").val(count);

        });



    });
</script>


</body>

</html>
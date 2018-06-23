<?php
/**
 * Created by PhpStorm.
 * User: Oluwamayowa Steepe
 * Date: 19-Dec-17
 * Time: 10:54 PM
 * Project: procurement
 */
?>

<table class="table table-bordered table-striped" id="requestList">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Service</th>
                                    <th>Approve</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sn = key($vendors);
                                foreach($vendors as $vendor){
                                    $sn++;
                                    ?>
                                    <tr>
                                        <td><?php echo $sn;?></td>
                                        <td><a href="javascript:window.open('<?php echo base_url('load_vendor_details')."/".$vendor['vendor_id']?>', '', 'width=700 height=600')"><?php echo $vendor['vendor_name'];?></a></td>
                                        <td><?php echo $vendor['vendor_email'];?></td>
                                        <td><?php echo $vendor['vendor_service'];?></td>
                                        <td><a href="javascript:toggle_approval('<?php echo $vendor['vendor_id'];?>','<?php echo $vendor['is_approved'];?>');" id="testme"><span class="label <?php echo ($vendor['is_approved']=='1') ? 'label-success' : 'label-danger' ;?>"><?php echo ($vendor['is_approved']=='1') ? 'Approved' : 'Not Approved' ;?></span></a></td>
                                        <td><a href="javascript:delete_vendor('<?php echo $vendor['vendor_id'];?>');" id="delete_vendor"><i class="icon-bubble-trash"></i></a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
</tbody>
</table>



<?php
/**
 * Created by PhpStorm.
 * Author: Oluwamayowa Steepe
 * Date: 11-Jan-16
 * Time: 5:45 PM
 */
?>
<table class="table table-bordered table-striped datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>User Role</th>
                                    <th>Last Visit</th>
                                    <th>Pass Changes</th>
                                    <th>Last Pass Change</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sn = key($admin_users);
                                foreach($admin_users as $admin_user){
                                    $sn++;
                                    ?>
                                    <tr>
                                        <td><?php echo $sn;?></td>
                                        <td><?php echo $admin_user['firstname']." ".$admin_user['lastname'];?></td>
                                        <td><?php echo $admin_user['email'];?></td>
                                        <td><?php echo $admin_user['user_role'];?></td>
                                        <td><?php echo $admin_user['last_visit'];?></td>
                                        <td><?php echo $admin_user['no_password_change'];?></td>
                                        <td><?php echo $admin_user['last_password_change'];?></td>
                                        <td><a href="javascript:delete_admin_user(<?php echo $admin_user['admin_id'];?>);" id="delete_admin_user"><i class="icon-bubble-trash"></i></a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
</tbody>
</table>

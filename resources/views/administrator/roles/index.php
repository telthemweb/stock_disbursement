 <div class="container-fluid px-xl-5 mt-lg-5">
        <button class="btn btn-success float-right rounded-0"  data-toggle="modal" data-target="#user-form-modal">
            New Role <i class="fa fa-lock"></i>
        </button>
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>USER ROLES</span><small class="px-1"></small></h6>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="max-width">Name</th>
                                            <th class="max-width">Level</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody id="role">
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($roles as $role): $i++; ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i ?></td>
                                                <td><?php echo $role->name; ?></td>
                                                <td><?php echo $role->level; ?></td>
                                                <td class="text-center">
                                                <a class="text-success"  href="<?php route('/role/v/'.$role->id); ?>" >
                                                        <i class="fa fa-edit mr-3 text-green"></i>
                                                    </a> 
                                                    <?php if($_SESSION['role_id']==5):?>
                                                    <a class="text-danger" href="<?php route('/role/delete/'. $role->id); ?>" ><i class="fa fa-trash mr-3 text-danger"></i> </a>
                                                       <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
































<div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">CREATE ROLE</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <form action="<?php route('/create'); ?>" method="POST">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                        <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="name" placeholder="Role Name"
                                       required="required" id="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" form-div">

                                <select class="form-control" name="level" id="level">
                                    <option value="" disabled selected>Select role Level</option>
                                    <option value="ADMIN">ADMIN</option>
                                    <option value="SUPERADMIN">SUPERADMIN</option>
                                    <option value="PROCUREMENT">STORES PERSON</option>
                                    <option value="STORES_CLERK">STORE CLERK</option>
                                    <option value="INPUTS_CLERK">INPUT CLERK</option>
                                  </select>
                            </div>
                        </div>
                        <div class="float-lg-right">
                            <div class="">
                                <button type="submit" class="btn btn-primary login-btn btn-block">SUBMIT</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


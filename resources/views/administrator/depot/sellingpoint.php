<div class="container-fluid px-xl-5 mt-lg-5">
    <button class="btn btn-success float-right rounded-0"  data-toggle="modal" data-target="#user-form-modal">
       New CIDP <i class="fa fa-folder"></i>
    </button>
    <div class="container user-list">
        <div class="row flex-lg-nowrap">
            <div class="col-lg-12">
                <div id="switchPoint" class="e-panel card">
                    <div class="card-body">
                        <div class="card-title">
                            <h6 class="mr-2"><span><b class="text-info">CIDP for=><?php echo strtoupper($depot->name); ?> </b></small></h6>
                        </div>
                        <div class="e-table">
                            <div class="table-responsive table-lg mt-3">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="max-width">Name</th>
                                        <th class="max-width text-center">Clerk</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="role">
                                    <?php
                                    $i =0; ?>
                                    <?php foreach ($depotcidps as $cips): $i++; ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i ?></td>
                                            <td><?php echo $cips->name; ?></td>
                                            <?php  if($cips->administrator_id !=null): ?>
                                            <td><?php echo  $cips->administrator->name.' '.$cips->administrator->surname; ?></td>
                                        <?php else: ?>
                                            <td class="text-center"><b class="text-center text-danger">Input Clerk not yet assigned</b></td>
                                        <?php endif; ?>
                                            <td class="text-center">
                                                <a href="<?php route('/cidp/e/'.$cips->id); ?>"><i class="fa fa-edit mr-3 text-green"></i></a>
                                                    <?php if($_SESSION['role_id']==5):?>
                                                    <a href="<?php route('/depot/delete/'.$cips->id); ?>"><i class="fa fa-trash mr-3 text-danger"></i></a>
                                                    <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                     
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




     <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">CREATE CIDP</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <form action="<?php route('/cidp/add'); ?>" method="POST">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                        <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3 rounded-0" name="name" placeholder="Cidp Name" required="required" id="name">
                                <input type="hidden" class="form-control pl-3 rounded-0" name="depot_id" value="<?php echo
                                $depot->id ?>">
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="rounded">
                              <select class="form-control" name="administrator_id" id="administrator_id">
                                    <option value="" disabled selected>Select Clerk</option>
                                     <?php foreach ($administrators as $sup): ?>
                                            <option value="<?php echo $sup->id ?>"><?php echo $sup->name .' '.$sup->surname ?></option>
                                        <?php endforeach ?>
                             </select>
                            </div>
                        </div>
                       
                        <div class="float-lg-right">
                            <div class="">
                                <button type="submit" class="btn btn-success rounded-0 login-btn btn-block">Add</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
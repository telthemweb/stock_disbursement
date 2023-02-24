 <div class="container-fluid px-xl-5 mt-lg-2">
        <button class="btn btn-success float-right rounded-0"  data-toggle="modal" data-target="#user-form-modal">
            New Supplier <i class="fa fa-car"></i>
        </button>
        <div class="container user-list">
            <div class="row flex-lg-nowrap mb-5">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>SUPPLIERS</span><small class="px-1"></small></h6>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="max-width">Supplier name</th>
                                            <th class="max-width">Phone number</th>
                                            <th class="max-width">Email Address</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody id="role">
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($suppliers as $sup): $i++; ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i ?></td>
                                       <td> <?php echo $sup->name; ?></td>
                                                <td><?php echo $sup->phone; ?></td>
                                                <td><?php echo $sup->email;; ?></td>
                                                <td class="text-center">
                                                <a class="text-success"  href="<?php route('/supplier/e/'.$sup->id); ?>" >
                                                        <i class="fa fa-edit mr-3 text-green"></i>
                                                    </a> 
                                                    <?php if($_SESSION['role_id']==5):?>
                                                    <a class="text-danger" href="<?php route('/supplier/delete/'. $sup->id); ?>" ><i class="fa fa-trash mr-3 text-danger"></i> </a>
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
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">CREATE SUPPLIER</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <form action="<?php route('/supplier/add'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                        <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="name" placeholder="Company Name"
                                       required="required" id="name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="email" placeholder="Email Address"
                                       required="required" id="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="phone" placeholder="Phone Number"
                                       required="required" id="phone">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="city" placeholder="Town/City"
                                       required="required" id="city">
                            </div>
                        </div>

                         <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="address" placeholder="Physical Address"
                                       required="required" id="address">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="rounded">
                                <label for="">Company Logo <b>[png|jpg]</b></label>
                                <input type="file" class="form-control pl-3" name="image" required="required" id="image">
                            </div>
                        </div>
                        
                        <div class="float-lg-right">
                            <div class="">
                                <button type="submit" class="btn btn-success login-btn btn-block">Register</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


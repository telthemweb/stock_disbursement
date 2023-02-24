 <div class="container-fluid px-xl-5 mt-lg-2">
        <button class="btn btn-success float-right rounded-0"  data-toggle="modal" data-target="#user-form-modal">
            New Farmer <i class="fa fa-tractor"></i>
        </button>
        <div class="container user-list">
            <div class="row flex-lg-nowrap mb-5">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>FARMERS</span><small class="px-1"> Depot =><?php echo $cidpoint->depot->name ?> ===>CIDP=> <?php echo $cidpoint->name ?></small></h6>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="max-width">Gwower #</th>
                                            <th class="max-width">Fullname</th>
                                            <th class="max-width">CIDP</th>
                                            <th class="max-width">Ward</th>
                                            <th class="max-width">Phone</th>
                                            <th class="max-width">Identity #</th>
                                            <th class="max-width">Marital</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody id="role">
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($farmers as $farmer): $i++; ?>
                                            <tr>

                                             
                                                <td class="text-center"><?php echo $i ?></td>
                                                 <td><?php echo $farmer->customercode; ?></td>
                                                <td><?php echo $farmer->name . '  '.$farmer->surname;; ?></td>
                                                <td><?php echo $farmer->cidp->name; ?></td>
                                                <td><?php echo $farmer->ward; ?></td>
                                                <td><?php echo $farmer->phonenumber; ?></td>
                                                <td><?php echo $farmer->identitynumber; ?></td>
                                                <td><?php echo $farmer->marital_status; ?></td>
                                                <td class="text-center">
                                                   <a href="<?php route('/farmer/e/'.$farmer->id); ?>"><i class="fa fa-edit mr-3 text-green"></i></a>
                                                    <?php if($_SESSION['role_id']==5):?>
                                                    <a href="<?php route('/farmer/delete/'.$farmer->id); ?>"><i class="fa fa-trash mr-3 text-danger"></i></a>
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
                <h5 class="modal-title text-white">CREATE FARMER ACCOUNT</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <form action="<?php route('/farmer/add'); ?>" method="POST">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded-0">
                                        <input type="text" class="form-control pl-3" name="name" placeholder="First Name"
                                               required="required" id="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control pl-3" name="surname" placeholder="Last Name"
                                           required="required" id="surname">
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <select class="form-control" name="gender" id="gender">
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="Male">MALE</option>
                                        <option value="Female">FEMALE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="village" placeholder="Village" > 
                                        <input type="hidden" class="form-control pl-3" name="cidp_id" value="<?php echo $cidpoint->id ?>">
                                    </div>
                                </div>
                            </div>

                        </div>
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <select class="form-control" name="marital_status" id="marital_status">
                                        <option value="" disabled selected>Select Marital status</option>
                                        <option value="Married">Married</option>
                                        <option value="Single">Single</option>
                                        <option value="Widow">Widow</option>
                                        <option value="Divourced">Divourced</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="phonenumber" placeholder="Phone Number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="identitynumber" placeholder="Identity Number eg 4908877K49" 
                                               required="required" id="identitynumber">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="address" placeholder="Physical Address" id="address">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                         <input type="text" class="form-control pl-3" name="ward" placeholder="Ward" id="ward">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <select class="form-control" name="country" id="country">
                                            <option value="" disabled selected>Select Country</option>
                                             <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded-0">
                                        <input type="email" class="form-control pl-3" name="email" placeholder="Email Address"
                                                id="email">
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                             <div class="form-group">
                            <div class="rounded">
                                <select class="form-control" id="province" placeholder="Province" name="province" required></select>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <div class="rounded">
                                <select class="form-control" id="city" placeholder="District" name="district" required></select>
                            </div>
                        </div>
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

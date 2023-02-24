<div class="container-fluid px-xl-5 mt-lg-5">
    <?php if($_SESSION['role_id']=="5"): ?>
        <button class="btn btn-success float-right rounded-0"  data-toggle="modal" data-target="#user-form-modal">
            New Users <i class="fa fa-lock"></i>
        </button>
        <?php endif; ?>
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>System Administrators</span><small class="px-1"></small></h6>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="text-left">#</th>
                                            <th class="text-left">Username</th>
                                            <th class="text-left">Name</th>
                                            <th class="text-left">Gender</th>
                                            <th class="text-left">Role</th>
                                            <th class="text-left">Level</th>
                                            <th class="text-left">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody id="role">
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($administrators as $admin): $i++; ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i ?></td>
                                                <td><?php echo $admin->username ?></td>
                                                <td><?php echo $admin->name .' '.$admin->surname; ?></td>
                                                <td><?php echo $admin->gender; ?></td>
                                                <td><?php echo $admin->role->name; ?></td>
                                                <td><?php echo $admin->role->level; ?></td>
                                                <td>
                                                    <?php if($admin->status==1):?>
                                                    <p class="text-success text-body">ACTIVE</p>
                                                    <?php else: ?>
                                                    <b class="text-red text-body">BLOCKED</b>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <a class="text-success"  href="<?php route('/employee/v/'.$admin->id) ?>" >
                                                        <i class="fa fa-edit mr-3 text-green"></i>
                                                    </a>
                                                    <?php if($_SESSION['role_id']==5):?>
                                                    <a class="text-danger"  href="<?php route('/employee/d/'.$admin->id) ?>" >
                                                        <i class="fa fa-trash mr-3 text-red"></i>
                                                    </a>
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






























</div>
<footer class="ftco-footer" id="basic-footer">
    <div class="container-fluid bg-primary py-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="mb-0">
                    Copyright CUZ &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved </a>
                </p>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">CREATE USER ACCOUNT</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <form action="<?php route('/employee/register'); ?>" method="POST">
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

                                    <select class="form-control" name="role_id" id="role_id">
                                        <option value="" disabled selected>Select role</option>
                                        <?php foreach ($roles as $item): ?>
                                            <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="username" placeholder="Username"
                                               required="required" id="username">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="password" placeholder="Password"
                                               required="required" id="password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="address" placeholder="Physical Address"
                                               required="required" id="address">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="" disabled selected>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <select class="form-control" name="country" id="country">
                                            <option value="" disabled selected>Select Country</option>
                                            <option value="Agentina">Agentina</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="USA">USA</option>
                                            <option value="Zambia">Zambia</option>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control pl-3" name="phone" placeholder="Phone Number"
                                            id="phone">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded-0">
                                        <input type="text" class="form-control pl-3" name="province" placeholder="Province"
                                               id="province">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control pl-3" name="city" placeholder="City/Town"
                                           id="city">
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





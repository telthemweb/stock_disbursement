<div class="container-fluid px-xl-5 mt-lg-2">
     
        <div class="container user-list">
            <div class="row flex-lg-nowrap mb-5">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>UPDATE <?php echo strtoupper($farmer->name .' '.$farmer->surname); ?></span><small class="px-1"></small></h6>
                            </div>

                            <div class="py-1">
                            <form action="<?php route('/farmer/u/'.$farmer->id ); ?>" method="POST">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded-0">
                                        <input type="text" class="form-control pl-3" name="name" value="<?php echo $farmer->name; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control pl-3" name="surname" value="<?php echo $farmer->surname; ?>">
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
                                        <input type="text" class="form-control pl-3" name="village" value="<?php echo $farmer->village; ?>"> 
                                        <input type="hidden" class="form-control pl-3" name="cidp_id" value="<?php echo $farmer->cidp_id ?>">
                                    </div>
                                </div>
                            </div>

                        </div>
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <select class="form-control" name="marital_status" id="marital_status">
                                        <option value="" disabled selected><?php echo $farmer->marital_status; ?></option>
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
                                        <input type="text" class="form-control pl-3" name="phonenumber" value="<?php echo $farmer->phonenumber; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="identitynumber" value="<?php echo $farmer->identitynumber; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="address" value="<?php echo $farmer->address; ?>">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                         <input type="text" class="form-control pl-3" name="ward" value="<?php echo $farmer->ward; ?>">
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
                                        <input type="email" class="form-control pl-3" name="email" value="<?php echo $farmer->email; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control pl-3" name="phone" value="<?php echo $farmer->phone; ?>">
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
        </div>
    </div>

    
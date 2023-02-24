<div class="container rounded bg-white mt-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" src="<?php echo $_SESSION['gender']=="Male"? url('assets/img/male.ico'):url('assets/img/female.ico'); ?>" width="90"><span class="font-weight-bold"><?php echo $_SESSION['name'] ." ".$_SESSION['surname']; ?></span><span class="text-black-50"><?php echo $_SESSION['email']; ?></span><span><?php echo $_SESSION['country']; ?></span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-right">Personal Information</h6>
                        <div class="d-flex flex-row align-items-center back">
                            <a href="#" class="badge badge-danger p-2"><h6 class="text-light">Deactivate Account <i class="fa fa-times mr-1"></i></h6></a>
                        </div>
                        
                    </div>
                    <form action="<?php route('/profile/u/'.$administrator->id); ?>" method="POST">
                    <div class="row mt-2">
                        <div class="col-md-6"><input type="text" class="form-control" name="name" value="<?php echo $_SESSION['name'] ; ?>"></div>
                        <div class="col-md-6"><input type="text" class="form-control" name="surname" value="<?php echo $_SESSION['surname'] ; ?>"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><input type="text" class="form-control" name="email" value="<?php echo $_SESSION['email'] ; ?>"></div>
                        <div class="col-md-6"><input type="text" class="form-control" value="<?php echo $_SESSION['phone'] ; ?>" name="phone"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><input type="text" class="form-control" name="address" value="<?php echo $_SESSION['address'] ; ?>"></div>
                        <div class="col-md-6"><input type="text" class="form-control" value="<?php echo $_SESSION['country'] ; ?>" name="country"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><input type="text" class="form-control" name="city" value="<?php echo $_SESSION['city'] ; ?>"></div>
                        <div class="col-md-6"><input type="text" class="form-control" value="<?php echo $_SESSION['province'] ; ?>" name="province"></div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                             <select class="form-control" name="gender" id="gender">
                                <option value="" disabled selected><?php echo $_SESSION['gender'] ; ?></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                       <div class="col-md-6">
                             <select class="form-control" name="role_id" id="role_id">
                                 <option value="" disabled selected><?php echo $administrator->role->name; ?></option>
                                        <?php foreach ($roles as $item): ?>
                                            <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                        <?php endforeach ?>
                            </select>
                        </div>
                    </form>
                    </div>



                    <div class="row">
                        <div class="col"><div class="mt-5 text-left"><button class="btn btn-danger profile-button" type="button" data-toggle="modal" data-target="#changepassword" >Change Password</button></div></div>
                        <div class="col"><div class="mt-5 text-right"><button class="btn btn-success profile-button" type="button">Update Profile</button></div></div>
                    </div>

                </div>
            </div>
        </div>
    </div>







    <div class="modal fade" role="dialog" tabindex="-1" id="changepassword">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">CHANGE PASSWORD</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                     <form action="<?php route('/changepassword/c/'.$_SESSION['admin_id']) ?>" method="POST">
                            <div class="form-group">
                                <div class="rounded">
                                    <input type="text" class="form-control pl-3" name="newpassword" 
                                        required="required" placeholder="New Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="rounded">
                                    <input type="text" class="form-control pl-3" name="cnewpassword" 
                                        required="required" placeholder="Confirm New Password">
                                </div>
                            </div>
                            <div class="float-lg-right">
                                <div class="">
                                    <button type="submit" class="btn btn-danger login-btn btn-block">Change Password</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
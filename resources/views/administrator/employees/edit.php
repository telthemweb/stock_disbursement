<div class="container-fluid px-xl-5 mt-lg-2 mb-lg-5">
     
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>UPDATE <?php echo strtoupper($administrator->name.' '.$administrator->surname); ?></span><small class="px-1"></small></h6>
                            </div>

                            <div class="py-1">
                            <form action="<?php route('/employee/u/'.$administrator->id); ?>" method="POST">
                            <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded-0">
                                        <input type="text" class="form-control pl-3" name="name" value="<?php echo $administrator->name; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control pl-3" name="surname" value="<?php echo $administrator->surname; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <select class="form-control" name="role_id" id="role_id">
                                        <option value="" disabled selected><?php echo $administrator->role->name; ?></option>
                                        <?php foreach ($roles as $item): ?>
                                            <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="username" value="<?php echo $administrator->username; ?>" >
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="password" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="address" value="<?php echo $administrator->address; ?>" >
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded">
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="" disabled selected><?php echo $administrator->gender; ?></option>
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
                                            <option value="" disabled selected><?php echo $administrator->country ?></option>
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
                                        <input type="email" class="form-control pl-3" name="email" value="<?php echo $administrator->email; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control pl-3" name="phone" value="<?php echo $administrator->phone; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="rounded-0">
                                        <input type="text" class="form-control pl-3" name="province" value="<?php echo $administrator->province; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control pl-3" name="city" value="<?php echo $administrator->city; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="float-lg-left">
                             <?php if($_SESSION['role_id']=="5"): ?>
                            <div class="">
                                <?php if($administrator->status=="1"):?>
                                <a href="<?php route('/employee/r/'.$administrator->id) ?>" class="btn btn-danger login-btn btn-block rounded-0">BLOCK ACCOUNT</a>
                                <?php else:?>
                                    <a href="<?php route('/employee/a/'.$administrator->id) ?>" class="btn btn-info login-btn btn-block">ACTIVATE ACCOUNT</a>
                                
                                <?php endif;?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="float-lg-right">
                            <div class="">
                                <?php if($_SESSION['role_id']=="5"): ?>
                                <button type="submit" class="btn btn-success login-btn btn-block">UPDATE USER</button>
                            <?php endif; ?>
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

    
<div class="container-fluid px-xl-5 mt-lg-2">
     
        <div class="container user-list">
            <div class="row flex-lg-nowrap mb-5">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>UPDATE <?php echo strtoupper($supplier->name); ?></span><small class="px-1"></small></h6>
                            </div>

                            <div class="py-1">
                            <form action="<?php route('/supplier/u/'.$supplier->id); ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="name" value="<?php echo $supplier->name; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="email" value="<?php echo $supplier->email; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="phone" value="<?php echo $supplier->phone; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="city" value="<?php echo $supplier->city; ?>">
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3" name="address" value="<?php echo $supplier->address; ?>">
                                    </div>
                                </div>

                                
                                
                                <div class="float-lg-right">
                                    <div class="">
                                        <button type="submit" class="btn btn-success login-btn btn-block">Update</button>
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

    
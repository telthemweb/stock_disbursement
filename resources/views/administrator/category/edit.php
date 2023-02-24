<div class="container-fluid px-xl-5 mt-lg-5">
     
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>UPDATE <?php echo strtoupper($category->name); ?></span><small class="px-1"></small></h6>
                            </div>

                            <div class="py-1">
                            <form action="<?php route('/category/u/'.$category->id); ?>" method="POST">
                                <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                                    <div class="form-group">
                                        <div class="rounded">
                                            <input type="text" class="form-control pl-3" name="name" placeholder="Category Name" value="<?php echo $category->name; ?>">
                                            </div>
                                    </div>
                                
                                    <div class="float-lg-right">
                                        <div class="">
                                            <button type="submit" class="btn btn-primary login-btn btn-block">Update</button>
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

    
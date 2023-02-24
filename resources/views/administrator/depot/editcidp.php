<div class="container-fluid px-xl-5 mt-lg-5">
     
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>UPDATE <?php echo strtoupper($depotcidp->name); ?></span><small class="px-1"></small></h6>
                            </div>

                            <div class="py-1">
                            <form action="<?php route('/cidp/u/'.$depotcidp->id); ?>" method="POST">
                            <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                                <div class="form-group">
                                    <div class="rounded">
                                        <input type="text" class="form-control pl-3 rounded-0" name="name" value="<?php echo
                                        $depotcidp->name ?>">
                                        <input type="hidden" class="form-control pl-3 rounded-0" name="depot_id" value="<?php echo
                                        $depotcidp->depot_id ?>">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <div class="rounded">
                                      <select class="form-control" name="administrator_id" id="administrator_id">
                                            <option value="" disabled selected><?php echo
                                        $depotcidp->administrator->name.' '.$depotcidp->administrator->surname; ?></option>
                                             <?php foreach ($administrators as $sup): ?>
                                                    <option value="<?php echo $sup->id ?>"><?php echo $sup->name .' '.$sup->surname ?></option>
                                                <?php endforeach ?>
                                     </select>
                                    </div>
                                </div>
                               
                                <div class="float-lg-right">
                                    <div class="">
                                        <button type="submit" class="btn btn-success rounded-0 login-btn btn-block">Update</button>
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

    
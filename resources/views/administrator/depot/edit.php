<div class="container-fluid px-xl-5 mt-lg-5">
     
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>UPDATE <?php echo strtoupper($depot->name); ?></span><small class="px-1"></small></h6>
                            </div>

                            <div class="py-1">
                            <form action="<?php route('/depot/u/'.$depot->id); ?>" method="POST">
                                <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                                    <div class="form-group">
                                        <div class="rounded">
                                            <input type="text" class="form-control pl-3" name="name" placeholder="Category Name" value="<?php echo $depot->name; ?>">
                                            </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="rounded">
                                        <label class="float-right badge badge-success"><?php echo $depot->province; ?></label>
                                        <select class="form-control" id="province"  name="province" value="<?php echo $depot->province; ?>"></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="rounded">
                                        <label class="float-right badge badge-success"><?php echo $depot->district; ?></label>
                                        <select class="form-control" id="city"  name="district" value="<?php echo $depot->district; ?>"></select>
                                    </div>
                                </div>
                                 <div class="form-group">
                            <div class="rounded">
                              <select class="form-control" name="administrator_id" id="administrator_id">
                                    <option value="" disabled selected><?php echo
                                        $depot->administrator->name.' '.$depot->administrator->surname; ?></option>
                                     <?php foreach ($administrators as $sup): ?>
                                            <option value="<?php echo $sup->id ?>"><?php echo $sup->name .' '.$sup->surname ?></option>
                                        <?php endforeach ?>
                             </select>
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

    
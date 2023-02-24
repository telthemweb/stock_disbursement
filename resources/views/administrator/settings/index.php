 <div class="container-fluid px-xl-5 mt-lg-5">
        <button class="btn btn-success float-right rounded-0"  data-toggle="modal" data-target="#user-form-modal">
            New Setting <i class="fa fa-cog"></i>
        </button>
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>GENERAL SETTINGS</span><small class="px-1"></small></h6>
                            </div>
                            <div class="e-table">
                                <div class="table-responsive table-lg mt-3">
                                    <table class="table table-bordered" id="myTable">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="max-width">Site logo</th>
                                            <th class="max-width">Site title</th>
                                            <th class="max-width">Develped by</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody id="role">
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($settings as $setting): $i++; ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i ?></td>
                                       <td><img src="<?php echo url($setting->site_logo); ?>" width="56" class="rounded-0"></td>
                                                <td><?php echo $setting->site_title; ?></td>
                                                <td><?php echo $setting->developed_by; ?></td>
                                                <td class="text-center">
                                                <a class="text-success"  href="<?php route('/setting/e/'.$setting->id); ?>" >
                                                        <i class="fa fa-edit mr-3 text-green"></i>
                                                    </a> 
                                                    <?php if($_SESSION['role_id']==5):?>
                                                    <a class="text-danger" href="<?php route('/setting/delete/'. $setting->id); ?>" ><i class="fa fa-trash mr-3 text-danger"></i> </a>
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
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">CREATE SETTING</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <form action="<?php route('/setting/add'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                        <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="site_title" placeholder="Site Title"
                                       required="required" id="site_title">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="developed_by" placeholder="Developer"
                                       required="required" id="developed_by">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="rounded">
                                  <select class="form-control" name="currency" id="currency">
                                    <option value="" disabled selected>Select currency</option>
                                    <option value="ZWD">Zimbabwe Dollar</option>
                                    <option value="USD">United States Dollar</option>
                                    <option value="ZAR">Rand</option>
                                    <option value="PULA">Botswana Pula</option>
                                    <option value="KWACHA">Zambian Kwacha</option>
                                  </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="rounded">
                                  <select class="form-control" name="currency_position" id="currency_position">
                                    <option value="" disabled selected>Select Position</option>
                                    <option value="L">Left</option>
                                    <option value="R">Right</option>
                                  </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="rounded">
                                 <label for="">Site Logo <b>[png|jpg]</b></label>
                                <input type="file" class="form-control pl-3" name="site_logo" placeholder="Site logo" id="site_logo">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="rounded">
                                 <label for="">Site Favicon <b>[png|jpg]</b></label>
                                <input type="file" class="form-control pl-3" name="favicon" placeholder="Site favicon" id="favicon">
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


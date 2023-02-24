<div class="container-fluid px-xl-5 mt-lg-2">
     
        <div class="container user-list">
            <div class="row flex-lg-nowrap">
                <div class="col-lg-12">
                    <div id="switchPoint" class="e-panel card">
                        <div class="card-body">
                            <div class="card-title">
                                <h6 class="mr-2"><span>UPDATE <?php echo strtoupper($setting->site_title); ?></span><small class="px-1"></small></h6>
                            </div>

                            <div class="py-1">
                            <form action="<?php route('/setting/u/'.$setting->id); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                        <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="site_title" value="<?php echo $setting->site_title; ?>" id="site_title">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="rounded">
                                <input type="text" class="form-control pl-3" name="developed_by" value="<?php echo $setting->developed_by; ?>"  id="developed_by">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="rounded">
                                  <select class="form-control" name="currency" id="currency">
                                    <option value="" disabled selected><?php echo $setting->currency; ?></option>
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
                                    <option value="<?php echo $setting->currency_position; ?>" disabled selected><?php echo $setting->currency_position=="L"?"Left":"Right"; ?></option>
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
        </div>
    </div>

    
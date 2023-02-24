
<div class="login-form">
    <div class="row">
        <div class="col-md-12">
            <form action="<?php route('/admin-auth/auth'); ?>" method="POST">
            <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                <div class="alert alert-danger" role="alert" id="alert" style="display: none;"></div>
                <h4 class="text-center text-white">Sign-in to your account</h4>
                <p class="spacing-agent"> </p>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <span class="fa fa-user"></span>
                                </span>
                        </div>
                        <input type="text" class="form-control" name="username" placeholder="Employee Code" required="required" id="email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="Password" required="required" id="password">
                        <div class="input-group-append">
                                <span class="input-group-text">
                                    <a onclick="showPass()" class="btn border-0">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </span>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center justify-content-center">
                    <button type="submit" class="btn btn-info login-btn btn-block text-white">Sign in</button>
                </div>
                <p class="spacing-agent"> </p>
                <div class="clearfix">
                    <label class="float-left form-check-label text-white"><input type="checkbox"> Remember me</label>
                    <a href="#" class="float-right text-white">Forgot Password?</a>
                </div>
            </form>

        </div>
    </div>
</div>






<div class="login-content">
    <!-- Login -->
    <div class="lc-block toggled" id="l-login">
        <div class="lcb-form">
            <form method="post" action="/Authorization/login/">
                <div class="input-group m-b-20">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <div class="fg-line">
                        <input type="text" name="username" required class="form-control" placeholder="Username">
                    </div>
                </div>

                <div class="input-group m-b-20">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <div class="fg-line">
                        <input type="password" name="password" required class="form-control" placeholder="Password">
                    </div>
                </div>

                <button type="submit" class="btn btn-login btn-secondair btn-float"><i class="zmdi zmdi-arrow-forward"></i></button>
            </form>

            <?= $this->Flash->render() ?>
        </div>

        <div class="lcb-navigation">
            <a href="#" data-ma-action="login-switch" data-ma-block="#l-forget-password"><i>?</i> <span>Forgot Password</span></a>
        </div>
    </div>

    <!-- Forgot Password -->
    <div class="lc-block" id="l-forget-password">
        <div class="lcb-form">
            <form method="post" action="/Authorization/resetpassword/">
                <p class="text-left">
                    If you've forgotten your password you can reset it here by filling out your username or emailaddress
                </p>

                <div class="input-group m-b-20">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <div class="fg-line">
                        <input type="text" class="form-control" name="inputMixed" placeholder="Username or emailaddress">
                    </div>
                </div>

                <button type="submit" class="btn btn-login btn-warning btn-float"><i class="zmdi zmdi-check"></i></button>
            </form>
        </div>

        <div class="lcb-navigation">
            <a href="#" data-ma-action="login-switch" data-ma-block="#l-login"><i class="zmdi zmdi-long-arrow-right"></i> <span>Sign in</span></a>
        </div>
    </div>
</div>
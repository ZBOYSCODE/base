
<div class="login-box" >

    <div class="logo-login">


    </div>

    <div class="login-background-container">

        {{ image("pic/avatars/default.png", "class":"hidden", "id":"wide-img") }}

    </div>

    <div class="login-card-container">
        <div class="login-card">

            <div class="login-card-header">
                {{ image("", "class":"hidden", "id":"wide-card-img") }}
            </div>

            <div class="inside-content">
               
                {{ image("pic/avatars/default.png","class":"profile-img-card ", "id":"profile-img-default") }}
                <p id="profile-name" class="profile-name-card"></p>

                <form id='frm-login' class="form-signin"  data-base-url="{{ url('') }}" action="<?php echo $this->url->get('Session'); ?>">

                     <input type="hidden" id='token' name="<?php echo $this->security->getTokenKey() ?>" value="<?php echo $this->security->getToken() ?>"/>

                    <span id="reauth-email" class="reauth-email"></span>
                    <input type="text" id="username" name="email" class="form-control" placeholder="Usuario" required autofocus>
                    <p class="email-error error"></p>
                    <input type="password" id="inputPassword" name='password' class="form-control" placeholder="Contraseña" required data-url="<?php echo $this->url->get("Session/getavatar"); ?>">
                    <p class="password-error error"></p>
                    <div id="remember" class="checkbox">
                        <label>
                            <input type="checkbox" value="true" name='remember'> Recordarme
                        </label>
                    </div>

                    <button class="btn btn-lg btn-block btn-signin" id='btn-login'>Iniciar Sesión</button>
                </form><!-- /form -->


                <a href="#" class="forgot-password">
                    Olvidé mi contraseña
                </a>
            </div>


        </div><!-- /card-container -->
    </div>

</div>


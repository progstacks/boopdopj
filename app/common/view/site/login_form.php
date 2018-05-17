        <form class="form-signin">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
        <span>This form is using the template file <i><?php app\base\App::getBasePath(); ?>'app\common\view\site\login_form.php</i></span>.
        You can freely replace what is displayed in this section by modifying the <i><?php app\base\App::getBasePath(); ?>'app\common\controller\SiteController.php</i>

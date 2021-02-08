<? if (isset($_SESSION['error']) && $_SESSION['error'] != ''): ?>
<p style="color: firebrick"><?=$_SESSION['error']?></p>
<? unset($_SESSION['error']); ?>
<? endif; ?>
<form action="" method="post">
    <div class="input-group mb-3">
        <input type="text" name="login" class="form-control" placeholder="Логин">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="Пароль">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="icheck-primary">
                <input type="checkbox" name="remember" value="1" id="remember">
                <label for="remember">
                    Запомнить меня
                </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Войти</button>
        </div>
        <!-- /.col -->
    </div>
</form>
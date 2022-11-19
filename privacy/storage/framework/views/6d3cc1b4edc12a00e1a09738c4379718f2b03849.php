<?php $__env->startSection('adminlte_css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('vendor/adminlte/plugins/iCheck/square/blue.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('vendor/adminlte/css/auth.css')); ?>">
    <link rel="icon" type="image/png" href="/gui_inventory_laravel/css/logo_gui.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/gui_inventory_laravel/css/logo_gui.png" sizes="32x32">
    <?php echo $__env->yieldContent('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body_class', 'login-page'); ?>

<?php $__env->startSection('body'); ?>
<style>
.body_class, .login-page, .content {
    background: url("invenwall.jpg");
    background-size:cover;
    overflow: hidden;
}

.login-box {
    opacity: 0.9;
}
</style>
<br>
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo e(url(config('adminlte.dashboard_url', 'home'))); ?>"><font style="color: black; text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #FC33E1, 0 0 40px #FC33E1, 0 0 50px #FC33E1, 0 0 60px #FC33E1, 0 0 70px #FC33E1;"><?php echo config('adminlte.logo', '<b>Admin</b>LTE'); ?></font></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Masukkan user name dan password anda</p>
            <form action="<?php echo e(url(config('adminlte.login_url', 'login'))); ?>" method="post">
                <?php echo csrf_field(); ?>


                <div class="form-group has-feedback <?php echo e($errors->has('username') ? 'has-error' : ''); ?>">
                    <select id="tujuan" name="kode_company" style="width: 100%">
                        <?php
                          foreach($Company as $item){
                        ?>
                          <option value="<?php echo $item->kode_company; ?>">
                              <?php echo $item->nama_company; ?>
                          </option>
                        <?php
                          }
                        ?>
                    </select>
                </div>
                <div class="form-group has-feedback <?php echo e($errors->has('username') ? 'has-error' : ''); ?>">
                    <input type="text" name="username" class="form-control" value="<?php echo e(old('username')); ?>" placeholder="Username">
                    <span class="glyphicon glyphicon-globe form-control-feedback"></span>
                    <?php if($errors->has('username')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('username')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group has-feedback <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">
                    <input type="password" name="password" class="form-control"
                           placeholder="<?php echo e(trans('adminlte::adminlte.password')); ?>">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <!--<div class="checkbox icheck">-->
                        <!--    <label>-->
                        <!--        <input type="checkbox" name="remember"> <?php echo e(trans('adminlte::adminlte.remember_me')); ?>-->
                        <!--    </label>-->
                        <!--</div>-->
                        <!--The current Laravel version is <?php echo e(app()->version()); ?>-->
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit"
                                class="btn btn-primary btn-block btn-flat"><?php echo e(trans('adminlte::adminlte.sign_in')); ?></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!-- <div class="auth-links">
                <a href="<?php echo e(url(config('adminlte.password_reset_url', 'password/reset'))); ?>"
                   class="text-center"
                ><?php echo e(trans('adminlte::adminlte.i_forgot_my_password')); ?></a>
                <br>
                <?php if(config('adminlte.register_url', 'register')): ?>
                    <a href="<?php echo e(url(config('adminlte.register_url', 'register'))); ?>"
                       class="text-center"
                    ><?php echo e(trans('adminlte::adminlte.register_a_new_membership')); ?></a>
                <?php endif; ?>
            </div> -->
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('adminlte_js'); ?>
    <script src="<?php echo e(asset('vendor/adminlte/plugins/iCheck/icheck.min.js')); ?>"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    <?php echo $__env->yieldContent('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
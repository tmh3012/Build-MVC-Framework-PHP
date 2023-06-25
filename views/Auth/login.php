<?php /**
 * @var $model \app\models\LoginForm
 */
use app\core\Application;
?>

<div class="main-container">
    <div class="background">
        <div class="background-image"
             style="background-image: url('https://down-vn.img.susercontent.com/file/sg-11134004-7qvd5-lfuyd509f57p08')">
            <div class="auth-content">
                <?php if(Application::$app->session->getFlash('auth_error')): ?>
                    <div class="error-message">
                        <span><?php echo Application::$app->session->getFlash('auth_error') ?></span>
                    </div>
                <?php endif; ?>
                <?php $form = \app\core\form\Form::begin('form-auth', 'form-auth', '', 'POST') ?>
                <div class="form-head">
                    <h2 class="form-title">Login</h2>
                </div>
                <div class="form-body">
                    <?php echo $form->input($model,'email', 'Your email address')->typeEmail() ?>
                    <?php echo $form->input($model,'password','Enter your password')->typePassword() ?>
                    <?php echo $form->button('submit','','btn--primary','Login')?>
                </div>
                <div class="form-footer">
                    <p class="description">You don't have an account ?<a href="/register"> Register here</a> </p>
                </div>
                <?php echo \app\core\form\Form::end() ?>
            </div>
        </div>
    </div>
</div>
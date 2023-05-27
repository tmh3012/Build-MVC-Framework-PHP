<div class="main-container">
    <div class="background">
        <div class="background-image"
             style="background-image: url('https://down-vn.img.susercontent.com/file/sg-11134004-7qvd5-lfuyd509f57p08')">


            <?php $form = \app\core\form\Form::begin('form-auth', 'form-auth', '', 'POST') ?>
            <div class="form-head">
                <h2 class="form-title">Register now</h2>
            </div>
            <div class="form-body">
                <?php echo $form->field($model, 'Full name','name','Your full name') ?>
                <?php echo $form->field($model, 'Email','email', 'Your email address')->type('email') ?>
                <?php echo $form->field($model, 'Password','password','Enter your password')->type('password') ?>
                <?php echo $form->field($model, 'Password confirm','passwordConfirm', 'Confirm password')->type('password') ?>
                <div class="form-group">
                    <button class="btn btn--primary">Register</button>
                </div>
            </div>
            <div class="form-footer">
                <p class="description">Do you already have an account ?<a href="/login"> Login here</a></p>
            </div>
            <?php echo \app\core\form\Form::end() ?>
        </div>
    </div>
</div>
<?php $__env->startComponent('mail::message'); ?>
# <?php echo e(__('Hello')); ?>, <?php echo e($user->name); ?>


<?php echo e(__('Your login detail for')); ?> <?php echo e(config('app.name')); ?> is

<table>
    <tr>
        <td><?php echo e(__('Username')); ?></td>
        <td>:</td>
        <td><?php echo e($user->email); ?></td>
    </tr>
    <tr>
        <td><?php echo e(__('Password')); ?></td>
        <td>:</td>
        <td><?php echo e($user->password); ?></td>
    </tr>
</table>

<?php $__env->startComponent('mail::button', ['url' => route('client.login')]); ?>
    <?php echo e(__('Login')); ?>

<?php echo $__env->renderComponent(); ?>

<?php echo e(__('Thanks')); ?>,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH /var/www/html/Taskly2/site2/resources/views/email/login/client_detail.blade.php ENDPATH**/ ?>
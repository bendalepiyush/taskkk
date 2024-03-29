<?php $__env->startSection('content'); ?>
    <section class="section">


    <?php if($currantWorkspace): ?>

        <div class="row mb-2">
            <div class="col-sm-4">
                <h2 class="section-title"><?php echo e(__('Clients')); ?></h2>
            </div>
            <div class="col-sm-8">
                <?php if($currantWorkspace->creater->id == Auth::user()->id): ?>
                <div class="text-sm-right">
                    <button type="button" class="btn btn-primary btn-rounded mt-4" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Add Client')); ?>" data-url="<?php echo e(route('clients.create',$currantWorkspace->slug)); ?>">
                        <i class="mdi mdi-plus"></i> <?php echo e(__('Add Client')); ?>

                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-4 animated">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown card-widgets float-right">
                            <?php if(isset($client->is_active) && !$client->is_active): ?>
                                <a href="#" title="<?php echo e(__('Locked')); ?>">
                                    <i class="mdi mdi-lock-outline"></i>
                                </a>
                            <?php endif; ?>
                            <?php if($currantWorkspace->permission == 'Owner'): ?>
                            <div class="dropdown card-widgets float-right">
                                <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown" aria-expanded="false">
                                    <i class="dripicons-gear"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Edit Client')); ?>" data-url="<?php echo e(route('clients.edit',[$currantWorkspace->slug,$client->id])); ?>"><i class="mdi mdi-pencil mr-1"></i><?php echo e(__('Edit')); ?></a>
                                    <a href="#" onclick="(confirm('Are you sure ?')?document.getElementById('delete-form-<?php echo e($client->id); ?>').submit(): '');" class="dropdown-item"><i class="mdi mdi-delete mr-1"></i><?php echo e(__('Delete')); ?></a>
                                    <form method="post" id="delete-form-<?php echo e($client->id); ?>" action="<?php echo e(route('clients.destroy',[$currantWorkspace->slug,$client->id])); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <span class="float-left mr-4">
                            <img avatar="<?php echo e($client->name); ?>" alt="" class="rounded-circle img-thumbnail">
                        </span>
                        <div class="media-body mt-2">
                            <h6 class="font-weight-bold"><?php echo e($client->name); ?></h6>
                            <p class="mb-0"><?php echo e($client->email); ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="container mt-5">
            <div class="page-error">
                <div class="page-inner">
                    <h1>404</h1>
                    <div class="page-description">
                        <?php echo e(__('Page Not Found')); ?>

                    </div>
                    <div class="page-search">
                        <p class="text-muted mt-3"><?php echo e(__('It\'s looking like you may have taken a wrong turn. Don\'t worry... it happens to the best of us. Here\'s a little tip that might help you get back on track.')); ?></p>
                        <div class="mt-3">
                            <a class="btn btn-info mt-3" href="<?php echo e(route('home')); ?>"><i class="mdi mdi-reply"></i> <?php echo e(__('Return Home')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    </section>
<!-- container -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/taskly/saas/site/resources/views/clients/index.blade.php ENDPATH**/ ?>
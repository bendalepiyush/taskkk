<?php $__env->startSection('content'); ?>
    <section class="section">
        <?php if($project && $currantWorkspace): ?>

            <?php if(auth()->guard('client')->check()): ?>
                <?php
                $permisions = Auth::user()->getPermission($project->id);
                ?>
            <?php endif; ?>

            <div class="row mb-2">
                <div class="col-sm-4">
                    <h2 class="section-title"><?php echo e(__('Project Detail')); ?></h2>
                </div>
                <div class="col-sm-8">
                    <div class="text-sm-right">
                        <div class="mt-4">

                            <?php if(auth()->guard('client')->check()): ?>
                                <?php if(isset($permisions) && in_array('show task',$permisions)): ?>
                                    <a href="<?php echo e(route('client.projects.task.board',[$currantWorkspace->slug,$project->id])); ?>" class="btn btn-primary"><?php echo e(__('Task Board')); ?></a>
                                <?php endif; ?>
                            <?php elseif(auth()->guard()->check()): ?>
                                <a href="<?php echo e(route('projects.task.board',[$currantWorkspace->slug,$project->id])); ?>" class="btn btn-primary"><?php echo e(__('Task Board')); ?></a>
                            <?php endif; ?>
                            <?php if(auth()->guard('client')->check()): ?>
                                <?php if(isset($permisions) && in_array('show timesheet',$permisions)): ?>
                                    <a href="<?php echo e(route('client.projects.timesheet',[$currantWorkspace->slug,$project->id])); ?>" class="btn btn-primary"><?php echo e(__('Timesheet')); ?></a>
                                <?php endif; ?>
                            <?php elseif(auth()->guard()->check()): ?>
                                <a href="<?php echo e(route('projects.timesheet',[$currantWorkspace->slug,$project->id])); ?>" class="btn btn-primary"><?php echo e(__('Timesheet')); ?></a>
                            <?php endif; ?>
                            <?php if(auth()->guard('client')->check()): ?>
                                <?php if(isset($permisions) && in_array('show bug report',$permisions)): ?>
                                    <a href="<?php echo e(route('client.projects.bug.report',[$currantWorkspace->slug,$project->id])); ?>" class="btn btn-primary"><?php echo e(__('Bug Report')); ?></a>
                                <?php endif; ?>
                            <?php elseif(auth()->guard()->check()): ?>
                                <a href="<?php echo e(route('projects.bug.report',[$currantWorkspace->slug,$project->id])); ?>" class="btn btn-primary"><?php echo e(__('Bug Report')); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 animated">
                    <!-- project card -->
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="card-header-action">
                                <div class="dropdown card-widgets">
                                    <?php if(!$project->is_active): ?>
                                        <a href="#" class="btn" title="<?php echo e(__('Locked')); ?>">
                                            <i class="mdi mdi-lock-outline"></i>
                                        </a>
                                    <?php else: ?>
                                        <?php if(auth()->guard('web')->check()): ?>
                                        <a href="#" class="btn active dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="dripicons-gear"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if($currantWorkspace->permission == 'Owner'): ?>
                                                <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Edit Project')); ?>" data-url="<?php echo e(route('projects.edit',[$currantWorkspace->slug,$project->id])); ?>"><i class="mdi mdi-pencil mr-1"></i><?php echo e(__('Edit')); ?></a>
                                                <a href="#" onclick="(confirm('Are you sure ?')?document.getElementById('delete-form-<?php echo e($project->id); ?>').submit(): '');" class="dropdown-item"><i class="mdi mdi-delete mr-1"></i><?php echo e(__('Delete')); ?></a>
                                                <form id="delete-form-<?php echo e($project->id); ?>" action="<?php echo e(route('projects.destroy',[$currantWorkspace->slug,$project->id])); ?>" method="POST" style="display: none;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                </form>
                                            <?php else: ?>
                                                <a href="#" onclick="(confirm('Are you sure ?')?document.getElementById('leave-form-<?php echo e($project->id); ?>').submit(): '');" class="dropdown-item"><i class="mdi mdi-exit-to-app mr-1"></i><?php echo e(__('Leave')); ?></a>
                                                <form id="leave-form-<?php echo e($project->id); ?>" action="<?php echo e(route('projects.leave',[$currantWorkspace->slug,$project->id])); ?>" method="POST" style="display: none;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- project title-->
                            <div class="author-box-name">
                                <?php echo e($project->name); ?>

                            </div>
                            <div class="author-box-job">
                                <?php if($project->status == 'Finished'): ?>
                                    <div class="badge badge-success"><?php echo e(__('Finished')); ?></div>
                                <?php elseif($project->status == 'Ongoing'): ?>
                                    <div class="badge badge-secondary"><?php echo e(__('Ongoing')); ?></div>
                                <?php else: ?>
                                    <div class="badge badge-warning"><?php echo e(__('OnHold')); ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mt-4 font-weight-bold"><?php echo e(__('Project Overview')); ?>:</div>

                            <div class="author-box-description">
                                <?php echo e($project->description); ?>

                            </div>

                            <div class="row mt-3">
                                <?php if($project->start_date): ?>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <div class="font-weight-bold"><?php echo e(__('Start Date')); ?></div>
                                            <p> <?php echo e(date('d M Y',strtotime($project->start_date))); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($project->end_date): ?>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <div class="font-weight-bold"><?php echo e(__('End Date')); ?></div>
                                            <p> <?php echo e(date('d M Y',strtotime($project->end_date))); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <div class="font-weight-bold"><?php echo e(__('Budget')); ?></div>
                                        <p>$<?php echo e(number_format($project->budget)); ?></p>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end card-body-->

                    </div> <!-- end card-->

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="card card-statistic-2">
                                <div class="card-icon shadow-primary bg-primary">
                                    <i class="fas mdi mdi-clock-outline"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo e(__('Days left')); ?></h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                            $datetime1 = new DateTime($project->end_date);
                                            $datetime2 = new DateTime(date('Y-m-d'));
                                            $interval = $datetime1->diff($datetime2);
                                            $days = $interval->format('%a')
                                        ?>
                                        <?php echo e($days); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="card card-statistic-2">
                                <div class="card-icon shadow-danger bg-danger">
                                    <i class="fas mdi mdi-format-list-checkbox"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo e(__('Total task')); ?></h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo e($project->countTask()); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="card card-statistic-2">
                                <div class="card-icon shadow-success bg-success">
                                    <i class="fas mdi mdi-message-outline"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4><?php echo e(__('Comments')); ?></h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo e($project->countTaskComments()); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="card author-box card-primary">
                                <div class="card-header">
                                    <h4><?php echo e(__('Team Members')); ?> (<?php echo e(count($project->users)); ?>)</h4>
                                    <div class="card-header-action">
                                        <?php if($currantWorkspace->permission == 'Owner'): ?>
                                            <div class="dropdown card-widgets">
                                                <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="<?php echo e(__('Invite')); ?>" data-url="<?php echo e(route('projects.invite.popup',[$currantWorkspace->slug,$project->id])); ?>"><i class="mdi mdi-email-outline mr-1"></i><?php echo e(__('Invite')); ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="card-body pr-2 pl-3">

                                        <ul class="list-unstyled list-unstyled-border top-5-scroll pr-1">
                                            <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="media">
                                                    <img class="mr-3 rounded-circle" width="50" <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/avatars/'.$user->avatar)); ?>" <?php else: ?> avatar="<?php echo e($user->name); ?>" <?php endif; ?> alt="avatar">
                                                    <div class="media-body">
                                                        <?php if($currantWorkspace->permission == 'Owner' && $user->id != Auth::user()->id): ?>
                                                            <a href="#" class="btn btn-sm btn-outline-danger float-right" onclick="(confirm('Are you sure ?')?document.getElementById('delete-user-<?php echo e($user->id); ?>').submit(): '');"><i class="mdi mdi-delete"></i></a>
                                                            <form id="delete-user-<?php echo e($user->id); ?>" action="<?php echo e(route('projects.user.delete',[$currantWorkspace->slug,$project->id,$user->id])); ?>" method="POST" style="display: none;">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                            </form>
                                                        <?php endif; ?>
                                                        <h6 class="media-title"><a href="#"><?php echo e($user->name); ?></a></h6>
                                                        <div class="text-small text-muted">
                                                            <?php echo e($user->email); ?>

                                                            <div class="bullet"></div>
                                                            <span class="text-primary"><?php echo e(count($project->user_done_tasks($user->id))); ?> / <?php echo e(count($project->user_tasks($user->id))); ?></span>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                </div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card author-box card-primary">
                                <div class="card-header">
                                    <h4><?php echo e(__('Clients')); ?> (<?php echo e(count($project->clients)); ?>)</h4>
                                    <div class="card-header-action">
                                        <?php if($currantWorkspace->permission == 'Owner'): ?>
                                            <div class="dropdown card-widgets">
                                                <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="<?php echo e(__('Share to Clients')); ?>" data-url="<?php echo e(route('projects.share.popup',[$currantWorkspace->slug,$project->id])); ?>"><i class="mdi mdi-email-outline mr-1"></i><?php echo e(__('Share')); ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="card-body pr-2 pl-3">

                                    <ul class="list-unstyled list-unstyled-border top-5-scroll pr-1">
                                        <?php $__currentLoopData = $project->clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="media">
                                                <img class="mr-3 rounded-circle" width="50" <?php if($client->avatar): ?> src="<?php echo e(asset('/storage/avatars/'.$client->avatar)); ?>" <?php else: ?> avatar="<?php echo e($client->name); ?>" <?php endif; ?> alt="avatar">
                                                <div class="media-body">
                                                    <?php if($currantWorkspace->permission == 'Owner'): ?>
                                                        <a href="#" class="btn btn-sm btn-outline-danger float-right" onclick="(confirm('Are you sure ?')?document.getElementById('delete-client-<?php echo e($client->id); ?>').submit(): '');"><i class="mdi mdi-delete"></i></a>
                                                        <a href="#" class="btn btn-sm btn-outline-primary float-right mr-1" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Edit Permission')); ?>" data-url="<?php echo e(route('projects.client.permission',[$currantWorkspace->slug,$project->id,$client->id])); ?>"><i class="mdi mdi-lock"></i></a>
                                                        <form id="delete-client-<?php echo e($client->id); ?>" action="<?php echo e(route('projects.client.delete',[$currantWorkspace->slug,$project->id,$client->id])); ?>" method="POST" style="display: none;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                        </form>
                                                    <?php endif; ?>
                                                    <h6 class="media-title"><a href="#"><?php echo e($client->name); ?></a></h6>
                                                    <div class="text-small text-muted">
                                                        <?php echo e($client->email); ?>

                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php if((isset($permisions) && in_array('show milestone',$permisions)) || $currantWorkspace->permission == 'Owner'): ?>
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="card-header-action">
                                <div class="dropdown card-widgets">
                                    <?php if((isset($permisions) && in_array('create milestone',$permisions)) || $currantWorkspace->permission == 'Owner'): ?>
                                        <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="<?php echo e(__('Create Milestone')); ?>" data-url="<?php if(auth()->guard('web')->check()): ?><?php echo e(route('projects.milestone',[$currantWorkspace->slug,$project->id])); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.projects.milestone',[$currantWorkspace->slug,$project->id])); ?><?php endif; ?>"><?php echo e(__('Create Milestone')); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- project title-->
                            <div class="author-box-name mb-4">
                                <?php echo e(__('Milestones')); ?> (<?php echo e(count($project->milestones)); ?>)
                            </div>

                            <?php $__currentLoopData = $project->milestones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="ribbon-wrapper  bg-white b-all mb-4 milestones">
                                    <div class="ribbon ribbon-corner"><span class="milestone-count">#<?php echo e($key+1); ?></span></div>
                                    <div class="ribbon-content">
                                        <h5 class="media-heading text-info font-light">
                                            <a href="#" class="milestone-detail" data-ajax-popup="true" data-title="<?php echo e(__('Milestones Details')); ?>" data-url="<?php if(auth()->guard('web')->check()): ?><?php echo e(route('projects.milestone.show',[$currantWorkspace->slug,$milestone->id])); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.projects.milestone.show',[$currantWorkspace->slug,$milestone->id])); ?><?php endif; ?>"><?php echo e($milestone->title); ?></a>
                                            <?php if($currantWorkspace->permission == 'Owner'): ?>
                                                <div class="float-right">
                                                    <small>
                                                        <a href="#" class="btn btn-sm btn-outline-primary" data-ajax-popup="true" data-title="<?php echo e(__('Edit Milestone')); ?>" data-url="<?php echo e(route('projects.milestone.edit',[$currantWorkspace->slug,$milestone->id])); ?>"><i class="mdi mdi-pencil"></i></a>
                                                        <a href="#" class="btn btn-sm btn-outline-danger" onclick="(confirm('Are you sure ?')?document.getElementById('delete-form1-<?php echo e($milestone->id); ?>').submit(): '');"><i class="mdi mdi-delete"></i></a>
                                                        <form id="delete-form1-<?php echo e($milestone->id); ?>" action="<?php echo e(route('projects.milestone.destroy',[$currantWorkspace->slug,$milestone->id])); ?>" method="POST" style="display: none;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                        </form>
                                                    </small>
                                                </div>
                                            <?php elseif(isset($permisions)): ?>
                                            <div class="float-right">
                                                <small>
                                                    <?php if(in_array('edit milestone',$permisions)): ?>
                                                        <a href="#" class="btn btn-sm btn-outline-primary" data-ajax-popup="true" data-title="<?php echo e(__('Edit Milestone')); ?>" data-url="<?php echo e(route('client.projects.milestone.edit',[$currantWorkspace->slug,$milestone->id])); ?>"><i class="mdi mdi-pencil"></i></a>
                                                    <?php endif; ?>
                                                    <?php if(in_array('delete milestone',$permisions)): ?>
                                                        <a href="#" class="btn btn-sm btn-outline-danger" onclick="(confirm('Are you sure ?')?document.getElementById('delete-form1-<?php echo e($milestone->id); ?>').submit(): '');"><i class="mdi mdi-delete"></i></a>
                                                        <form id="delete-form1-<?php echo e($milestone->id); ?>" action="<?php echo e(route('client.projects.milestone.destroy',[$currantWorkspace->slug,$milestone->id])); ?>" method="POST" style="display: none;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                        </form>
                                                    <?php endif; ?>
                                                </small>
                                            </div>
                                            <?php endif; ?>
                                        </h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <?php if($milestone->status == 'incomplete'): ?>
                                                    <label class="badge badge-warning"><?php echo e(__('Incomplete')); ?></label>
                                                <?php endif; ?>
                                                <?php if($milestone->status == 'complete'): ?>
                                                    <label class="badge badge-success"><?php echo e(__('Complete')); ?></label>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-6 text-right">
                                                <strong><?php echo e(__('Milestone Cost')); ?>:</strong> $<?php echo e(number_format($milestone->cost)); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div> <!-- end card-body-->

                    </div> <!-- end card-->
                    <?php endif; ?>
                    <?php if((isset($permisions) && in_array('show uploading',$permisions)) || $currantWorkspace->permission == 'Owner'): ?>
                        <div class="card author-box card-primary">
                            <div class="card-body">
                                <div class="author-box-name mb-4">
                                    <?php echo e(__('Files')); ?>

                                </div>
                                <div class="col-md-12 dropzone" id="dropzonewidget"></div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- end card-->
                </div> <!-- end col -->

                <div class="col-md-4 animated">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4><?php echo e(__('Progress')); ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="mt-3 chartjs-chart" style="height: 320px;">
                                <canvas id="line-chart-example"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- end card-->
                    <?php if((isset($permisions) && in_array('show activity',$permisions)) || $currantWorkspace->permission == 'Owner'): ?>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4><?php echo e(__('Activity')); ?></h4>
                        </div>
                        <div class="card-body pr-2 pl-3">
                            <div class="activities top-10-scroll">
                                <?php $__currentLoopData = $project->activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="activity">
                                        <?php if($activity->log_type == 'Move'): ?>
                                            <div class="activity-icon bg-primary text-white shadow-primary">
                                                <i class="mdi mdi-cursor-move"></i>
                                            </div>
                                        <?php elseif($activity->log_type == 'Create Milestone'): ?>
                                            <div class="activity-icon bg-primary text-white shadow-primary">
                                                <i class="mdi mdi-target"></i>
                                            </div>
                                        <?php elseif($activity->log_type == 'Create Task'): ?>
                                            <div class="activity-icon bg-primary text-white shadow-primary">
                                                <i class="mdi mdi-format-list-checks"></i>
                                            </div>
                                        <?php elseif($activity->log_type == 'Invite User'): ?>
                                            <div class="activity-icon bg-primary text-white shadow-primary">
                                                <i class="mdi mdi-plus"></i>
                                            </div>
                                        <?php elseif($activity->log_type == 'Share with Client'): ?>
                                            <div class="activity-icon bg-primary text-white shadow-primary">
                                                <i class="mdi mdi-plus"></i>
                                            </div>
                                        <?php elseif($activity->log_type == 'Upload File'): ?>
                                            <div class="activity-icon bg-primary text-white shadow-primary">
                                                <i class="mdi mdi-file"></i>
                                            </div>
                                        <?php elseif($activity->log_type == 'Create Timesheet'): ?>
                                            <div class="activity-icon bg-primary text-white shadow-primary">
                                                <i class="mdi mdi-clock"></i>
                                            </div>
                                        <?php elseif($activity->log_type == 'Create Bug'): ?>
                                            <div class="activity-icon bg-primary text-white shadow-primary">
                                                <i class="mdi mdi-bug"></i>
                                            </div>
                                        <?php elseif($activity->log_type == 'Move Bug'): ?>
                                            <div class="activity-icon bg-primary text-white shadow-primary">
                                                <i class="mdi mdi-cursor-move"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="activity-detail">
                                            <div class="mb-2">
                                                <span class="text-job"><?php echo e($activity->created_at->diffForHumans()); ?></span>
                                            </div>
                                            <p><?php echo $activity->remark; ?></p>
                                        </div>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/dropzone.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
    <!-- third party js -->
    <script src="<?php echo e(asset('assets/js/vendor/Chart.bundle.min.js')); ?>"></script>
    <script>

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };

        (function (global) {
            var MONTHS = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ];

            var COLORS = [
                '#4dc9f6',
                '#f67019',
                '#f53794',
                '#537bc4',
                '#acc236',
                '#166a8f',
                '#00a950',
                '#58595b',
                '#8549ba'
            ];

            var Samples = global.Samples || (global.Samples = {});
            var Color = global.Color;

            Samples.utils = {
                // Adapted from http://indiegamr.com/generate-repeatable-random-numbers-in-js/
                srand: function (seed) {
                    this._seed = seed;
                },

                rand: function (min, max) {
                    var seed = this._seed;
                    min = min === undefined ? 0 : min;
                    max = max === undefined ? 1 : max;
                    this._seed = (seed * 9301 + 49297) % 233280;
                    return min + (this._seed / 233280) * (max - min);
                },

                numbers: function (config) {
                    var cfg = config || {};
                    var min = cfg.min || 0;
                    var max = cfg.max || 1;
                    var from = cfg.from || [];
                    var count = cfg.count || 8;
                    var decimals = cfg.decimals || 8;
                    var continuity = cfg.continuity || 1;
                    var dfactor = Math.pow(10, decimals) || 0;
                    var data = [];
                    var i, value;

                    for (i = 0; i < count; ++i) {
                        value = (from[i] || 0) + this.rand(min, max);
                        if (this.rand() <= continuity) {
                            data.push(Math.round(dfactor * value) / dfactor);
                        } else {
                            data.push(null);
                        }
                    }

                    return data;
                },

                labels: function (config) {
                    var cfg = config || {};
                    var min = cfg.min || 0;
                    var max = cfg.max || 100;
                    var count = cfg.count || 8;
                    var step = (max - min) / count;
                    var decimals = cfg.decimals || 8;
                    var dfactor = Math.pow(10, decimals) || 0;
                    var prefix = cfg.prefix || '';
                    var values = [];
                    var i;

                    for (i = min; i < max; i += step) {
                        values.push(prefix + Math.round(dfactor * i) / dfactor);
                    }

                    return values;
                },

                months: function (config) {
                    var cfg = config || {};
                    var count = cfg.count || 12;
                    var section = cfg.section;
                    var values = [];
                    var i, value;

                    for (i = 0; i < count; ++i) {
                        value = MONTHS[Math.ceil(i) % 12];
                        values.push(value.substring(0, section));
                    }

                    return values;
                },

                color: function (index) {
                    return COLORS[index % COLORS.length];
                },

                transparentize: function (color, opacity) {
                    var alpha = opacity === undefined ? 0.5 : 1 - opacity;
                    return Color(color).alpha(alpha).rgbString();
                }
            };

            // DEPRECATED
            window.randomScalingFactor = function () {
                return Math.round(Samples.utils.rand(-100, 100));
            };

            // INITIALIZATION

            Samples.utils.srand(Date.now());


        }(this));


        var config = {
            type: 'line',
            data: {
                labels: <?php echo json_encode($chartData['label']); ?>,
                datasets: [
                    {
                        label: "<?php echo e(__('Todo')); ?>",
                        fill: !0,
                        backgroundColor: "transparent",
                        borderColor: "#fa5c7c",
                        data: <?php echo json_encode($chartData['todo']); ?>

                    },
                    {
                        label: "<?php echo e(__('In Progress')); ?>",
                        fill: !0,
                        backgroundColor: "transparent",
                        borderColor: "#727cf5",
                        data: <?php echo json_encode($chartData['progress']); ?>

                    },
                    {
                        label: "<?php echo e(__('Review')); ?>",
                        fill: !0,
                        backgroundColor: "transparent",
                        borderColor: "#0acf97",
                        borderDash: [5, 5],
                        data: <?php echo json_encode($chartData['review']); ?>

                    },
                    {
                        label: "<?php echo e(__('Done')); ?>",
                        backgroundColor: "rgba(10, 207, 151, 0.3)",
                        borderColor: "#0acf97",
                        data: <?php echo json_encode($chartData['done']); ?>

                    },
                ]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{reverse: !0, gridLines: {color: "rgba(0,0,0,0.05)"}}],
                    yAxes: [{
                        ticks: {stepSize: 10, display: !1},
                        min: 10,
                        max: 100,
                        display: !0,
                        borderDash: [5, 5],
                        gridLines: {color: "rgba(0,0,0,0)", fontColor: "#fff"}
                    }]
                },
                responsive: true,
                title: {
                    display: false,
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                legend: {
                    display: false
                }
            }
        };
        window.onload = function () {
            var ctx = document.getElementById('line-chart-example').getContext('2d');
            window.myLine = new Chart(ctx, config);
        };

    </script>
    <!-- third party js ends -->

    <script src="<?php echo e(asset('assets/js/dropzone.min.js')); ?>"></script>
    <script>
        Dropzone.autoDiscover = false;
        myDropzone = new Dropzone("#dropzonewidget", {
            maxFiles: 20,
            maxFilesize: 2,
            parallelUploads: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.txt",
            url: "<?php echo e(route('projects.file.upload',[$currantWorkspace->slug,$project->id])); ?>",
            success: function (file, response) {
                if (response.is_success) {
                    dropzoneBtn(file, response);
                } else {
                    myDropzone.removeFile(file);
                    toastr('Error', response.error, 'error');
                }
            },
            error: function (file, response) {
                myDropzone.removeFile(file);
                if (response.error) {
                    toastr('Error', response.error, 'error');
                } else {
                    toastr('Error', response, 'error');
                }
            }
        });
        myDropzone.on("sending", function (file, xhr, formData) {
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("project_id", <?php echo e($project->id); ?>);
        });

        <?php if(isset($permisions) && in_array('show uploading',$permisions)): ?>
            $(".dz-hidden-input").prop("disabled",true);
            myDropzone.removeEventListeners();
        <?php endif; ?>

        function dropzoneBtn(file, response) {

            var html = document.createElement('div');

            var download = document.createElement('a');
            download.setAttribute('href', response.download);
            download.setAttribute('class', "btn btn btn-outline-primary btn-sm mt-1 mr-1");
            download.setAttribute('data-toggle', "tooltip");
            download.setAttribute('data-original-title', "<?php echo e(__('Download')); ?>");
            download.innerHTML = "<i class='mdi mdi-download'></i>";
            html.appendChild(download);

            <?php if(isset($permisions) && in_array('show uploading',$permisions)): ?>
            <?php else: ?>
                var del = document.createElement('a');
                del.setAttribute('href', response.delete);
                del.setAttribute('class', "btn btn-outline-danger btn-sm mt-1");
                del.setAttribute('data-toggle', "tooltip");
                del.setAttribute('data-original-title', "<?php echo e(__('Delete')); ?>");
                del.innerHTML = "<i class='mdi mdi-delete'></i>";

                del.addEventListener("click", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (confirm("Are you sure ?")) {
                        var btn = $(this);
                        $.ajax({
                            url: btn.attr('href'),
                            data: {_token: $('meta[name="csrf-token"]').attr('content')},
                            type: 'DELETE',
                            success: function (response) {
                                if (response.is_success) {
                                    btn.closest('.dz-image-preview').remove();
                                } else {
                                    toastr('Error', response.error, 'error');
                                }
                            },
                            error: function (response) {
                                response = response.responseJSON;
                                if (response.is_success) {
                                    toastr('Error', response.error, 'error');
                                } else {
                                    toastr('Error', response, 'error');
                                }
                            }
                        })
                    }
                });
                html.appendChild(del);
            <?php endif; ?>





            file.previewTemplate.appendChild(html);
        }

        <?php
            $files = $project->files;
        ?>
        <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        // Create the mock file:
        var mockFile = {name: "<?php echo e($file->file_name); ?>", size: <?php echo e(filesize(storage_path('project_files/'.$file->file_path))); ?> };
        // Call the default addedfile event handler
        myDropzone.emit("addedfile", mockFile);
        // And optionally show the thumbnail of the file:
        myDropzone.emit("thumbnail", mockFile, "<?php echo e(asset('storage/project_files/'.$file->file_path)); ?>");
        myDropzone.emit("complete", mockFile);

        dropzoneBtn(mockFile, {download: "<?php if(auth()->guard('web')->check()): ?><?php echo e(route('projects.file.download',[$currantWorkspace->slug,$project->id,$file->id])); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.projects.file.download',[$currantWorkspace->slug,$project->id,$file->id])); ?><?php endif; ?>", delete: "<?php echo e(route('projects.file.delete',[$currantWorkspace->slug,$project->id,$file->id])); ?>"});

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Taskly2/site2/resources/views/projects/show.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('custom.css')); ?>">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <?php if(Route::has('login')): ?>
                <div class="top-right links">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/home')); ?>">Home</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>">Login</a>

                        <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>">Register</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="content">
                <div class="title m-b-md">
                    File Upload
                    <!-- <div id="hello-react"></div> -->
                    <!-- <div id="counter"></div> -->
                </div>
                    <!-- <script src="<?php echo e(asset('js/app.js')); ?>"></script> -->
                <form action="<?php echo e(url('view')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="links">
                        <input type="file" name="file">
                    </div>
                    <button type="submit" class="btn btn-sm mr-2">Submit</button>
                </form>
            </div>
        </div>
    </body>
</html>
<?php /**PATH D:\shahbaz\admin-panel\resources\views/view/upload.blade.php ENDPATH**/ ?>
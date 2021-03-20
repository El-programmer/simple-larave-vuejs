
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


    </head>
    <body >
     <div id="app" class="container">
     <Myheader></Myheader>
     <router-view></router-view>
     </div>


     <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    </body>
</html>
<?php /**PATH C:\Users\Ahmed\Desktop\4\resources\views/welcome.blade.php ENDPATH**/ ?>
<html>
<head>
	<title>Report</title>
	<link rel="stylesheet" href="static/styles.css">
</head>
<body>
	<?php $__currentLoopData = $queries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<h1><?php echo e($key); ?></h1>
		<?php echo $utils->asTable($value); ?>

	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>
</html><?php /**PATH C:\laragon\www\nba2019\views/report.blade.php ENDPATH**/ ?>
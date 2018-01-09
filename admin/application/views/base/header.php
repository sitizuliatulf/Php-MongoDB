<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Super Admin Page</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php 
		if (isset($css)) {
			foreach($css as $key => $value) {
	?>
			<link rel="stylesheet" type="text/css" href="<?php echo base_url($value) ?>">
	<?php
			}
		}
	?>
</head>
<?php 
	$session_user_login = $this->session->userdata('session_user_login');
	if (is_object($session_user_login)) {
?>

		<body class="hold-transition skin-blue sidebar-mini">
<?php
	} else {
?>
		<body class="hold-transition login-page">
<?php
	}
?>
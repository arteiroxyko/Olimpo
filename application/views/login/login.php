
<div class="container">	
	<div class="login">
		<form method="post" action='<?php echo site_url('/c_login/logar') ?>' class="form-signin">
			<h2 class="form-signin-heading">Login</h2>
			<?php 
				$msg = $this->session->flashdata(0);
				if (!empty($msg)){
					echo $msg;
				}
			?>
			<div class="input-group">
			  	<span class="input-group-addon" id="basic-addon1">User </span>
			  	<input name="user" type="text" class="form-control" required="" aria-describedby="basic-addon1">
			</div>
			<br>
			<div class="input-group">
		  		<span class="input-group-addon" id="basic-addon1">Pass </span>
		  		<input name="pass" id="inputPassword" class="form-control" required="" type="password">
			</div>
			<br>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Logar</button>
		</form>
	</div>
</div>

    
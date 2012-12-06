
<div class="courtain"></div>
<div class="popup_page">
	<div class="popup_container aligncenter">


	<?php $registered_users = count(get_users()); ?>


	<div class="popup_counter">
		<h1><?php echo $registered_users;?></h1>
		<h2><?php _e('utilizadores registados','kmol');?></h2>
	</div>


	<!-- Register Stuff -->
	<div id="popup_register" class="popup_box_register register_form">

		<div class="popup_title">
			<h2><?php _e('Registe-se no','kmol');?> </h2>
			<h1><?php _e('KMOL','kmol');?></h1>
		</div>

		<div class="popup_register">
		
			<div id="LoginWithAjax_Register" style="display:block;" class="">
				<p><?php _e('Diga-nos quem é, comente e obtenha a sua página pessoal com registo das suas contribuições!','kmol');?></p>
		
				<form name="registerform" id="registerform" action="http://kmol.me/wp-login.php?action=register&callback=?&template=" method="post">
		
				<table width="99%" cellspacing="0" cellpadding="0" class="register_table">
					<tbody>
						<tr id="RegisterWithAjax_Username">
							<td class="username_label">
								<label><?php _e('Username') ?></label>
							</td>
							<td class="username_input">
								<input type="text" name="user_login" id="user_login" class="input"  />
							</td>
						</tr>
						
						<tr id="RegisterWithAjax_email">
							<td class="password_label">
								<label><?php _e('E-mail') ?></label>
							</td>
							<td class="email_input">
								<input type="text" name="user_email" id="user_email" class="input"  />
							</td>
						</tr>
						
						<tr><td colspan="2"></td></tr>
					
						<tr id="RegisterWithAjax_email">
							<td colspan="2">
								<input type="checkbox"></input>
								<label class="label_secondary" for="checkbox-1"><?php _e('Clique para receber por email a newsletter mensal do KMOL','kmol');?></label>
							</td>
						</tr>
						
						<tr id="RegisterWithAjax_email">
							<td colspan="2">
								<input type="checkbox"></input>
								<label class="label_secondary" for="checkbox-2"><?php _e('Clique para receber por email informação de parceiros','kmol');?></label>
							</td>
						</tr>
						
						<tr><td colspan="2"></td></tr>
		
						<tr id="LoginWithAjax_Submit">
							<td id="LoginWithAjax_SubmitButton" colspan="2">
							<?php do_action('register_form'); ?>
								<div id="reg_passmail"><?php _e('A password will be e-mailed to you.') ?></div>
								<div class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="<?php esc_attr_e('Register'); ?>" tabindex="100" /></div>
								<input type="hidden" name="lwa" value="1" />
							</td>
						</tr>
					</tbody>
				</table>
		</form>
		</div> <!-- #LoginWithAjax_Register -->
		
		
		</div> <!-- .popup_register -->
	</div> <!-- .register_form -->



	<!-- Login Stuff -->
	<div id="popup_register" class="popup_box_register login_form">
		<div class="popup_title">
			<h2><?php _e('Login','kmol');?> </h2>
			<h1><?php _e('KMOL','kmol');?></h1>
		</div>
		<div class="popup_register">  <!-- login -->
			<p><?php _e('Faça login, comente e aceda à sua página pessoal com registo das suas contribuições!','kmol');?></p>
			<?php
			login_with_ajax(array( 'is_widget' => false, 'profile_link' => false, 'registration' =>1 ));
			?>
		</div> <!-- .popup_register -->
	</div> <!-- .login_form -->



</div> <!-- .popup_container -->

</div> <!-- popup-page -->

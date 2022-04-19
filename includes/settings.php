<?php
//Settings *************************************************
function anymarket_page_html()
{ ?>
	<div class="settings-anymarket">
		<h2 class="title">Configurações do Anymarket</h2>
		<hr>
		<form method="post" action="options.php">
			<?php settings_fields('anymarket_option_grup'); ?>

			<!-- URL ********************************** -->
			<label>
				<h4 class="title">URL: </h4><input type="text" id="anymarket_input_0" name="anymarket_input_0" value="<?php echo get_option('anymarket_input_0'); ?>" />
			</label>
			<br>
			<!-- Token ********************************** -->
			<label>
				<h4 class="title">Token: </h4><input type="text" id="anymarket_input_1" name="anymarket_input_1" value="<?php echo get_option('anymarket_input_1'); ?>" />
			</label>

			<br><br><!-- *************************************** -->
			<hr>
			<?php submit_button(); ?>
		</form>
		<h3>Warning: Create files:<br><br>
			<ul>
				<li>
					<i>'page-anymarket.php'</i> in theme directory and add code:<br>
					<code>echo do_shortcode("[scanymarket]");</code>
				</li><br>
				<li>
					<i>'page-amcallback.php'</i> in theme directory and add code:<br>
					<code>echo do_shortcode("[amcallback]");</code>
				</li>
			</ul>
		</h3>
	</div>
<?php
}

function anymarket_options_page()
{
	add_submenu_page('anymarket', 'Settings', 'Settings', 'edit_posts', 'settings', 'anymarket_page_html', 1);
}
add_action('admin_menu', 'anymarket_options_page');



//************************ DB Fields

function anymarket_settings0()
{
	add_option('anymarket_input_0');
	register_setting('anymarket_option_grup', 'anymarket_input_0');
}
add_action('admin_init', 'anymarket_settings0');

function anymarket_settings1()
{
	add_option('anymarket_input_1');
	register_setting('anymarket_option_grup', 'anymarket_input_1');
}
add_action('admin_init', 'anymarket_settings1');

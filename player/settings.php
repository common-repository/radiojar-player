

<?php $image =  plugin_dir_url( __FILE__ ).'poweredby.png'?>
<?php $player1 = plugin_dir_url( __FILE__ ).'player1.png'?>
<?php $player2 = plugin_dir_url( __FILE__ ).'player2.png'?>
<?php $player3 = plugin_dir_url( __FILE__ ).'player3.png'?>

<div id="wpbody">
    <div id="wpbody-content">
        <div class="wrap">
            <h2><?php _e("Player Settings", "radiojar-player") ?> - [rj-player]</h2>
				<div style="text-align:right;"> 
					<a target="_blank" href="http://www.radiojar.com/">
					<img style="width: 15%;margin-right: 10px;" src="<?php echo $image ?>"> 
					</a>
				</div>
            <table class="form-table"> 
				<form method="post" action="options.php">
                <?php settings_fields( 'rjp-settings-group' ); ?>
				<?php do_settings_sections( 'rjp-settings-group' ); ?>
                <tr valign="top">	
                    <th scope="row">
                        <strong>
                            <?php _e("Stream Name", "radiojar-player") ?>
                        </strong>
                    </th>
                    <td>
                        <input type="text" name="station_id" value="<?php echo (get_option('station_id') != '') ? get_option('station_id') : 'uf6x8w5f81ac' ; ?>" size="50" />
                        <span style="font-size:11px; color:#b2b2b2; font-style:italic; display:block;">
                            <?php _e("Please find your station's stream name on your Station's dashboard -> Tools -> Widgets.", "radiojar-player") ?>
                        </span>
                    </td>
                </tr>
				<tr valign="top">
                    <th scope="row">
                        <strong>
                            <?php _e("Autoplay", "radiojar-player") ?>
                        </strong>
                    </th>
                    <td>
                        <?php _e("Yes", "radiojar-player") ?>
                        <input id="rd4" type="radio" name="autoplay" value="true" <?php  if((get_option('autoplay')== 'true') || (get_option('autoplay')== '')){ echo 'checked="checked"';} ?> />
						<?php _e("No", "radiojar-player") ?>
                        <input id="rd5" type="radio" name="autoplay" value="false" <?php  if(get_option('autoplay')== 'false'){ echo 'checked="checked"';} ?> />
                    </td>
                </tr>
				
				<tr valign="top">
                    <th scope="row">
                        <strong>
                            <?php _e("Player", "radiojar-player") ?>
                        </strong>
                    </th>
                    <td>
                     <label>  
						<h2>1. <?php _e("Minimal player", "radiojar-player") ?></h2>
						<p>Just a play button</p>
						<br>
						<input id="rd1" type="radio" name="player" value="1" <?php  if((get_option('player')==1) || (get_option('player')== "")){ echo 'checked="checked"';} ?> />
						<img style="vertical-align:middle; width: 40%;" src="<?php echo $player1 ?>"> 
					</label>
					<br>
					 <label>  
					    <h2>2. <?php _e("Minimal player with mute", "radiojar-player") ?></h2>
						<p>Play button & mute/unmute control</p>
						<input id="rd2" type="radio" name="player" value="2" <?php  if(get_option('player')==2){ echo 'checked="checked"';} ?> />
						<img style="vertical-align:middle; width: 40%;" src="<?php echo $player2 ?>"> 
					</label>
						<br>					
					<label>  
					    <h2>3. <?php _e("Full Player", "radiojar-player") ?></h2>
						<p>Display artist/track name & album art, hover on the mute button to adjust volume.</p>
						<input id="rd3" type="radio" name="player" value="3" <?php  if(get_option('player')==3){ echo 'checked="checked"';} ?> />
						<img style="vertical-align:middle; width: 40%;" src="<?php echo $player3 ?>"> 
					
                    <div id="player3" style="display:none;">
						<br>
						 <div>
							<strong>
								<?php _e("Default Image", "radiojar-player") ?>
							</strong>                     
							<input type="url" name="default_image" value="<?php echo (get_option('default_image') != '')? get_option('default_image') : 'http://www.radiojar.com/img/sample_images/Radio_Stations_Avatar_BLUE.png'; ?>" size="80" />
							<img style="vertical-align:middle;border: solid;" width="161px" height="161px" src="<?php echo (get_option('default_image') != '')? get_option('default_image') : 'http://www.radiojar.com/img/sample_images/Radio_Stations_Avatar_BLUE.png'; ?>">
						</div>
                    </div>
					</label> 
					</td>
				</tr>
				
				<tr valign="top" style="margin-top:20px;">
					</hr>                   
				   <th scope="row">
                        <strong>
								<?php _e("Advanced Settings", "radiojar-player") ?>
				        </strong>
					</th>
					<td>
                    <input id="nav1" type="checkbox" name="navigation" value="6" <?php  if(get_option('navigation')==6){ echo 'checked="checked"';} ?> />
							<span style="font-size:11px; color:#b2b2b2; font-style:italic;">
								<?php _e("Continuous play-out during user navigation", "radiojar-player") ?>
							</span>
					<div id="nav2" style="display:none;">
						<br>
						<div>
							<strong>
								<?php _e("Container :", "radiojar-player") ?>
							</strong>                     
							<input type="text" name="container" value="<?php echo (get_option('container') != '') ? get_option('container') : 'main' ; ?>" size="40" />
							<span style="font-size:11px; color:#b2b2b2; font-style:italic; display:block;">
								<?php _e("ID of the container div whose data needs to be ajaxify. eg: main", "radiojar-player") ?>
							</span>
							<span style="font-size:11px; color:#b2b2b2; font-style:italic; display:block;">
								<?php _e("For advanced settings we suggest ", "radiojar-player") ?>
								<a target="_blank" href="//wordpress.org/plugins/ajaxify-wordpress-site/">Ajaxify WordPress Site(AWS) </a>
							</span>
						</div>
                    </div>
					</td>
                </tr>
				</table>
            <p class="submit">
                <input  type="submit" class="button-primary" value="<?php _e('Save Changes', "radiojar-player") ?>" />
            </p>

            </form> 	
        </div>
		<div class="preview-player">
				<h2> <?php _e("Preview", "radiojar-player") ?> </h2>
				<?php echo do_shortcode('[rj-player]') ?>
		</div>
        <div class="clear"></div>
        
	</div><!-- wpbody-content -->
    
    <div class="clear"></div>
</div>
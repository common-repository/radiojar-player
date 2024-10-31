<?php
/**
 * player3.php
 */
	wp_enqueue_style('radiojar-player3', plugin_dir_url(__FILE__) . 'player/player3.css');         
 ?>       
<div id="rj-player">
 <div class="player-v3">
  <div id="rj-cover">
    <a href="#"><img src=""/></a>
  </div>
  <div class="info">
   <div class="rjp-trackinfo-container">
    <h4 class="rjp-label">Now playing:</h4>
    <p id="trackInfo" class="rjp-info"></p>
   </div>
   <div class="rjp-player-container">
    <div id="rjp-radiojar-player"></div>
    <div id="rj-player-controls" class="rj-player-controls">
     <div class="jp-gui jp-interface">
      <div class="jp-controls">
       <a href="javascript:;" style="display:block" class="jp-play" title="Play">&nbsp;<i class="icon-play"></i></a>
       <a href="javascript:;" style="display:none" class="jp-pause" title="Pause"><i class="icon-pause"></i></a>
       <a href="javascript:;" style="display:block" class="jp-mute"  title="Mute"><i class="icon-volume-up"></i></a>
       <a href="javascript:;" style="display:none" class="jp-unmute" title="Unmute"><i class="icon-volume-off"></i></a>
       <div class="jp-volume-bar-wrapper">
        <div class="jp-volume-bar">
         <div class="jp-volume-bar-value"></div>
        </div>
       </div>
      </div>
     </div>
    </div>
    <div class="jp-no-solution">
     <span>Update Required</span>
     To play the media you will need to either update your browser to a recent version or update your <a href="//get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
    </div>
   </div>
  </div>
 </div>
</div>
<?php 
  
wp_enqueue_script( 'rj-script', '//www.radiojar.com/wrappers/api-plugins/v1/radiojar-min.js', array( 'jquery' )); 
$inline_js = 'rjq(\'#rjp-radiojar-player\').radiojar(\'player\', {"streamName":"'. $station_id .'","enableUpdates": true,"defaultImage": "'.$default_image.'","autoplay": '.$autoplay.' });';
$inline_js .= <<<EOD
     rjq('#rjp-radiojar-player').off('rj-track-load-event');
     rjq('#rjp-radiojar-player').on('rj-track-load-event', function(event, data) {
       updateInfo(data);
       if (data.title != "" || data.artist != "") {
       rjq('.rjp-trackinfo-container').show();
       rjq('#trackInfo').html(data.artist + ' - "' + data.title + '"')
       } else {
       rjq('.rjp-trackinfo-container').hide();
       }
     });

     function updateInfo(data) {
       if (data.thumb) {
       rjq('#rj-cover').html('<a href="#"><img src="' + data.thumb + '" alt="" title="" /></a>')
       } else {
       rjq('#rj-cover').html('')
       }
     }
EOD;
wp_add_inline_script('rj-script', $inline_js , 'after');

  ?>
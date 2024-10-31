<?php
/**
 * player1.php
 */
 ?>
 
<div id="rj-player">
 <div class="rjp-player-container">
  <div id="rjp-radiojar-player"></div>
  <div id="rj-player-controls" class="rj-player-controls">
   <div class="jp-gui jp-interface">
    <div class="jp-controls">
     <a href="javascript:;" style="display:block" class="jp-play" title="Play">&nbsp;<i class="icon-play"></i></a>
     <a href="javascript:;" style="display:none" class="jp-pause" title="Pause"><i class="icon-pause"></i></a>
    </div>
  </div>
  <div class="jp-no-solution">
   <span>Update Required</span>
   To play the media you will need to either update your browser to a recent version or update your <a href="//get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
   </div>
  </div>
 </div>
</div>
<?php 

  wp_enqueue_script( 'rj-script', '//www.radiojar.com/wrappers/api-plugins/v1/radiojar-min.js', array( 'jquery' )); 
  $inline_js = 'rjq(\'#rjp-radiojar-player\').radiojar(\'player\', {"streamName":"'. $station_id .'","autoplay": '.$autoplay.' })';
  wp_add_inline_script('rj-script', $inline_js , 'after');

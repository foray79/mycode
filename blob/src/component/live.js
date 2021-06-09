import React,{useEffect} from 'react' ;
import videojs from 'video.js'

function Live() {
    const videoJsOptions = {
        autoplay: true,
        controls: true,
        sources: [{
          src: 'https://jasongroup-live-demo.xst.kinxcdn.com/jasongroup_demo/_definst_/amlst:live/lFysdyPwx8tNgdxF2pATz5S1fUimm76K/playlist.m3u8',
          type: 'video/mp4'
        }]
      }

      const player = videojs('node', videoJsOptions, function onPlayerReady() {
        console.log('onPlayerReady', this)
      });

      useEffect(() => {
        player.dispose();
      }, [])
      

     

    return(
        <div data-vjs-player>
            <video ></video>
        </div>
       
    );
}
export default Live

<link rel="stylesheet" href="/css/app.css">
<script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>

<script src="https://unpkg.com/aframe-extras@3.3.0/dist/aframe-extras.min.js"></script>

<script src="https://cdn.rawgit.com/dataarts/dat.gui/master/build/dat.gui.min.js"></script>
<script src="/js/hide-on-enter-ar.js"></script>
<script src="/js/ar-shadows.js"></script>
<script src="/js/ar-hit-test.js"></script>
<script src="/js/model-viewer.js"></script>
<script src="/js/background-gradient.js"></script>


@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')

<h3>{{$widget['name']}}</h3>
<p>Downloads: {{$widget['download']}}</p>
<div id="object3d-cont" class="object3d-properties">
          
<a-scene embedded make-gui="gltfModel: #model3d;"
  model-viewer="gltfModel: #model3d; title: {{$widget['name']}}; guiCont: #object3d-cont">
  <a-assets>
    
    <a-asset-item id="model3d"
      src="/{{$widget['object_url']}}"
      response-type="arraybuffer" crossorigin="anonymous"></a-asset-item>

    <a-asset-item id="reticle"
      src="https://cdn.aframe.io/examples/ar/models/reticle/reticle.gltf"
      response-type="arraybuffer" crossorigin="anonymous"></a-asset-item>

    <img id="shadow" src="https://cdn.glitch.com/20600112-c04b-492c-8190-8a5ccc06f37d%2Fshadow.png?v=1606338852399"></img>
    
  </a-assets>
</a-scene>
        
       <!--
  
        <a-scene embedded>
            <a-plane position="0 0 -4" rotation="-90 0 0" width="4" height="4" color="#7BC8A4"></a-plane>
            <a-sky src="/img/mall.jpg"></a-sky>
             Dim ambient lighting. 
            <a-light type="ambient" color="#fff"></a-light>
            <a-gltf-model src="url(/{{$widget['object_url']}})" position="0 0 -4"></a-gltf-model>
        </a-scene>-->

</div>
<script >
    let height = window.innerHeight;
    console.log("height", height);
    let container = document.getElementById("object3d-cont");
    console.log("Top", container.getBoundingClientRect().y);
    container.clientHeight = height - container.getBoundingClientRect().y;
    container.style.height = height - container.getBoundingClientRect().y  +'px';

</script> 
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')

<link rel="stylesheet" href="/css/app.css">
<script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>
  </head>
<script src="/js/main.js"></script> 
@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')

<div class="object3d-properties">
            <h1 style="font-size: 72px">{{$widget['name']}}</h1>
            <p>Downloads: {{$widget['download']}}</p>
        </div>
    <div style=" display: grid; grid-template-columns: 1fr 1fr;">
        
       <!--<div style="margin-top: 120px; margin-left: 50px;">-->
       
      
        
       
        <a-scene>
            <a-box position="-1 0.5 -3" rotation="0 45 0" color="#4CC3D9"></a-box>
            <a-sphere position="0 1.25 -5" radius="1.25" color="#EF2D5E"></a-sphere>
            <a-cylinder position="1 0.75 -3" radius="0.5" height="1.5" color="#FFC65D"></a-cylinder>
            <a-plane position="0 0 -4" rotation="-90 0 0" width="4" height="4" color="#7BC8A4"></a-plane>
            <a-sky color="#ECECEC"></a-sky>
            <a-entity gltf-model="url({{$widget['download']}})"></a-entity>
        </a-scene>

    </div>

@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')
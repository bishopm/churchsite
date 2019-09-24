<h3>Find us</h3>
<div class="mapouter">
    <div class="gmap_canvas">
        <iframe width="100%" height="300" id="gmap_canvas" src="https://maps.google.com/maps?t=&z=17&ie=UTF8&iwloc=&output=embed&q={{urlencode(json_decode($widget->data)->location)}}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
        </iframe>
    <style>
        .mapouter{position:relative;text-align:center;height:300px;width:100%;}
        .gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}
    </style>
    </div>
</div>
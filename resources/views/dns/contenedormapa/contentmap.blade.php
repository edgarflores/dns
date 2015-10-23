<!-- <div class="jvectormap-container" style="background-color: rgb(238, 238, 238);">
  <svg width="631" height="468">
    <defs></defs>
    <g transform="scale(0.7011111111111111) translate(0, 113.40278757563556)">
    @foreach($rmapa as $mapavalue)
    <path d="{{$mapavalue->coord}}" data-code="{{$mapavalue->pais_abr}}" fill="#2b74a7" fill-opacity="1" stroke="#2b74a7" stroke-width="1" stroke-opacity="0.7" fill-rule="evenodd" class="jvectormap-region jvectormap-element"></path>
    @endforeach
    </g><g></g>
    <g>
      @foreach($rmarcadores as $marcadoresvalue )
        <circle data-index="{{$marcadoresvalue->dnschecker_id}}" cx="{{$marcadoresvalue->coordx}}" cy="{{$marcadoresvalue->coordy}}" fill="#FFBF00" stroke="#000000" fill-opacity="1" stroke-width="0.5" stroke-opacity="1" r="5" class="marcador{{$marcadoresvalue->dnschecker_id}}" cursor="pointer"></circle>
      @endforeach
    </g><g></g>
  </svg>
</div> -->
<div id="world-map" style="width: 600px; height: 400px"></div>

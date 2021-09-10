
    @if ($paginator->hasPages())
     


      <ul class="">
        
        @foreach ($elements as $element)
   
          @if (is_array($element))
            @foreach ($element as $page => $url)
              
              <li ><a href="{{ $url }}" >{{ $page }}</a></li>
             
            @endforeach
          @endif
        @endforeach

         
      </ul>

    
    
    @endif

 
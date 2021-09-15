
    @if ($paginator->hasPages())
     


      <ul>
        
        @foreach ($elements as $element)
   
          @if (is_array($element))
            @foreach ($element as $page => $url)
              
              <li ><a href="{{ $url }}" >{{ $page }}</a></li>
             
            @endforeach
          @endif
        @endforeach

         
      </ul>

    
    
    @endif

 
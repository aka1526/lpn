
    @if ($paginator->hasPages())
    <div class="pd-10">
     
      <ul class="pagination">
        @if ($paginator->onFirstPage())
         
          <li class="page-item"><a class="page-link disabled"  disabled><i class="icon ion-ios-arrow-back"></i></a></li>
        @else
      
         <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="icon ion-ios-arrow-back"></i></a></li>
        @endif

        @foreach ($elements as $element)
          {{-- "Three Dots" Separator --}}
          @if (is_string($element))
          <li><span class="pagination-ellipsis">&hellip;</span></li>
          @endif

          {{-- Array Of Links --}}
          @if (is_array($element))
            @foreach ($element as $page => $url)
              @if ($page == $paginator->currentPage())
              <li class="page-item active"><a class="page-link is-current" aria-label="Goto page {{ $page }}">{{ $page }}</a></li>
              @else
              <li class="page-item "><a href="{{ $url }}" class="page-link" aria-label="Goto page {{ $page }}">{{ $page }}</a></li>
              @endif
            @endforeach
          @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
          <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="icon ion-ios-arrow-forward"></i></a></li>
        @else
           
          <li class="page-item"><a class="page-link" disabled><i class="icon ion-ios-arrow-forward"></i></a></li>
        @endif
      </ul>

    </div>
    
    @endif

 
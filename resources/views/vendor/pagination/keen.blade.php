@if ($paginator->hasPages())
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="d-flex flex-wrap py-2 mr-3">
            @if (!$paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
            @endif

            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a href="javascript:void(0)" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">{{ $element }}</a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="javascript:void(0)" class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1"><i
                        class="ki ki-bold-arrow-next icon-xs"></i></a>
            @endif
        </div>
    </div>
@endif
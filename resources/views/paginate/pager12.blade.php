@if ($paginator->hasPages())
@php
if(isset($_GET['category']) && isset($_GET['type']) && isset($_GET['active_type'])){
  $url = "&category=".$_GET['category']."&type=".$_GET['type']."&active_type=".$_GET['active_type'];
} else {
  $url =null;  
} 
 
@endphp  
<style>
    @media screen and (max-width: 400px) {
        li.page-item {
            display: none;
        }
        .page-item:first-child,
        .page-item:nth-child(2),
        .page-item:nth-last-child(2),
        .page-item:last-child,
        .page-item.active,
        .page-item.disabled {
            display: block;
        }
    }
    .page-item.active .page-link {
    z-index: 0;
}
.pagination .active {
    width: 40px !important;
}
</style>

<nav aria-label="Page navigation example">
    <ul class="pagination nav justify-content-center">
        @if ($paginator->onFirstPage())
        <li class="page-item disabled"><a class="page-link" href="javascript:void(0)">«</a></li>

        @else
        <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}{{ $url }}" class="page-link" rel="prev">«</a></li>
        @endif

        @if($url=="")

        @if(!isset($_GET['page']))
        <li class="page-item active"><a class="page-link" href="employee-personal-information-details-report">All</a></li>
        @else 
        <li class="page-item"><a class="page-link" href="employee-personal-information-details-report">All</a></li>
        @endif

        @else

        @if(!isset($_GET['page']))
        <li class="page-item active"><a class="page-link" href="employee-personal-information-details-report?{{ substr($url, 1) }}">All</a></li>
        @else
        <li class="page-item"><a class="page-link" href="employee-personal-information-details-report?{{ substr($url, 1) }}">All</a></li>
        @endif 

        @endif

        @if ($paginator->currentPage() > 3)
        <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}{{ $url }}">1</a></li>
        @endif
        @if ($paginator->currentPage() > 4)
        <li class="page-item"><a class="page-link" href="javascript:void(0)">...</a></li>
        @endif
        @foreach (range(1, $paginator->lastPage()) as $i)
        @if ($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
            @if ($i == $paginator->currentPage())

            @if(isset($_GET['page']))
            <li class="page-item active"><a class="page-link" href="employee-personal-information-details-report/?page=1{{ $url }}">{{ $i }}</a></li>
            @else
            <li class="page-item"><a class="page-link" href="employee-personal-information-details-report/?page=1{{ $url }}">{{ $i }}</a></li>
            @endif
           
            @else
            <li class="page-item"><a class=" page-link" href="{{ $paginator->url($i) }}{{ $url }}">{{ $i }}</a></li>
            @endif
            @endif
            @endforeach
            @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                <li class="page-item"><a class="page-link" href="javascript:void(0)">...</a></li>
                @endif
                @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                    <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}{{ $url }}">{{ $paginator->lastPage() }}</a></li>
                    @endif
                    @if ($paginator->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}{{ $url }}" rel="next">»</a></li>
                    @else
                    <li class="page-item disabled"><a class="page-link" href="javascript:void(0)">»</a></li>
                    @endif
    </ul>

</nav>

@endif
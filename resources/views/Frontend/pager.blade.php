@if ($paginator->hasPages())
<style>
  .cmo{
    text-decoration: none !important;
  }
  </style>
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
      <div class="col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-12 text-center">
        <div class="flex justify-between flex-1" >


          <div class="row">
            <div class="col-md-3">
              @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ url('/employee-contract-renewal-details-report') }}{{ $paginator->previousPageUrl() }}" class="cmo relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('pagination.previous') !!}
                </a>
            @endif
            </div>
            <div class="col-md-6">
              <p class="text-sm text-gray-700 leading-5 mt-2 text-center">
                {!! __('Showing') !!}
                @if ($paginator->firstItem())
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('of') !!}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
            </div>
            <div class="col-md-3">
              @if ($paginator->hasMorePages())
                <a href="{{ url('/employee-contract-renewal-details-report') }}{{ $paginator->nextPageUrl() }}" class="cmo relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    {!! __('pagination.next') !!}
                </span>
            @endif
            </div>
          </div>
            
           
            
            



        </div>

      
    </div>
    </nav>
@endif
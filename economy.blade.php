@extends ('layouts.app')

@section ('breadcrumbs')
    <li><a href="{{ route('main') }}">{!! __('main.bread_main') !!}</a></li>
@endsection

@section ('content')
    <div class="row">
        <div class="col-md-4 remove-padding divider-right">
            <h2 class="section-header">Отраслевая экономика</h2>
            <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                @php($i = 1)
                @foreach($industries as $key => $industry)
                    <a class="nav-link{{ $i == 1 ? ' active' : '' }}" data-toggle="pill"
                       href="#c{{ $key }}"
                       role="tab" aria-controls="c{{ $key }}"
                       aria-selected="{{ $i == 1 ? 'true' : 'false' }}">
                        {{ $industry['name'] }}<i class="fas fa-angle-right"></i></a>
                    @php($i++)
                @endforeach
            </div>
        </div>
        <script type='text/javascript' src='http://code.jquery.com/jquery-1.11.1.min.js'></script>
        <script type='text/javascript' src='http://rawgit.com/fzondlo/jquery-columns/master/jquery-columns-plugin.js'></script>
        <div class="col-md-8 remove-padding divider">
            <div class="tab-content" id="v-pills-tabContent">
                @php($i = 1)
                @foreach($industries as $key => $industry)
                    <div class="tab-pane fade{{ $i == 1 ? ' show active' : '' }}" id="c{{ $key }}"
                         role="tabpanel">
                        <div id="accordion">
                            @if(!empty($industry['templates']))
                            <div class="container">
                            <ul class="list-unstyled row">
                            @foreach($industry['templates'] as $template)
                                <li class="list-item col-sm-6">
                                <a href={{$template['file']}}
                                  class="d-flex justify-content-start align-items-center" download>
                                    <div class="document-icon">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <span class="title">
                                    {{ $template['template'] }}</span>
                                </a>
                                </li>
                            @endforeach
                            </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                    @php($i++)
                @endforeach
            </div>
        </div>
    </div>
@endsection

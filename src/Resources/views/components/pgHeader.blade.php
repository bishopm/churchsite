    <h3>
        {{$pgtitle}}
    </h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-fw fa-home"></i> </a></li>
        <li class="breadcrumb-item"><a href="{{$prevroute}}">{{$prevtitle}}</a></li>
        <li class="breadcrumb-item active">{{$pgtitle}}</li>
    </ol>

<div class="container text-center">
    <div class="row mt-3">
        @foreach ($webfooter as $kk=>$wf)
        <div class="col-sm-3"><h4>{{$kk}}</h4>
            <ul class="list-unstyled">
            @foreach ($wf as $wi)
                <li>{!!$wi!!}</li>
            @endforeach
            </ul>
        </div>
        @endforeach
    </div>
</div>
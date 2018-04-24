@extends('layouts.app')

@section('content-top')
    @include('layouts.newGroupBar')
@endsection
@section('content')
    @if(count($groups) > 0 )
        <div class="row">
            @foreach($groups as $group)
                <div class="col col-lg-4 col-md-6 u-gap-bottom-medium u-flex u-flex-dir-column">
                    <div class="c-box c-box-small u-flex-grow-full">
                        <a href="" class="c-box_header">
                            <img class="u-full-width"
                                 src="{{ asset('img/users.png') }}"
                                 alt="">
                        </a>
                        <div class="c-box_body">
                            <div class="c-user-card u-gap-bottom-small">
                                <a class="c-user-card_image" href="{{ route('group-details', ['id' => $group->getId()]) }}">
                                    <img class="c-avatar"
                                         src="https://i.pinimg.com/originals/c0/df/44/c0df446fb5de28c57394e3b655815548.jpg"
                                         alt="{{ $group->getName() }}">
                                </a>
                                <div class="c-user-card_body">
                                    <a href="{{ route('group-details', ['id' => $group->getId()]) }}" class="c-user-card_title">{{ $group->getName() }}</a>
                                    <span class="c-user-card_subtitle"></span>
                                </div>
                            </div>
                            <p class="u-clear-gap">
                                {{$group->getName()}} grubu adına restoran tavsiyesi almak için
                                aşağıdaki butonu kullanabilirsiniz.
                            </p>
                        </div>
                        <div class="c-box_footer">
                            <a href="{{ $group->getIsAdmin() ? route('generate',['groupId' => $group->getId()]) : '' }}"
                               class="c-button c-button-primary c-button-block" {{$group->getIsAdmin() ? '' : 'disabled'}}>@lang('messages.generate')</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="c-box c-box-large u-gap-bottom">
            <div class="c-box_body row bold">
                @lang('messages.not_found_group')!
            </div>
        </div>
    @endif
@endsection

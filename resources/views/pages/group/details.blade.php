@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-lg-4 u-gap-bottom" style="">
                <div data-scrollmagic-pin-spacer="" class="scrollmagic-pin-spacer">
                    <div class="js-sticky-sidebar">
                        <div class="c-box c-box-medium u-gap-bottom-medium@md-up u-gap-bottom-small@sm-down">
                            <div class="c-box_body">
                                <div class="c-user-card">
                  <span class="c-user-card_image">
                                        <img class="c-avatar"
                                             src="https://i.pinimg.com/originals/c0/df/44/c0df446fb5de28c57394e3b655815548.jpg"
                                             alt="">
                  </span>
                                    <div class="c-user-card_body">
                                        <span class="c-user-card_title">{{ $group->getName() }}</span>
                                        <span class="c-user-card_subtitle">Yeni nesil ders notu pazaryeri.</span>
                                    </div>
                                    <button class="c-circle-icon u-flex-no-shrink u-hidden@lg-up u-gap-top-small u-gap-left-xsmall"
                                            data-toggle="collapse" data-target="#mobile" data-collapse-mobile="true">
                                        <svg class="icon c-circle-icon_icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 xlink:href="#icon-chevron-down"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <hr class="c-box_hr">
                            <ul id="mobile" class="c-menu" style="transition: height 0.3s; overflow: hidden;">
                                <li class="c-menu_item">
                  <span href="#" class="c-menu_link">
                    <span class="c-label u-color-primary u-block">Girişimin Bulunduğu Aşama</span>
                    <span>Ödeyen Müşteriler</span>
                  </span>
                                </li>
                                <li class="c-menu_item">
                <span href="#" class="c-menu_link">
                  <span class="c-label u-color-primary u-block">Girişimin Bulunduğu Sektör</span>
                  <span>Eğitim</span>
                </span>
                                </li>
                                <li class="c-menu_item">
                <span href="#" class="c-menu_link">
                  <span class="c-label u-color-primary u-block">Lokasyon</span>
                  <span>İstanbul, Türkiye</span>
                </span>
                                </li>
                                <li class="c-menu_item">
                <span href="#" class="c-menu_link">
                  <span class="c-label u-color-primary u-block">Kuruluş Tarihi</span>
                  <span>
                    Kasım
                    2016
                  </span>
                </span>
                                </li>
                                <li class="c-menu_item">
                <span href="#" class="c-menu_link">
                  <span class="c-label u-color-primary u-block">Web Adresi</span>
                  <span>
                    <a href="https://notedu.com" class="u-link-secondary" target="_blank" rel="noopener">
                    notedu.com
                    </a>
                  </span>
                </span>
                                </li>
                            </ul>
                        </div>
                        <button type="button" class="c-button c-button-primary c-button-block u-gap-bottom-small"
                                data-toggle="modal" data-target="#coming-soon">
            <span class="u-flex u-flex-align-middle">
              <svg class="icon u-font-size-xl u-flex-no-shrink">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-alarm-bell"></use>
              </svg>
              <span class="u-flex-grow-full">Radarıma Ekle</span>
            </span>
                        </button>
                        <button type="button" class="c-button c-button-ghost c-button-block u-gap-bottom-small"
                                data-toggle="modal" data-target="#coming-soon">
            <span class="u-flex u-flex-align-middle">
              <svg class="icon u-font-size-xl u-flex-no-shrink">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-chat"></use>
              </svg>
              <span class="u-flex-grow-full">Görüşme Talep Et</span>
            </span>
                        </button>
                        <button type="button" class="c-button c-button-ghost c-button-block" data-toggle="modal"
                                data-target="#coming-soon">
            <span class="u-flex u-flex-align-middle">
              <svg class="icon u-font-size-xl u-flex-no-shrink">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-mail"></use>
              </svg>
              <span class="u-flex-grow-full">Mesaj At</span>
            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col col-lg-8">

                <div class="c-box c-box-large u-gap-bottom">
                    <div class="c-box_body">
                        <h3 class="u-clear-gap-top">Girişim Özeti</h3>
                        <p>Notedu, öğrenciler için bir ders notu pazar yeridir. Üniversite öğrencileri derste tuttukları
                            notları satabilir veya buradan ders notu satın alabilirler.</p>
                    </div>
                </div>
                <div class="c-box c-box-large u-gap-bottom">
                    <div class="c-box_body">
                        <h3 class="u-clear-gap-top">{{ $group->getName() }} Ekibi</h3>
                        <div class="row">
                            @foreach($group->getUsers() as $user)
                                <div class="col col-md-6 u-flex u-flex-dir-column u-gap-bottom">
                                    <div class="c-box c-box-bordered c-box-background-gray c-box-medium u-flex-grow-full">
                                        <div class="c-box_body">

                                            <div class="c-user-card">
                                                <a class="c-user-card_image" href="">
                                                    <img class="c-avatar c-avatar-small c-avatar-rounded"
                                                         src="{{ asset('img/user.png') }}"
                                                         alt="">
                                                </a>
                                                <div class="c-user-card_body">
                                                    <a href=""
                                                       class="c-user-card_title u-font-size-regular">
                                                        {{ $user->getUser()->getFullName() }}
                                                    </a>
                                                    <span class="c-user-card_subtitle">Kurucu</span>
                                                    <a href="{{ route('group-member-delete', ['userId' => $user->getUserId(), 'id' => $group->getId(), 'groupId' => $group->getId() ]) }}">
                                                        <i class="fas fa-times-circle"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="c-box c-box-large u-gap-bottom">
                    <div class="c-box_body">
                        <h3 class="u-clear-gap-top">Önemli Gelişmeler</h3>
                        <ul class="c-timeline">
                            <li class="c-timeline_item">
                                <h5 class="c-timeline_title u-clear-gap">
                                    01
                                    Kasım
                                    2016
                                </h5>
                                <p class="u-clear-gap">Notedu kuruldu.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-9">
        <div class="card card-default">
            <div class="card-header">{{ $group->getName() }} - @lang('messages.group_details')</div>
            <div class="card-body">
                @if(!empty($group->getGenerate()))
        <li class="list-group-item">
            <i class="fas fa-money-bill-alt"></i> {{$group->getGenerate()->getRestaurant()->getName()}}
                <a href="{{route('regenerate', ['groupId' => $group->getId()])}}"
                           style="float:right; color: red !important;">
                            Regenerate
                        </a>
                    </li>
                @endif
            <li class="list-group-item">
                <i class="fas fa-money-bill-alt"></i> @lang('messages.budget')
            - {{ $group->getBudget() }}@lang('messages.currency_icon')
            </li>
            <li class="list-group-item">
                <i class="fas fa-users"></i> @lang('messages.members_count') - {{ count($group->getUsers()) }}
            </li>
        </div>
    </div>
</div>-->
@endsection
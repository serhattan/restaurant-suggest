@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col col-lg-4 u-gap-bottom">
            <div class="scrollmagic-pin-spacer">
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
                                    <span class="c-user-card_subtitle"></span>
                                </div>
                                <button class="c-circle-icon u-flex-no-shrink u-hidden@lg-up u-gap-top-small u-gap-left-xsmall"
                                        data-toggle="collapse" data-target="#mobile" data-collapse-mobile="true">
                                    <i class="fas fa-chevron-circle-down"></i>
                                </button>
                            </div>
                        </div>
                        <hr class="c-box_hr">
                        <ul id="mobile" class="c-menu">
                            <li class="c-menu_item">
                                    <span href="#" class="c-menu_link">
                                      <span class="c-label u-color-primary u-block">@lang('messages.members_count')</span>
                                      <span>
                                           {{ count($group->getUsers()) }}
                                      </span>
                                    </span>
                            </li>
                            <li class="c-menu_item">
                                    <span href="#" class="c-menu_link">
                                      <span class="c-label u-color-primary u-block">@lang('messages.budget')</span>
                                      <span>
                                        {{ $group->getBudget() }}@lang('messages.currency_icon')
                                      </span>
                                    </span>
                            </li>
                            <li class="c-menu_item">
                                    <span href="#" class="c-menu_link">
                                      <span class="c-label u-color-primary u-block">@lang('messages.year_of_foundation')</span>
                                      <span>
                                        {{ $group->getCreatedAt(true)->formatLocalized('%d %B %Y') }}
                                      </span>
                                    </span>
                            </li>
                        </ul>
                    </div>
                    @if ($group->getIsAdmin())
                        <a href="{{ route('generate',['groupId' => $group->getId()]) }}"
                           class="c-button c-button-primary c-button-block u-gap-bottom-small">
                                <span class="u-flex u-flex-align-middle">
                                <span class="u-flex-grow-full">@lang('messages.generate')</span>
                                </span>
                        </a>
                        <a href="{{ route('group-delete', ['id' => $group->getId()]) }}"
                           class="c-button c-button-danger c-button-block u-gap-bottom-small">
                                <span class="u-flex u-flex-align-middle">
                                    <span class="u-flex-grow-full">@lang('messages.delete_group')</span>
                                </span>
                        </a>
                    @endif
                    <a href="{{ route('group-member-delete', ['userId' => Auth::id(), 'id' => $group->getId()]) }}"
                       class="c-button c-button-danger c-button-block u-gap-bottom-small">
                            <span class="u-flex u-flex-align-middle">
                                 <span class="u-flex-grow-full">Leave Group</span>
                            </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col col-lg-8">
            @if(!empty($group->getGenerate()))
                <div class="c-box c-box-large u-gap-bottom">
                    <div class="c-box_body row">
                        <div class="col-md-6">
                            <h3 class="u-clear-gap-top">{{$group->getGenerate()->getRestaurant()->getName()}}</h3>
                        </div>
                        <div class="col-md-6">
                            @if ($group->getIsAdmin())
                                <a href="{{route('regenerate', ['groupId' => $group->getId()])}}"
                                   class="c-button c-button-danger c-button-block u-gap-bottom-small">
                                    @lang('messages.regenerate')
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            <div class="c-box c-box-large u-gap-bottom">
                <div class="c-box_body">
                    <div class="row">
                        @if (empty($group->getRestaurants()))
                            <h5>@lang('messages.group_not_have_restaurant')</h5>
                        @endif
                        @foreach ($group->getRestaurants() as $restaurant)
                            <div class="col col-lg-4 col-md-6 u-gap-bottom-medium u-flex u-flex-dir-column">
                                <div class="c-box c-box-small u-flex-grow-full">
                                    <div class="c-box_body">
                                        <div class="c-user-card">
                                            <div class="c-user-card_body">
                                                <a class="c-user-card_title">
                                                    {{$restaurant->getName()}}
                                                </a>
                                                <span class="c-user-card_subtitle">{{$restaurant->getAveragePrice()}}@lang('messages.currency_icon')</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @if ($group->getIsAdmin())
                <form method="post" action="{{ route('new-member') }}" class="js-form-validation">
                    @csrf
                    <div class="c-box c-box-large u-gap-bottom">
                        <div class="c-box_body">
                            <h3 class="u-clear-gap-top u-gap-bottom-xsmall u-text-center@md-down">
                                @lang('messages.add_new_members')
                            </h3>
                            <div class="row">
                                <div class="col col-lg-12 u-gap-bottom">
                                    <div class="c-form-group">
                                        <label class="c-label required"
                                               for="email">@lang('messages.please_enter_email')</label>
                                        <input type="email" id="email"
                                               name="email" required="required"
                                               class="c-form-control" placeholder="happy@whatwillieattoday.com"
                                               data-validetta="required,email">
                                    </div>
                                </div>
                            </div>
                            <div class="u-text-right">
                                <button type="submit"
                                        class="c-button c-button-primary">@lang('messages.add_new_members')</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="groupId" value="{{ $group->getId() }}">
                </form>
            @endif
            <div class="c-box c-box-large u-gap-bottom">
                <div class="c-box_body">
                    <h3 class="u-clear-gap-top">
                        {{ $group->getName() }} @lang('messages.team')
                    </h3>
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
                                                @if ($group->getIsAdmin())
                                                    <span class="c-user-card_subtitle">Kurucu</span>
                                                @else
                                                    <span class="c-user-card_subtitle">Üye</span>
                                                @endif
                                                @if ($group->getIsAdmin() && $user->getUserId() !== Auth::id())
                                                    <a href="{{ route('group-member-delete', [
                                                            'userId' => $user->getUserId(),
                                                            'id' => $group->getId()
                                                        ]) }}">
                                                        <i class="fas fa-times-circle"></i>
                                                    </a>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            @if (isset($activityLogs))
                <div class="c-box c-box-large u-gap-bottom">
                    <div class="c-box_body">
                        <h3 class="u-clear-gap-top">@lang('messages.history')</h3>
                        <ul class="c-timeline">
                            @foreach ($activityLogs as $activityLog)
                                <li class="c-timeline_item">
                                    <h5 class="c-timeline_title u-clear-gap">
                                        @lang("messages.".$activityLog->getActivity()->getName(). "_". $activityLog->getActivity()->getTable())
                                    </h5>
                                    <p class="u-clear-gap">@lang("messages.".$activityLog->getActivity()->getTable(). "_". $activityLog->getActivity()->getName(),
                                            $activityLog->getContent())</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
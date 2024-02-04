@php
    $role_color = 'bg-light-warning';
@endphp
<div class="card">
{{--    <h4 class="card-header">{{ trans('profile.showProfileTitle',['username' => $user->name]) }}</h4>--}}
    <div class="card-body">
        <div class="user-avatar-section">
            <div class="d-flex align-items-center flex-column">
                <img class="img-fluid rounded mt-3 mb-2" src="@if ($user->profile->avatar_status == 1) {{ $user->profile->avatar }} @else {{ Gravatar::get($user->email) }} @endif" alt="{{ $user->name }}" height="110" width="110" alt="User avatar" />
                <div class="user-info text-center">
                    <h4>{{ $user->first_name.' '.$user->last_name }}</h4>
                    <span class="badge {{ $role_color }}">{{ $user->roles[0]->name }}</span>
                </div>
            </div>
        </div>
{{--        <div class="d-flex justify-content-around my-2 pt-75">--}}
{{--            <div class="d-flex align-items-start me-2">--}}
{{--                <span class="badge bg-light-primary p-75 rounded">--}}
{{--                    <i data-feather="check" class="font-medium-2"></i>--}}
{{--                </span>--}}
{{--                <div class="ms-75">--}}
{{--                    <h4 class="mb-0">1.23k</h4>--}}
{{--                    <small>Tasks Done</small>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="d-flex align-items-start">--}}
{{--                <span class="badge bg-light-primary p-75 rounded">--}}
{{--                    <i data-feather="briefcase" class="font-medium-2"></i>--}}
{{--                </span>--}}
{{--                <div class="ms-75">--}}
{{--                    <h4 class="mb-0">568</h4>--}}
{{--                    <small>Projects Done</small>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <h4 class="fw-bolder border-bottom pb-50 mb-1">{{ __('Details') }}</h4>
        <div class="info-container">
            <ul class="list-unstyled">
                <li class="mb-75">
                    <span class="fw-bolder me-25">{{ trans('profile.showProfileUsername') }}:</span>
                    <span>{{ $user->name }}</span>
                </li>
                @if ($user->email && ($currentUser->id == $user->id || $currentUser->hasRole('admin')))
                <li class="mb-75">
                    <span class="fw-bolder me-25">{{ trans('profile.showProfileEmail') }}:</span>
                    <span>{{ $user->email }}</span>
                </li>
                @endif
                <li class="mb-75">
                    <span class="fw-bolder me-25">{{ trans('profile.showProfileStatus') }}:</span>
                    <span class="badge bg-light-success">{{ trans('profile.showProfileEnabled') }}</span>
                </li>
                <li class="mb-75">
                    <span class="fw-bolder me-25">Role:</span>
                    <span>Author</span>
                </li>
                <li class="mb-75">
                    <span class="fw-bolder me-25">Tax ID:</span>
                    <span>Tax-8965</span>
                </li>
                <li class="mb-75">
                    <span class="fw-bolder me-25">Contact:</span>
                    <span>+1 (609) 933-44-22</span>
                </li>
                <li class="mb-75">
                    <span class="fw-bolder me-25">Language:</span>
                    <span>English</span>
                </li>
                <li class="mb-75">
                    <span class="fw-bolder me-25">Country:</span>
                    <span>Wake Island</span>
                </li>
            </ul>
            <div class="d-flex justify-content-center pt-2">
                <a href="javascript:;" class="btn btn-primary me-1" data-bs-target="#editUser" data-bs-toggle="modal">
                    Edit
                </a>
                <a href="javascript:;" class="btn btn-outline-danger suspend-user">Suspended</a>
            </div>
        </div>
    </div>
</div>

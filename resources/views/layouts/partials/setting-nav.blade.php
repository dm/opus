<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    <div class="settings">        
        <ul class="list-unstyled">
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'settings/profile') class="active" @endif>
                <a href="{{ route('settings.profile') }}">Profile</a>            
            </li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'settings/account') class="active" @endif>
                <a href="{{ route('settings.account') }}">Account</a>        
            </li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'settings/emails') class="active" @endif>
                <a href="{{ route('settings.emails') }}">Email</a>            
            </li>
            <li @if(\App\Helpers\ViewHelper::getCurrentRoute() == 'settings/notifications') class="active" @endif>
                <a href="{{ route('settings.notifications') }}">Notifications</a>            
            </li>
        </ul>
    </div>
</div>
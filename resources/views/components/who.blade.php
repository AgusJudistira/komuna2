<div class="container">
    @if (Auth::guard('web')->check())
        <div class="row">
            <div class="col-sm-12">Je bent ingelogd als gebruiker: {{ Auth::guard('web')->user()->firstname . " " . Auth::guard('web')->user()->lastname}}</div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="/logout">Gebruiker uitloggen</a>
            </div>
        </div>
        <br />
        <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width: 70px; height: 70px; position: absolute; top: 10px; right:5%; border-style: solid; border-width: 1px; border-color: grey; border-radius: 50%;">
    @endif

    @if (Auth::guard('admin')->check())    
        <div class="row">
            <div class="col-sm-12">Je bent ingelogd als admin: {{ Auth::guard('admin')->user()->name }}</div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="/admin/logout">Admin uitloggen</a>
            </div>
             <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width: 70px; height: 70px; position: absolute; top: 10px; right:5%; border-style: solid; border-width: 1px; border-color: grey; border-radius: 50%;">
        </div>
    @endif
</div>
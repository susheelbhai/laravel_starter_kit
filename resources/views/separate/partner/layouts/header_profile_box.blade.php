<x-layout.header.profile-box 
:name="Str::words(Session::get('user')['login']->name ?? '', 1, '')" 
:designation="Session::get('user')['login']->designation ?? ''" 
:profilePic="asset(
    'images/profile_pic/partner/' . Session::get('user')['login']->profile_pic ?? 'images/profile_pic/dummy.png',
)" 
/>

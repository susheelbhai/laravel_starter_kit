<x-layout.header.logo href="{{ route('partner.dashboard') }}" 
:darkLogo="asset($setting->dark_logo ?? 'dummy.png')" 
:lightLogo="asset($setting->light_logo ?? 'dummy.png')" 
:darkLogoSmall="asset($setting->favicon ?? 'dummy.png')" 
:lightLogoSmall="asset($setting->favicon ?? 'dummy.png')" 
/>

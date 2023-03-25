<li class="menu-title">Menu</li>

<x-admin.sidebar.li1 icon="ri-dashboard-line" :href="route('admin.dashboard')" lbl="Dashboard" />
{{-- <x-admin.sidebar.li1 icon="ri-calendar-2-line" href="http://localhost/slist/storage/theme/admin/theme1/" lbl="Theme 1" /> --}}
<x-admin.sidebar.li1 icon="ri-account-circle-line" :href="route('admin.partner.index')" lbl="Partner" />
<x-admin.sidebar.li1 icon="ri-user-line" :href="route('admin.userQuery.index')" lbl="User Query" />

<x-admin.sidebar.li2 icon="ri-settings-5-fill" lbl="Setting">
    <x-admin.sidebar.li21 :href="route('admin.settings.general')" lbl="General Setting" />
    <x-admin.sidebar.li21 :href="route('admin.settings.advanced')" lbl="Advance Setting" />
</x-admin.sidebar.li2>

<li class="menu-title">Pages</li>

<x-admin.sidebar.li2 icon="fas fa-file-alt" lbl="Pages">
    <x-admin.sidebar.li21 :href="route('admin.pages.homePage')" lbl="Home" />
    <x-admin.sidebar.li21 :href="route('admin.pages.aboutPage')" lbl="About Us" />
    <x-admin.sidebar.li21 :href="route('admin.pages.contactPage')" lbl="Contact Us" />
    <x-admin.sidebar.li21 :href="route('admin.testimonial.index')" lbl="Testimonial" />
    <x-admin.sidebar.li21 :href="route('admin.pages.tncPage')" lbl="Terms & Conditions" />
    <x-admin.sidebar.li21 :href="route('admin.pages.privacyPage')" lbl="Privacy Policy" />
</x-admin.sidebar.li2>

<x-admin.sidebar.li2 icon="fab fa-pagelines" lbl="Layouts">
    <x-admin.sidebar.li21 :href="route('admin.icons')" lbl="Icons" />
    <x-admin.sidebar.li32 lbl="Footer">
        <x-admin.sidebar.li21 href="{{ route('admin.important_links.index') }}" lbl="Important Links" />
    </x-admin.sidebar.li32>
</x-admin.sidebar.li2>


<li class="menu-title">Listing</li>



{{-- 
<x-admin.sidebar.li3 icon="ri-calendar-2-line" lbl="Website Setting">
    <x-admin.sidebar.li21 :href="route('admin.slider.index')" lbl="Slider" />
    <x-admin.sidebar.li32 lbl="Mail">
        <x-admin.sidebar.li21 href="''" lbl="Dashboard" />
        <x-admin.sidebar.li21 href="''" lbl="Calendar" />
    </x-admin.sidebar.li32>
    <x-admin.sidebar.li32 lbl="Footer">
        <x-admin.sidebar.li21 :href="route('admin.important_links.index')" lbl="Important Links" />
        <x-admin.sidebar.li21 href="'" lbl="Calendar" />
    </x-admin.sidebar.li32>
</x-admin.sidebar.li3> --}}


<x-layout.sidebar.group icon="ri-dashboard-line" name="Menu">
    <x-layout.sidebar.li1 icon="ri-dashboard-line" :href="route('admin.dashboard')" name="Dashboard" />
    <x-layout.sidebar.li1 icon="ri-account-circle-line" :href="route('admin.partner.index')" name="Partner" />
    <x-layout.sidebar.li1 icon="ri-user-line" :href="route('admin.userQuery.index')" name="User Query" />

    <x-layout.sidebar.li2 icon="ri-settings-5-fill" name="Setting">
        <x-layout.sidebar.li21 :href="route('admin.settings.general')" name="General Setting" />
        <x-layout.sidebar.li21 :href="route('admin.settings.advanced')" name="Advance Setting" />
    </x-layout.sidebar.li2>
</x-layout.sidebar.group>


<x-layout.sidebar.li2 icon="fas fa-file-alt" name="Pages">
    <x-layout.sidebar.li21 :href="route('admin.pages.homePage')" name="Home" />
    <x-layout.sidebar.li21 :href="route('admin.pages.aboutPage')" name="About Us" />
    <x-layout.sidebar.li21 :href="route('admin.pages.contactPage')" name="Contact Us" />
    <x-layout.sidebar.li21 :href="route('admin.testimonial.index')" name="Testimonial" />
    <x-layout.sidebar.li21 :href="route('admin.pages.tncPage')" name="Terms & Conditions" />
    <x-layout.sidebar.li21 :href="route('admin.pages.privacyPage')" name="Privacy Policy" />
</x-layout.sidebar.li2>

<x-layout.sidebar.li2 icon="fab fa-pagelines" name="Layouts">
    <x-layout.sidebar.li32 name="Footer">
        <x-layout.sidebar.li21 href="{{ route('admin.important_links.index') }}" name="Important Links" />
    </x-layout.sidebar.li32>
</x-layout.sidebar.li2>

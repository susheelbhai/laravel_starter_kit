<x-layout.sidebar.group icon="ri-dashboard-line" name="Menu">
    <x-layout.sidebar.li1 icon="fas fa-tv" :href="route('admin.dashboard')" name="Dashboard" />
    <x-layout.sidebar.li1 icon="fa-solid fa-people-arrows" :href="route('admin.partner.index')" name="Partner" />
    <x-layout.sidebar.li1 icon="fas fa-clipboard-question" :href="route('admin.userQuery.index')" name="User Query" />
    <x-layout.sidebar.li1 icon="fas fa-newspaper" :href="route('admin.newsletter.index')" name="Newsletter" />

    <x-layout.sidebar.li2 icon="fa fa-cog" name="Setting">
        <x-layout.sidebar.li21 :href="route('admin.settings.general')" name="General Setting" />
        <x-layout.sidebar.li21 :href="route('admin.settings.advanced')" name="Advance Setting" />
    </x-layout.sidebar.li2>
</x-layout.sidebar.group>


<x-layout.sidebar.li2 icon="fas fa-file-alt" name="Pages">
    <x-layout.sidebar.li21 :href="route('admin.pages.homePage')" name="Home" />
    <x-layout.sidebar.li21 :href="route('admin.pages.aboutPage')" name="About Us" />
    <x-layout.sidebar.li21 :href="route('admin.pages.contactPage')" name="Contact Us" />
    <x-layout.sidebar.li21 :href="route('admin.testimonial.index')" name="Testimonial" />
    <x-layout.sidebar.li21 :href="route('admin.portfolio.index')" name="Portfolio" />
    <x-layout.sidebar.li21 :href="route('admin.pages.tncPage')" name="Terms & Conditions" />
    <x-layout.sidebar.li21 :href="route('admin.pages.privacyPage')" name="Privacy Policy" />
</x-layout.sidebar.li2>

<x-layout.sidebar.li2 icon="fas fa-server" name="Services">
    <x-layout.sidebar.li21 :href="route('admin.service.index')" name="All Services" />
    <x-layout.sidebar.li21 :href="route('admin.service.create')" name="Create Services" />
</x-layout.sidebar.li2>

<x-layout.sidebar.li2 icon="fas fa-blog" name="Blogs">
    <x-layout.sidebar.li21 :href="route('admin.blog.index')" name="All Blog" />
    <x-layout.sidebar.li21 :href="route('admin.blog.create')" name="Create Blog" />
</x-layout.sidebar.li2>

<x-layout.sidebar.li2 icon="fab fa-pagelines" name="Layouts">
    <x-layout.sidebar.li32 name="Footer">
        <x-layout.sidebar.li21 href="{{ route('admin.important_links.index') }}" name="Important Links" />
    </x-layout.sidebar.li32>
</x-layout.sidebar.li2>

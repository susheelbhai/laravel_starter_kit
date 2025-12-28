<x-layout.sidebar.group icon="ri-dashboard-line" name="Menu">
    <x-layout.sidebar.li1 icon="fas fa-tv" :href="route('admin.dashboard')" name="Dashboard" />
    <x-layout.sidebar.li1 icon="fa-solid fa-people-arrows" :href="route('admin.partner.index')" name="Partner" />
    <x-layout.sidebar.li1 icon="fas fa-clipboard-question" :href="route('admin.userQuery.index')" name="User Query" />
    <x-layout.sidebar.li1 icon="fas fa-newspaper" :href="route('admin.newsletter.index')" name="Newsletter" />

    <x-layout.sidebar.li1 icon="fas fa-folder-tree" :href="route('admin.product_category.index')" name="Category" />
    <x-layout.sidebar.li1 icon="fas fa-box" :href="route('admin.product.index')" name="Product" />
    <x-layout.sidebar.li1 icon="fas fa-message-square" :href="route('admin.productEnquiry.index')" name="Product Enquiry" />
    <x-layout.sidebar.li1 icon="fas fa-users-cog" :href="route('admin.admin.index')" name="Admin" />
    <x-layout.sidebar.li1 icon="fas fa-user-shield" :href="route('admin.role.index')" name="Role" />
    <x-layout.sidebar.li1 icon="fas fa-key" :href="route('admin.permission.index')" name="Permission" />
    <x-layout.sidebar.li1 icon="fas fa-user-tie" :href="route('admin.seller.index')" name="Seller" />
    <x-layout.sidebar.li1 icon="fas fa-user" :href="route('admin.user.index')" name="User" />

    <x-layout.sidebar.li2 icon="fa fa-cog" name="Setting">
        <x-layout.sidebar.li21 :href="route('admin.settings.general')" name="General Setting" />
        <x-layout.sidebar.li21 :href="route('admin.settings.advanced')" name="Advance Setting" />
    </x-layout.sidebar.li2>

    <x-layout.sidebar.li2 icon="fas fa-file-alt" name="Forms">
        <x-layout.sidebar.li21 :href="route('admin.forms.simple')" name="Simple" />
        <x-layout.sidebar.li21 :href="route('admin.forms.editor')" name="Editor" />
        <x-layout.sidebar.li21 :href="route('admin.forms.date')" name="Date" />
        <x-layout.sidebar.li21 :href="route('admin.forms.select')" name="Select" />
        <x-layout.sidebar.li21 :href="route('admin.forms.file')" name="File" />
        <x-layout.sidebar.li21 :href="route('admin.forms.image')" name="Image" />
        <x-layout.sidebar.li21 :href="route('admin.forms.wizard')" name="Widzard" />
    </x-layout.sidebar.li2>
</x-layout.sidebar.group>


<x-layout.sidebar.li2 icon="fas fa-file-alt" name="Pages">
    <x-layout.sidebar.li21 :href="route('admin.pages.homePage')" name="Home" />
    <x-layout.sidebar.li21 :href="route('admin.pages.aboutPage')" name="About Us" />
    <x-layout.sidebar.li21 :href="route('admin.pages.contactPage')" name="Contact Us" />
    <x-layout.sidebar.li21 :href="route('admin.testimonial.index')" name="Testimonial" />
    <x-layout.sidebar.li21 :href="route('admin.team.index')" name="Team" />
    <x-layout.sidebar.li21 :href="route('admin.portfolio.index')" name="Portfolio" />
    <x-layout.sidebar.li21 :href="route('admin.faq.index')" name="FAQ" />
    <x-layout.sidebar.li21 :href="route('admin.pages.tncPage')" name="Terms & Conditions" />
    <x-layout.sidebar.li21 :href="route('admin.pages.privacyPage')" name="Privacy Policy" />
    <x-layout.sidebar.li21 :href="route('admin.pages.refundPage')" name="Refund Policy" />
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

<x-layout.sidebar.li2 icon="fas fa-user-cog" name="Profile">
    <x-layout.sidebar.li21 :href="route('admin.profile.edit')" name="Settings" />
    <x-layout.sidebar.li21 :href="route('admin.logout')" name="Log Out" />
</x-layout.sidebar.li2>

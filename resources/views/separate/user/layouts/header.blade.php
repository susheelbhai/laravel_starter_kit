<x-layout.header.li1 :href="route('home')" name="Home" />
<x-layout.header.li1 :href="route('about')" name="About" />
<x-layout.header.li1 :href="route('contact')" name="Contact" />

<x-layout.header.li2 name="Services" style=2>
    <x-layout.header.li-group>
        <x-layout.header.li1 :href="route('home')" name="EPF Services" />
        <x-layout.header.li1 :href="route('home')" name="ESI Services" />
        <x-layout.header.li1 :href="route('home')" name="Professional Tax" />
        <x-layout.header.li1 :href="route('home')" name="Labour Welfare Fund" />
    </x-layout.header.li-group>
    <x-layout.header.li-group>
        <x-layout.header.li1 :href="route('home')" name="EPF Services" />
        <x-layout.header.li1 :href="route('home')" name="ESI Services" />
        <x-layout.header.li1 :href="route('home')" name="Professional Tax" />
        <x-layout.header.li1 :href="route('services')" name="All Services" />
    </x-layout.header.li-group>
</x-layout.header.li2>

<x-layout.header.li2 name="Services">
    <x-layout.header.li1 :href="route('home')" name="EPF Services" />
    <x-layout.header.li1 :href="route('home')" name="ESI Services" />
    <x-layout.header.li1 :href="route('home')" name="Professional Tax" />
    <x-layout.header.li1 :href="route('home')" name="Labour Welfare Fund" />
</x-layout.header.li2>

<x-layout.header.li1 :href="route('blog.index')" name="Blogs" />

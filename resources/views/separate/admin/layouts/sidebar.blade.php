@php
$sidebarMenu = include resource_path('data/php/admin_sidebar.php')
@endphp

@foreach($sidebarMenu as $group)
    <x-layout.sidebar.group :icon="$group['icon']" :name="$group['group']">
        @foreach($group['items'] as $item)
            
            @php
                $hasChildren = !empty($item['children']);
                $hasSubGroups = !empty($item['sub_groups']);
            @endphp

            @if(!$hasChildren && !$hasSubGroups)
                {{-- No children? It's a top-level link --}}
                <x-layout.sidebar.li1 
                    :icon="$item['icon']" 
                    :href="route($item['route'])" 
                    :name="$item['name']" 
                />
            @else
                {{-- Has children or sub-groups? It's a dropdown --}}
                <x-layout.sidebar.li2 :icon="$item['icon']" :name="$item['name']">
                    
                    {{-- Render Standard Children --}}
                    @if($hasChildren)
                        @foreach($item['children'] as $child)
                            <x-layout.sidebar.li21 :href="route($child['route'])" :name="$child['name']" />
                        @endforeach
                    @endif

                    {{-- Render Sub-groups (Nested levels) --}}
                    @if($hasSubGroups)
                        @foreach($item['sub_groups'] as $sub)
                            <x-layout.sidebar.li32 :name="$sub['name']">
                                @foreach($sub['children'] as $subChild)
                                    <x-layout.sidebar.li21 :href="route($subChild['route'])" :name="$subChild['name']" />
                                @endforeach
                            </x-layout.sidebar.li32>
                        @endforeach
                    @endif

                </x-layout.sidebar.li2>
            @endif

        @endforeach
    </x-layout.sidebar.group>
@endforeach
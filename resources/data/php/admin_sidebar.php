<?php

return $sidebarMenu = [
    [
        'group' => 'Menu',
        'icon' => 'ri-dashboard-line',
        'items' => [
            ['name' => 'Dashboard', 'icon' => 'fas fa-tv', 'route' => 'admin.dashboard'],
            ['name' => 'Partner', 'icon' => 'fa-solid fa-people-arrows', 'route' => 'admin.partner.index'],
            ['name' => 'User Query', 'icon' => 'fas fa-clipboard-question', 'route' => 'admin.userQuery.index'],
            ['name' => 'Newsletter', 'icon' => 'fas fa-newspaper', 'route' => 'admin.newsletter.index'],
            ['name' => 'Gallery', 'icon' => 'fas fa-image', 'route' => 'admin.gallery.index'],
            [
                'name' => 'Product',
                'icon' => 'fas fa-box',
                'children' => [
                    ['name' => 'Products Category', 'route' => 'admin.product_category.index'],
                    ['name' => 'All Products', 'route' => 'admin.product.index'],
                    ['name' => 'Product Enquiry', 'route' => 'admin.productEnquiry.index'],
                ]
            ],
            ['name' => 'Admin', 'icon' => 'fas fa-users-cog', 'route' => 'admin.admin.index'],
            ['name' => 'Role', 'icon' => 'fas fa-user-shield', 'route' => 'admin.role.index'],
            ['name' => 'Permission', 'icon' => 'fas fa-key', 'route' => 'admin.permission.index'],
            ['name' => 'Seller', 'icon' => 'fas fa-user-tie', 'route' => 'admin.seller.index'],
            ['name' => 'User', 'icon' => 'fas fa-user', 'route' => 'admin.user.index'],
            [
                'name' => 'App Setting',
                'icon' => 'fa fa-cog',
                'route' => 'admin.settings.general',
            ],
            [
                'name' => 'Forms',
                'icon' => 'fas fa-file-alt',
                'children' => [
                    ['name' => 'Simple', 'route' => 'admin.forms.simple'],
                    ['name' => 'Editor', 'route' => 'admin.forms.editor'],
                    ['name' => 'Date', 'route' => 'admin.forms.date'],
                    ['name' => 'Select', 'route' => 'admin.forms.select'],
                    ['name' => 'File', 'route' => 'admin.forms.file'],
                    ['name' => 'Image', 'route' => 'admin.forms.image'],
                    ['name' => 'Wizard', 'route' => 'admin.forms.wizard'],
                ],
            ],
        ],
    ],
    [
        'group' => 'Menu2',
        'icon' => 'ri-dashboard-line',
        'items' => [
            [
                'name' => 'Pages',
                'icon' => 'fas fa-file-alt',
                'children' => [
                    ['name' => 'Home', 'route' => 'admin.pages.homePage'],
                    ['name' => 'About Us', 'route' => 'admin.pages.aboutPage'],
                    ['name' => 'Contact Us', 'route' => 'admin.pages.contactPage'],
                    ['name' => 'Testimonial', 'route' => 'admin.testimonial.index'],
                    ['name' => 'Team', 'route' => 'admin.team.index'],
                    ['name' => 'Portfolio', 'route' => 'admin.portfolio.index'],
                    ['name' => 'FAQ', 'route' => 'admin.faq.index'],
                    ['name' => 'Terms & Conditions', 'route' => 'admin.pages.tncPage'],
                    ['name' => 'Privacy Policy', 'route' => 'admin.pages.privacyPage'],
                    ['name' => 'Refund Policy', 'route' => 'admin.pages.refundPage'],
                ],
            ],
            [
                'name' => 'Services',
                'icon' => 'fas fa-server',
                'children' => [
                    ['name' => 'All Services', 'route' => 'admin.service.index'],
                    ['name' => 'Create Services', 'route' => 'admin.service.create'],
                ],
            ],
            [
                'name' => 'Projects',
                'icon' => 'fab fa-pagelines', // Updated icon
                'children' => [
                    ['name' => 'All Projects', 'route' => 'admin.project.index'],
                    ['name' => 'Create Projects', 'route' => 'admin.project.create'],
                ],
            ],
            [
                'name' => 'Blogs',
                'icon' => 'fas fa-blog',
                'children' => [
                    ['name' => 'All Blog', 'route' => 'admin.blog.index'],
                    ['name' => 'Create Blog', 'route' => 'admin.blog.create'],
                ],
            ],
            [
                'name' => 'Layouts',
                'icon' => 'fab fa-pagelines',
                'sub_groups' => [
                    [
                        'name' => 'Footer',
                        'children' => [
                            ['name' => 'Important Links', 'route' => 'admin.important_links.index'],
                        ],
                    ],
                ],
            ],
            [
                'name' => 'Profile',
                'icon' => 'fas fa-user-cog',
                'children' => [
                    ['name' => 'Settings', 'route' => 'admin.profile.edit'],
                    ['name' => 'Log Out', 'route' => 'admin.logout'],
                ],
            ],
        ],
    ],
];

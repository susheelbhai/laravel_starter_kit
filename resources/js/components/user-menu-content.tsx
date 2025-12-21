import React from 'react';
import { DropdownMenuGroup, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator } from '@/components/ui/dropdown-menu';
import { UserInfo } from '@/components/user-info';
import { useMobileNavigation } from '@/hooks/use-mobile-navigation';
import { type User } from '@/types';
import { Link, router } from '@inertiajs/react';

interface UserMenuContentProps {
    user: User;
    profileNavItems: any; // Replace 'any' with the correct type if known
}

export function UserMenuContent({ user, profileNavItems }: UserMenuContentProps) {
    const cleanup = useMobileNavigation();

    const handleLogout = () => {
        cleanup();
        router.flushAll();
    };
    return (
        <>
            <DropdownMenuLabel className="p-0 font-normal">
                <div className="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                    <UserInfo user={user} showEmail={true} />
                </div>
            </DropdownMenuLabel>
            <DropdownMenuSeparator />

            <DropdownMenuGroup>
                {profileNavItems.map((item: any) => {
                    return (
                        <React.Fragment key={item.title}>
                            {item.title === 'Log Out' ? (
                                <DropdownMenuItem asChild>
                                    <Link className="block w-full cursor-pointer" method="post" href={item.href} as="button" onClick={handleLogout}>
                                        {item.icon && <item.icon />}
                                        {item.title}
                                    </Link>
                                </DropdownMenuItem>
                            ) : (
                                <DropdownMenuItem asChild>
                                    <Link className="block w-full cursor-pointer" href={item.href} as="button" prefetch onClick={cleanup}>
                                        {item.icon && <item.icon />}
                                        {item.title}
                                    </Link>
                                </DropdownMenuItem>
                            )}
                            <DropdownMenuSeparator />
                        </React.Fragment>
                    );
                })}
            </DropdownMenuGroup>
        </>
    );
}

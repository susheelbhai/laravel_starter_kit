import { useState, useRef, useEffect } from 'react';
import { router } from '@inertiajs/react';
import NotificationBox from './notification-box';
import { NotificationIcon } from './notification-icon';

export function NotificationComponent({ notificationData }: {
    notificationData?: {
        unreadNotificationsCount: number;
        unreadNotifications: any[];
        all_notifications_url: string;
    };
}) {
    const unreadNotificationsCount = notificationData?.unreadNotificationsCount ?? 0;
    const unreadNotifications = notificationData?.unreadNotifications ?? [];
    const all_notifications_url = notificationData?.all_notifications_url ?? "#";

    const [dropdownOpen, setDropdownOpen] = useState(false);
    const dropdownRef = useRef<HTMLDivElement>(null);

    // Close dropdown on outside click
    useEffect(() => {
        function handleClickOutside(event: MouseEvent) {
            if (dropdownRef.current && !dropdownRef.current.contains(event.target as Node)) {
                setDropdownOpen(false);
            }
        }
        if (dropdownOpen) {
            document.addEventListener('mousedown', handleClickOutside);
        } else {
            document.removeEventListener('mousedown', handleClickOutside);
        }
        return () => document.removeEventListener('mousedown', handleClickOutside);
    }, [dropdownOpen]);

    const handleSeeAll = () => {
        router.visit(all_notifications_url); // Change this route as needed
        setDropdownOpen(false);
    };

    return (
        <div className="relative" ref={dropdownRef}>
            <NotificationIcon setDropdownOpen={setDropdownOpen} unreadNotificationsCount={unreadNotificationsCount} />

            {dropdownOpen && (
                <NotificationBox unreadNotifications={unreadNotifications} handleSeeAll={handleSeeAll} />
            )}
        </div>
    );
}
export default function NotificationBox({ unreadNotifications = [], handleSeeAll }: { unreadNotifications?: any[], handleSeeAll: () => void }) {
    return (
        <div className="absolute right-0 mt-2 w-80 bg-[var(--color-card)] border border-[var(--color-border)] rounded-lg shadow-lg z-50">
            <div className="p-4 border-b font-semibold text-[var(--color-card-foreground)]">Unread Notifications</div>
            <ul className="max-h-72 overflow-y-auto divide-y divide-[var(--color-border)]">
                {(!unreadNotifications || unreadNotifications.length === 0) && (
                    <li className="p-4 text-[var(--color-muted-foreground)] text-sm text-center">No unread notifications</li>
                )}
                {unreadNotifications && unreadNotifications.slice(0, 5).map((notification: any) => (
                    <li
                        key={notification.id}
                        className="p-4 hover:bg-[var(--color-muted)] cursor-pointer text-sm"
                    >
                        <a href={notification.href ?? '#'} className="block">
                            <div className="font-medium text-[var(--color-card-foreground)]">{notification.data?.title ?? 'Notification'}</div>
                            <div className="text-[var(--color-muted-foreground)]">{notification.data?.data?.message ?? ''}</div>
                            <div className="text-xs text-[var(--color-muted-foreground)] mt-1">{notification.created_at ? new Date(notification.created_at).toLocaleString() : ''}</div>
                        </a>
                    </li>
                ))}
            </ul>
            <div className="p-2 border-t flex justify-center">
                <button
                    className="text-primary hover:underline text-sm font-medium cursor-pointer"
                    onClick={handleSeeAll}
                >
                    See all notifications
                </button>
            </div>
        </div>
    );
}
import { filterMenuItems } from '@/lib/filter_menu';
import { footerNavItems, mainNavItems, profileNavItems } from '../../../data/js/sidebar_partner';

export const filteredMainNavItems = filterMenuItems(mainNavItems);
export const filteredFooterNavItems = filterMenuItems(footerNavItems);
export const filteredProfileNavItems = filterMenuItems(profileNavItems);

export { footerNavItems, mainNavItems, profileNavItems };

import { footerNavItems, mainNavItems, profileNavItems } from '../../../data/js/sidebar_partner';
import { filterMenuItems } from '@/lib/filter_menu';

export const filteredMainNavItems = filterMenuItems(mainNavItems);
export const filteredFooterNavItems = filterMenuItems(footerNavItems);
export const filteredProfileNavItems = filterMenuItems(profileNavItems);

export { footerNavItems, mainNavItems, profileNavItems };

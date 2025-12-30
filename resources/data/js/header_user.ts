const menuItems = [
    { name: "Home", routeName: "home" },
    { name: "About", routeName: "about" },
    { name: "Product", routeName: "product.index" },
    { name: "Services", routeName: "services" },
    { name: "Blogs", routeName: "blog.index" },
    { name: "Contact", routeName: "contact" },
];

const profileItems = [
    { name: "Profile", routeName: "profile.edit" },
    { name: "Logout", routeName: "logout", method: "post" },
];

const loginRoute = "login";
export { menuItems, profileItems, loginRoute };

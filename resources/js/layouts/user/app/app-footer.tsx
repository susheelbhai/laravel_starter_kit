import { Link, usePage } from '@inertiajs/react';
import React from 'react';
import { FaFacebookF, FaInstagram, FaLinkedinIn, FaTwitter } from 'react-icons/fa';

const Footer: React.FC = () => {
    const appData = (usePage().props as any).appData;
    const important_links = (usePage().props as any).important_links;

    return (
        <footer className="bg-gray-900 px-6 py-10 text-gray-300 md:px-16">
            <div className="mx-auto grid max-w-7xl grid-cols-1 gap-8 md:grid-cols-3">
                {/* Section 1: Contact Info */}
                <div>
                    <Link href="/" className="flex items-center">
                        <img src={`/${appData.dark_logo}`} alt="Logo" className="h-10 w-auto" />
                    </Link>
                    {/* <h2 className="mb-4 text-xl font-bold text-white">{appData.name}</h2> */}
                    <p className="mb-2 mt-6">
                        📞
                        <a href={`tel:${appData.phone}`}>{appData.phone}</a>
                    </p>
                    <p className="mb-2">
                        ✉️
                        <a href={`mailto:${appData.email}`}>{appData.email}</a>
                    </p>
                    <p className="mb-2">🏢 {appData.address}</p>
                </div>

                {/* Section 2: Important Links */}
                <div>
                    <h2 className="mb-4 text-xl font-bold text-white">Important Links</h2>
                    <ul className="space-y-2">
                        {important_links.map((link: any) => (
                            <li key={link.id}>
                                <Link href={link.href} className="transition hover:text-white">
                                    {link.name}
                                </Link>
                            </li>
                        ))}
                    </ul>
                </div>

                {/* Section 3: Social Media */}
                <div>
                    <h2 className="mb-4 text-xl font-bold text-white">Follow Us</h2>
                    <div className="flex space-x-4">
                        <a href={appData.facebook} target="_blank" className="text-lg hover:text-white">
                            <FaFacebookF />
                        </a>
                        <a href={appData.twitter} target="_blank" className="text-lg hover:text-white">
                            <FaTwitter />
                        </a>
                        <a href={appData.instagram} target="_blank" className="text-lg hover:text-white">
                            <FaInstagram />
                        </a>
                        <a href={appData.linkedin} target="_blank" className="text-lg hover:text-white">
                            <FaLinkedinIn />
                        </a>
                    </div>
                </div>
            </div>

            <div className="mt-10 text-center text-sm text-gray-500">© {new Date().getFullYear()} {appData.name}. All rights reserved.</div>
        </footer>
    );
};

export default Footer;

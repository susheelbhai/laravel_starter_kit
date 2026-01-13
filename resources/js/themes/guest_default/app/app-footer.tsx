import { Link, usePage } from "@inertiajs/react";
import React, { useEffect, useState } from "react";
import {
  FaFacebookF,
  FaInstagram,
  FaLinkedinIn,
  FaTwitter,
  FaYoutube,
} from "react-icons/fa";

const Footer: React.FC = () => {
  const appData = (usePage().props as any).appData;
  const important_links = (usePage().props as any).important_links;
  const [visitors, setVisitors] = useState({ total: 0, today: 0 });

  useEffect(() => {
    fetch("/api/visitors/count")
      .then((res) => res.json())
      .then((data) => setVisitors(data))
      .catch(() => {});
  }, []);

  return (
    <footer className=" bg-slate-950 text-slate-300 ">
      {/* Accent top border */}
      <div className="h-1 w-full bg-primary " />

      <div className="mx-auto max-w-7xl px-6 py-10 md:px-10 lg:px-14">
        <div className="grid grid-cols-1 gap-10 md:grid-cols-3">
          {/* Section 1: Logo + Contact */}
          <div className="space-y-4">
            <Link href="/" className="inline-flex items-center gap-3">
              {appData.light_logo && (
                <img
                  src={appData.light_logo}
                  alt={appData.name || "Logo"}
                  className="h-10 w-auto"
                />
              )}
            </Link>

            <p className="text-sm text-slate-400 max-w-xs">
              {appData.tagline ||
                "Committed to delivering quality services with trust and excellence."}
            </p>

            <div className="mt-4 space-y-1.5 text-sm">
              <p>
                <span className="mr-1.5 text-primary">📞</span>
                <a
                  href={`tel:${appData.phone}`}
                  className="hover:text-primary transition-colors"
                >
                  {appData.phone}
                </a>
              </p>
              <p>
                <span className="mr-1.5 text-primary">✉️</span>
                <a
                  href={`mailto:${appData.email}`}
                  className="hover:text-primary transition-colors break-all"
                >
                  {appData.email}
                </a>
              </p>
              <p className="flex items-start text-sm">
                <span className="mr-1.5 text-primary">🏢</span>
                <span className="text-slate-400">{appData.address}</span>
              </p>
            </div>
          </div>

          {/* Section 2: Important Links */}
          <div>
            <h2 className="mb-4 text-base font-semibold tracking-wide text-white">
              Important Links
            </h2>
            <ul className="space-y-2 text-sm">
              {important_links.map((link: any) => (
                <li key={link.id}>
                  <Link
                    href={link.href}
                    className="inline-flex items-center gap-2 text-slate-400 transition-colors hover:text-primary"
                  >
                    <span className="rounded-full bg-slate-500" />
                    {link.name}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Section 3: Social + Visitors */}
          <div className="space-y-4">
            <h2 className="mb-2 text-base font-semibold tracking-wide text-white">
              Connect With Us
            </h2>
            <div className="flex flex-wrap items-center gap-3">
              {appData.facebook && (
                <a
                  href={appData.facebook}
                  target="_blank"
                  rel="noreferrer"
                  className="flex h-9 w-9 items-center justify-center rounded-full bg-slate-800 text-sm text-slate-200 transition-all hover:-translate-y-0.5 hover:bg-primary hover:text-slate-950"
                >
                  <FaFacebookF />
                </a>
              )}
              {appData.twitter && (
                <a
                  href={appData.twitter}
                  target="_blank"
                  rel="noreferrer"
                  className="flex h-9 w-9 items-center justify-center rounded-full bg-slate-800 text-sm text-slate-200 transition-all hover:-translate-y-0.5 hover:bg-primary hover:text-slate-950"
                >
                  <FaTwitter />
                </a>
              )}
              {appData.instagram && (
                <a
                  href={appData.instagram}
                  target="_blank"
                  rel="noreferrer"
                  className="flex h-9 w-9 items-center justify-center rounded-full bg-slate-800 text-sm text-slate-200 transition-all hover:-translate-y-0.5 hover:bg-primary hover:text-slate-950"
                >
                  <FaInstagram />
                </a>
              )}
              {appData.linkedin && (
                <a
                  href={appData.linkedin}
                  target="_blank"
                  rel="noreferrer"
                  className="flex h-9 w-9 items-center justify-center rounded-full bg-slate-800 text-sm text-slate-200 transition-all hover:-translate-y-0.5 hover:bg-primary hover:text-slate-950"
                >
                  <FaLinkedinIn />
                </a>
              )}
              {appData.youtube && (
                <a
                  href={appData.youtube}
                  target="_blank"
                  rel="noreferrer"
                  className="flex h-9 w-9 items-center justify-center rounded-full bg-slate-800 text-sm text-slate-200 transition-all hover:-translate-y-0.5 hover:bg-primary hover:text-slate-950"
                >
                  <FaYoutube />
                </a>
              )}
            </div>

            {/* Visitor Stats */}
            <div className="mt-4 grid grid-cols-2 gap-3 text-xs">
              <div className="rounded-xl border border-slate-800 bg-slate-900/60 px-3 py-2.5">
                <p className="text-[11px] uppercase tracking-wide text-slate-400">
                  Total Visitors
                </p>
                <p className="mt-1 text-lg font-semibold text-primary">
                  {visitors.total}
                </p>
              </div>
              <div className="rounded-xl border border-slate-800 bg-slate-900/60 px-3 py-2.5">
                <p className="text-[11px] uppercase tracking-wide text-slate-400">
                  Today&apos;s Visitors
                </p>
                <p className="mt-1 text-lg font-semibold text-primary">
                  {visitors.today}
                </p>
              </div>
            </div>
          </div>
        </div>

        {/* Bottom bar */}
        <div className="border-t border-slate-800/80 py-4 text-center text-xs text-slate-500">
          <div className="flex flex-col justify-between md:flex-row md:gap-4">
            <div className="copy">
              © {new Date().getFullYear()}{" "}
              <span className="font-medium text-slate-300">{appData.name}</span>. All
              rights reserved.
            </div>
            <div className="credit">
              Developed by{" "}
              <a
                href="https://digamite.com"
                target="_blank"
                rel="noreferrer"
                className="text-primary hover:underline"
              >
                Digamite Private Limited
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;

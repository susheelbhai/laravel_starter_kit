import React from "react";

const HeroSection: React.FC = () => {
  return (
    <section className="bg-gradient-to-b from-white to-gray-50 py-20">
      <div className="container mx-auto px-6 text-center">
        <h1 className="text-5xl font-bold text-gray-800 leading-tight mb-6">
          We Make Awesome <br />
          Websites & Applications
        </h1>
        <p className="text-lg text-gray-600 mb-8">
          A modern solution for your online presence, crafted with care and attention to detail.
        </p>
        <div className="flex flex-col sm:flex-row justify-center gap-4">
          <a
            href="#services"
            className="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition"
          >
            Get Started
          </a>
          <a
            href="#contact"
            className="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 transition"
          >
            Contact Us
          </a>
        </div>
      </div>
    </section>
  );
};

export default HeroSection;

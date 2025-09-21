export default function AboutSection() { 
            return  <section id="about" className="bg-white py-20 md:py-28">
                <div className="mx-auto grid max-w-[1320px] items-center gap-12 px-4 md:grid-cols-2 md:px-6">
                    <div className="relative">
                        <img src="/storage/images/about/about-01.png" alt="About" className="w-full rounded-md" />
                        <img src="/storage/images/about/about-shape.png" alt="Shape" className="absolute -bottom-6 -left-6 h-20 w-20 object-contain" />
                    </div>
                    <div>
                        <span className="text-sm font-semibold tracking-wider text-[#FAB915] uppercase">About Us</span>
                        <h2 className="mt-4 mb-6 text-3xl leading-tight font-bold md:text-5xl">
                            Best Business <br /> Consulting Agency
                        </h2>
                        <p className="mb-6 text-[#6B7280]">
                            We help you to grow your business from scratch with modern solutions and professional support team.
                        </p>
                        <ul className="list-disc space-y-2 pl-5 text-[#0E1339]">
                            <li>Professional Consulting</li>
                            <li>Modern Solutions</li>
                            <li>24/7 Support</li>
                        </ul>
                    </div>
                </div>
            </section>
}
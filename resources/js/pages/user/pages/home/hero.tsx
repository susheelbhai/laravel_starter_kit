export default function HeroSection() {
    return (
        <section id="home" className="relative overflow-hidden bg-[#F5F6FA] py-20 text-left md:py-32">
                <div className="mx-auto grid max-w-[1320px] items-center gap-8 px-4 md:grid-cols-2 md:px-6">
                    <div>
                        <p className="mb-4 font-semibold text-[#FAB915]">Welcome to Finbiz</p>
                        <h1 className="text-4xl leading-tight font-bold md:text-6xl">
                            Smart Solutions For <br />
                            Your Business Needs
                        </h1>
                        <p className="mt-6 max-w-md text-[#6B7280]">We are a team of talented designers making websites with Bootstrap</p>
                        <div className="mt-8 flex space-x-4">
                            <button className="rounded-md bg-[#1F3984] px-6 py-3 font-semibold text-white hover:bg-[#16295b]">Get Started</button>
                            <button className="rounded-md border border-[#1F3984] px-6 py-3 font-semibold text-[#1F3984] hover:bg-[#1F3984] hover:text-white">
                                Learn More
                            </button>
                        </div>
                    </div>
                    <div className="relative">
                        <img src="/images/banner/banner-01.png" alt="Hero" className="relative z-10 w-full" />
                        <img
                            src="/images/banner/banner-01-shape.png"
                            alt="Shape"
                            className="pointer-events-none absolute top-0 left-0 -z-10 h-full w-full object-cover"
                        />
                    </div>
                </div>
            </section>
    );
}
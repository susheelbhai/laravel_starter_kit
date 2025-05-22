export default function NewsletterSection() {
    return (
<section id="newsletter" className="bg-white py-20 md:py-28">
                <div className="mx-auto max-w-[700px] px-4 text-center md:px-6">
                    <span className="text-sm font-semibold text-[#FAB915] uppercase">Newsletter</span>
                    <h2 className="mt-2 mb-6 text-3xl font-bold md:text-5xl">Stay Updated With Our Latest News</h2>
                    <p className="mb-8 text-[#6B7280]">Subscribe to receive the latest updates and offers from Finbiz.</p>
                    <form className="mx-auto flex max-w-md">
                        <input
                            type="email"
                            placeholder="Enter your email"
                            className="flex-grow rounded-l-md border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-[#FAB915] focus:outline-none"
                        />
                        <button type="submit" className="rounded-r-md bg-[#FAB915] px-6 py-3 font-semibold text-white hover:bg-yellow-500">
                            Subscribe
                        </button>
                    </form>
                </div>
            </section>
    );
}
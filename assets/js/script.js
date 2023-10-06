function main() {
    let faqAccordion = document.querySelector('#faq-accordion');
    let faqItems = faqAccordion.querySelectorAll('.question');

    faqItems.forEach((item) => {
        item.addEventListener('click', (e) => {
            faqItems.forEach((item) => {
                if (item !== e.currentTarget) {
                    item.classList.remove('active');
                }
            });

            let question = e.currentTarget;

            question.classList.toggle('active');
        });
    });
}

window.onload = main;
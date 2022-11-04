let lang = {
    en: {
        about: "About us",
        contact: "Contact us",
        btnsearchemp: "Searching for employees",
        applynow: "Apply now",
        madewith: "Made with ❤️ by",
        qst1: "Are you looking for suitable employees?",
        answer1: "We bring candidates and companies together and take over the recruitment process and propose applicants to the company",
        findJob: 'Find a job',
        qst2: 'Would you like to work in Germany?',
        answer2: "get in touch with us or send us an application with an English or German CV . Apply for jobs in top locations in Germany such as Munich, Hamburg or Berlin.",
        deschome: "We Help To Get The Best Job And Find A Talent",
        mindeschome: "Take a look at our top  careers for helping people, plus our ‘best of the rest’ suggestions you might not have considered.",
        mindeschome1: "Medicine",
        mindeschome2: "Professional formation",
        mindeschome3: "Engineers",
        ourclientsays: "Our Clients Say!!!",
        abouthead1: "Looking for employees?",
        abouthead1text: "We bring candidates and companies together and take over the recruitment process and propose applicants to the company. We support in the search for personnel in the fields of medicine, healthcare, engineering, cleaning and much more...Through Easemploy, we offer great opportunities to cover the company's increasing need for personnel!",
        abouthead2: "Would you like to work in Germany?",
        abouthead2text: "Would you like to work in Germany? Then get in touch with us or send us an application with an English or German CV.Apply for jobs in top locations in Germany such as Munich, Hamburg or Berlin.We are your contact for a fast and fair mediation. We are looking forward to seeing you.",
        team: "Our Team",
        ceo:"CEO - Founder",
        quickcont:"Quick Contact",
        phone:'Phone',
        email:'Email',
        appnow:'Apply now'
    },

    gr: {
        about: "über uns",
        contact: "Kontaktiere uns",
        btnsearchemp: "Mitarbeiter gesucht",
        applynow: "Jetzt bewerben",
        madewith: "Hergestellt mit ❤️ von",
        qst1: "Sie suchen geeignete Mitarbeiter?",
        answer1: "Wir bringen Kandidaten und Unternehmen zusammen und übernehmen den Rekrutierungsprozess und schlägt dem Unternehmen Bewerber vor. Wir unterstützen bei der Personalsuche im Bereich Medizin, Gesundheitswesen , Ingenieurwesen, Reinigung und vieles mehr… ",
        findJob: 'Einen Beruf finden',
        qst2: 'Sie möchten in Deutschland arbeiten?',
        answer2: 'Nehmen Sie Kontakt mit uns auf oder senden Sie uns eine Bewerbung mit englischem oder deutschem Lebenslauf . Bewerben Sie sich für Jobs an Top-Standorten in Deutschland wie München, Hamburg oder Berlin.',
        deschome: "Wir helfen, den besten Job zu bekommen und ein Talent zu finden",
        mindeschome: "Werfen Sie einen Blick auf unsere Top-Karrieren, um Menschen zu helfen, sowie auf unsere „Best of the Rest“-Vorschläge, die Sie vielleicht nicht in Betracht gezogen haben",
        mindeschome1: "Medizin",
        mindeschome2: "Professionelles Training",
        mindeschome3: "Ingenieure",
        ourclientsays: "Das sagen unsere Kunden!!!",
        abouthead1: "Suchen Sie Mitarbeiter?",
        abouthead1text: "Wir bringen Kandidaten und Unternehmen zusammen und übernehmen den Rekrutierungsprozess und schlägt dem Unternehmen Bewerber vor. Wir unterstützen bei der Personalsuche im Bereich Medizin, Gesundheitswesen , Ingenieurwesen, Reinigung und vieles mehr…Wir  bieten durch Easemploy große Chancen, um den im Unternehmen steigenden Personalbedarf zu decken!",
        abouthead2: "Sie möchten in Deutschland arbeiten?",
        abouthead2text: "Sie möchten gerne in Deutschland arbeiten? Dann melden Sie sich bei uns oder senden Sie uns eine Bewerbung mit englischem oder deutschen Lebenslauf. Bewerben Sie sich für Jobs an Top-Standorten in Deutschland wie München, Hamburg oder Berlin. Wir sind Ihr Ansprechpartner für eine schnelle und faire Vermittlung. Wir freuen uns sehr auf Sie. ",
        team: "Unser Team",
        ceo:"Geschäftsführer und Gründer",
        quickcont:"schneller Kontakt",
        phone:'Telefon',
        email:'Email',
        appnow:'Jetzt bewerben'
    }
};
let select = document.getElementById('langue-selector');
let nodes = Array.from(document.querySelectorAll('[data-lang]'));


function changeLang() {
    let language = select.value;
  localStorage.setItem('language', language);

    nodes.forEach(node => {
        let key = node.getAttribute('data-lang');
        node.textContent = lang[localStorage.getItem('language')][key];
    })
};
//window.onload = changeLang;
select.onchange = changeLang;


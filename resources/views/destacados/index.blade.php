@extends('layouts.app')


@section('content')
<h1>Famous Characters</h1>
<div class="parallax-section" style="background-image: url('{{ asset('/img/spider.jpg') }}');">
    <div class="info">
        <h3>Spider-Man</h3>
        <p>Peter Parker, also known as Spider-Man, is a young man with a slender yet athletic build. His brown hair is often tousled due to his adventures. He has piercing brown eyes that reflect his wit and determination. His red and blue suit is adorned with a web design covering his body, showcasing his agility and dexterity.</p>
    </div>
</div>

<div class="parallax-section" style="background-image: url('{{ asset('/img/capitan-america.webp') }}');">
    <div class="info">
        <h3>Captain America</h3>
        <p>Captain America, Steve Rogers, is a man with an athletic build and an imposing stature. His blond hair is cut military-style, framing his square and determined face. His blue eyes reflect his bravery and honor. He wears the iconic red, white, and blue suit with a star on the chest, symbolizing his patriotism and leadership.</p>
    </div>
</div>

<div class="parallax-section" style="background-image: url('{{ asset('/img/deadpool.png') }}');">
    <div class="info">
        <h3>Deadpool</h3>
        <p>Wade Wilson, known as Deadpool, is a quirky individual with a unique appearance. His face is disfigured due to scars, and his eyes, visible through the mask, radiate sarcastic and mocking humor. His red and black suit is covered in stains and cuts, reflecting his chaotic and unconventional fighting style. He always carries an arsenal of weapons and his famous sense of humor.</p>
    </div>
</div>

<div class="parallax-section" style="background-image: url('{{ asset('/img/wolverine.webp') }}');">
    <div class="info">
        <h3>Wolverine</h3>
        <p>Logan, better known as Wolverine, is a muscular, short-statured man with an intimidating presence. His dark hair and scruffy beard add a ruggedness to his appearance. His intense eyes, of a piercing blue color, display the fierceness and determination of his wild nature. His retractable adamantium claws, one of his most distinctive features, speak to his lethal combat capabilities.</p>
    </div>
</div>

<div class="parallax-section" style="background-image: url('{{ asset('/img/hulk.webp') }}');">
    <div class="info">
        <h3>Hulk</h3>
        <p>Bruce Banner, also known as Hulk, is a man with an athletic build who transforms into a massive, muscular green creature when enraged. In his human form, his dark hair is generally unkempt, and his brown eyes show notable intelligence. As Hulk, his green skin highlights his superhuman strength, and his facial expression often reflects anger or determination.</p>
    </div>
</div>

<div class="parallax-section" style="background-image: url('{{ asset('/img/ironman.jpg') }}');">
    <div class="info">
        <h3>Iron Man</h3>
        <p>Tony Stark, the billionaire genius behind Iron Man, has a magnetic and sophisticated presence. With a square jawline and a smug smile, his face reflects his confidence and charisma. His blue eyes shine behind sunglasses or the Iron Man armor, revealing his cunning and determination. The red and gold armor he wears as Iron Man is a masterpiece of engineering, showcasing his prowess in advanced technology and engineering.</p>
    </div>
</div>

<div class="parallax-section" style="background-image: url('{{ asset('/img/thor.webp') }}');">
    <div class="info">
        <h3>Thor</h3>
        <p>Thor, the mighty god of thunder, is the prince of Asgard. With his imposing presence and supernatural strength, he defends the realms from the dangers that threaten them. His blond hair and his mighty hammer, Mjolnir, are recognized throughout the galaxy as symbols of his power.</p>
    </div>
</div>
@endsection

<!-- Repite para otros Vengadores -->
@section('additional-scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            } else {
                entry.target.classList.remove("show");
            }
        });
    }, {
        threshold: 0.5,
    });

    document.querySelectorAll(".info").forEach((section) => {
        observer.observe(section);
    });
});

window.addEventListener('scroll', () => {
    document.querySelectorAll('.parallax-section').forEach((section, i) => {
        const divPosition = section.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1;
        if(divPosition < screenPosition){
            section.style.backgroundPositionY = -(window.scrollY - section.offsetTop) * 0.5 + "px";
        }
    });
});
</script>

@endsection